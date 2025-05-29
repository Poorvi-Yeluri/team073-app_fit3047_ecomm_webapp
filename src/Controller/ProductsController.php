<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\ProductsTable;
use Cake\Controller\Component;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Exception;
use function Cake\Error\debug;

/**
 * Products Controller
 *
 * @property ProductsTable $Products
 * @property Component|Table|mixed|null $Authentication
 */
class ProductsController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index', 'view', 'search']);
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $queryParams = $this->request->getQuery();

        if ($this->Authentication->getIdentity()) {
            $this->viewBuilder()->setTemplate('index.private');
            $query = $this->Products->find()
                ->contain(['ProductVariants', 'ProductImages']); // eager load related data as needed

            $products = $this->paginate($query);
            $category = $queryParams['category'] ?? null;

            $this->set(compact('products', 'category'));
        } else {
            $this->viewBuilder()->setTemplate('index.public');
            // Pass empty variantIds and queryParams correctly
            $query = $this->prepareVariantQuery([], $queryParams);

            $variants = $this->paginate($query);

            // Extract variant IDs for filters (optional)
            $variantIds = collection($variants)->extract('id')->toList();
            $filterOptions = $this->Products->getVariantFilters($variantIds);

            $selectedFilters = array_filter(
                $queryParams,
                fn($v, $k) => $k !== 'category' && $k !== 'sort' && is_array($v),
                ARRAY_FILTER_USE_BOTH,
            );

            $category = $queryParams['category'] ?? null;
            $sort = $queryParams['sort'] ?? 'relevance';

            $this->set(compact('variants', 'category', 'filterOptions', 'selectedFilters', 'sort'));
        }

    }


    /**
     * View method
     *
     * @param string|null $slug Product slug.
     * @return Response|null|void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $slug = null)
    {
        if ($this->Authentication->getIdentity()) {
            $this->viewBuilder()->setTemplate('view.private');
            $product = $this->Products->findBySlug($slug);
            $this->set(compact('product', ));
        } else {
            $this->viewBuilder()->setTemplate('view');
            $variant = $this->Products->ProductVariants->findBySlug($slug);
            $this->set(compact('variant', ));
        }
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Extract and remove image files from the main data
            $imagesData = $data['product_images'] ?? [];
            unset($data['product_images']);

            $product = $this->Products->patchEntity($product, $data);

            if ($this->Products->save($product)) {
                $productId = $product->id;

                $imageEntities = [];

                foreach ($imagesData as $uploadedFile) {
                    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                        $filename = time() . '_' . $uploadedFile->getClientFilename();
                        $uploadPath = WWW_ROOT . 'img' . DS . 'products' . DS;

                        // Ensure the upload directory exists
                        if (!file_exists($uploadPath)) {
                            mkdir($uploadPath, 0775, true);
                        }

                        $uploadedFile->moveTo($uploadPath . $filename);

                        $imageEntity = $this->Products->ProductImages->newEntity([
                            'product_id' => $productId,
                            'image_url' => 'products/' . $filename,
                        ]);

                        $imageEntities[] = $imageEntity;
                    }
                }

                if (!empty($imageEntities)) {
                    $this->Products->ProductImages->saveMany($imageEntities);
                }

                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $this->set(compact('product'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['ProductImages'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Extract and remove image files from the main data
            $imagesData = $data['product_images'] ?? [];
            $imagesData = is_array($imagesData) ? $imagesData : [$imagesData]; // Normalize to array
            unset($data['product_images']);

            // If image_url is empty and no new images are uploaded, keep the current one
            if (empty($data['image_url']) && empty($imagesData)) {
                $data['image_url'] = $product->image_url;
            }

            $product = $this->Products->patchEntity($product, $data);

            if ($this->Products->save($product)) {
                $productId = $product->id;
                $imageEntities = [];

                foreach ($imagesData as $uploadedFile) {
                    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                        $filename = time() . '_' . $uploadedFile->getClientFilename();
                        $uploadPath = WWW_ROOT . 'img' . DS . 'products' . DS;

                        if (!file_exists($uploadPath)) {
                            mkdir($uploadPath, 0775, true);
                        }

                        $uploadedFile->moveTo($uploadPath . $filename);

                        $imageEntity = $this->Products->ProductImages->newEntity([
                            'product_id' => $productId,
                            'image_url' => 'products' . DS . $filename,
                        ]);

                        $imageEntities[] = $imageEntity;
                    }
                }

                if (!empty($imageEntities)) {
                    $this->Products->ProductImages->saveMany($imageEntities);
                }

                $this->Flash->success(__('The product has been updated.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The product could not be updated. Please, try again.'));
        }

        $this->set(compact('product'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $connection = $this->Products->getConnection();
        $connection->begin();

        try {
            $product = $this->Products->get($id,
                ['contain' => ['ProductVariants', 'ProductImages', 'ProductAttributes']]
            );

            $this->Products->ProductVariants->deleteAll(['product_id' => $id]);
            $this->Products->ProductImages->deleteAll(['product_id' => $id]);
            $this->Products->ProductAttributes->deleteAll(['product_id' => $id]);

            if ($this->Products->delete($product)) {
                $connection->commit();
                $this->Flash->success(__('The product has been deleted.'));
            } else {
                $connection->rollback();
                $this->Flash->error(__('The product could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $connection->rollback();
            $this->Flash->error(__('Error deleting product: ' . $e->getMessage()));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Search method
     *
     * Handles variant search based on a query term.
     * It first tries a full-text search, and if no results are found,
     * it falls back to a LIKE search.
     *
     * @param string|null $queryTerm The search term provided in the query string parameter 'q'. Defaults to null.
     * @return Response|null Renders the search results view.
     */
    public function search(): void
    {
        $queryTerm = trim($this->request->getQuery('q') ?? '');
        $queryParams = $this->request->getQuery();
        $usedFallback = false;
        $selectedFilters = [];
        $variants = [];

        if (!empty($queryTerm)) {
            // Search only for product variants
            $searchResult = $this->Products->ProductVariants->find()
                ->contain([
                    'Products',
                    'ProductVariantAttributes.AttributeValues.Attributes',
                    'ProductVariantImages',

                ])
                ->where(function ($exp, $q) use ($queryTerm) {
                    return $exp->like('ProductVariants.name', '%' . $queryTerm . '%');
                });

            $usedFallback = false; // No fallback needed for variants search

            if ($searchResult->count() > 0) {
                // Apply additional filters
                $variantIds = collection($searchResult)->extract('id')->toList();
                $query = $this->prepareVariantQuery($variantIds, $queryParams);

                // Ensure pagination is set for this query
                $variants = $this->paginate($query);  // Make sure pagination is applied here
            }
        }

        // Filter options for variants
        $variantIds = collection($variants)->extract('id')->toList();
        $filterOptions = $this->Products->getVariantFilters($variantIds);

        // Extract filter parameters
        $selectedFilters = array_filter(
            $queryParams,
            fn($v, $k) => $k !== 'category' && $k !== 'sort' && $k !== 'q' && is_array($v),
            ARRAY_FILTER_USE_BOTH
        );

        $category = $queryParams['category'] ?? null;
        $sort = $queryParams['sort'] ?? 'relevance';

        // Pass variables to the view
        $this->set(compact(
            'variants',
            'queryTerm',
            'usedFallback',
            'category',
            'filterOptions',
            'selectedFilters',
            'sort'
        ));
    }

    public function prepareVariantQuery(array $variantIds = [], array $queryParams = []): Query
    {
        $sort = $queryParams['sort'] ?? null;

        $query = $this->Products->ProductVariants->find()
            ->contain(['Products', 'ProductVariantImages', 'ProductVariantAttributes.AttributeValues.Attributes']);

        if (!empty($variantIds)) {
            $query->where(['ProductVariants.id IN' => $variantIds]);
        }

        // Filter by category string column in products
        if (!empty($queryParams['category'])) {
            $category = $queryParams['category'];

            // Use matching to filter ProductVariants by product.category string
            $query->matching('Products', function ($q) use ($category) {
                return $q->where(['Products.category' => $category]);
            });
        }

        $selectedFilters = array_filter($queryParams, function ($value, $key) {
            return $key !== 'sort' && $key !== 'category' && is_array($value) && !empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        $query = $this->Products->findFilteredVariants($query, $selectedFilters);

        if ($sort) {
            $query = $this->Products->applyVariantSorting($query, $sort);
        }

        return $query;
    }

    public function removeImage(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);

        $connection = $this->Products->ProductImages->getConnection();
        $connection->begin();

        try {
            $image = $this->Products->ProductImages->get($id);
            $imagePath = WWW_ROOT . $image->image_url;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            if ($this->Products->ProductImages->delete($image)) {
                $connection->commit();
                $this->Flash->success(__('The image has been deleted.'));
            } else {
                $connection->rollback();
                $this->Flash->error(__('The image could not be deleted. Please, try again.'));
            }
        } catch (Exception $e) {
            $connection->rollback();
            $this->Flash->error(__('Error deleting image: ' . $e->getMessage()));
        }

        return $this->redirect($this->referer());
    }


}
