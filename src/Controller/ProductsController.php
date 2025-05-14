<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Query;
use function Cake\Error\debug;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
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
        // use the correct view template based on user authentication
        if ($this->Authentication->getIdentity()) {
            $this->viewBuilder()->setTemplate('index.private');
        } else {
            $this->viewBuilder()->setTemplate('index.public');
        }

        $queryParams = $this->request->getQuery();
        $query = $this->prepareProductQuery([], $queryParams);
        $selectedFilters = array_filter(
            $queryParams,
            fn($v, $k) => $k !== 'category' && $k !== 'sort' && is_array($v),
            ARRAY_FILTER_USE_BOTH,
        );
        $products = $this->paginate($query);
        $productIds = collection($products)->extract('id')->toList();
        $filterOptions = $this->Products->productFilters($productIds);
        $category = $queryParams['category'] ?? null;
        $sort = $queryParams['sort'] ?? 'relevance';
        $this->set(compact('products', 'category', 'filterOptions', 'selectedFilters', 'sort'));
    }

    /**
     * View method
     *
     * @param string|null $slug Product slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $slug = null)
    {
        $variantSku = $this->getRequest()->getQuery('variant');
        $product = $this->Products->findBySlug($slug);

        $selectedVariant = null;
        if ($variantSku) {
            $selectedVariant = collection($product->product_variants)
                ->firstMatch(['sku' => $variantSku]);
        }

        $this->set(compact('product', 'selectedVariant'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Extract and remove image files from the main data
            $imagesData = $data['product_images'] ?? [];
            unset($data['product_images']);

            if (empty($data['image_url'])) {
                $data['image_url'] = 'https://picsum.photos/200/300'; // You can change this to a default image path
            }

            // Save product first
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
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['ProductImages'], // Include images if you want to list or modify them
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Extract and remove image files from the main data
            $imagesData = $data['product_images'] ?? [];
            unset($data['product_images']);

            // If image_url is empty and no new images are uploaded, keep the current one
            if (empty($data['image_url']) && empty($imagesData)) {
                $data['image_url'] = $product->image_url ?? 'https://picsum.photos/200/300';
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
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
        } catch (\Exception $e) {
            $connection->rollback();
            $this->Flash->error(__('Error deleting product: ' . $e->getMessage()));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Search method
     *
     * Handles product and variant search based on a query term.
     * It first tries a full-text search, and if no results are found,
     * it falls back to a LIKE search.
     *
     * @param string|null $queryTerm The search term provided in the query string parameter 'q'. Defaults to null.
     * @return \Cake\Http\Response|null Renders the search results view.
     */
    public function search(): void
    {
        $queryTerm = trim($this->request->getQuery('q') ?? '');
        $queryParams = $this->request->getQuery();
        $usedFallback = false;
        $selectedFilters = [];
        $products = [];

        if (!empty($queryTerm)) {
            $searchResult = $this->Products->search($queryTerm);
            $usedFallback = $searchResult['usedFallback'];
            $productIds = collection($searchResult['results'])->extract('id')->toList();

            if (!empty($productIds)) {
                $query = $this->prepareProductQuery($productIds, $queryParams);
                if ($query->count() > 0) {
                    $products = $this->paginate($query);
                }
            }
        }

        $productIds = collection($products)->extract('id')->toList();
        $filterOptions = $this->Products->productFilters($productIds);

        $selectedFilters = array_filter(
            $queryParams,
            fn($v, $k) => $k !== 'category' && $k !== 'sort' && $k !== 'q' && is_array($v),
            ARRAY_FILTER_USE_BOTH,
        );

        $category = $queryParams['category'] ?? null;
        $sort = $queryParams['sort'] ?? 'relevance';

        $this->set(compact(
            'products',
            'queryTerm',
            'usedFallback',
            'category',
            'filterOptions',
            'selectedFilters',
            'sort',
        ));
    }

    /**
     * @param array $productIds
     * @param array $queryParams
     * @return \Cake\ORM\Query
     */
    private function prepareProductQuery(array $productIds = [], array $queryParams = []): Query
    {
        $category = $queryParams['category'] ?? null;
        $sort = $queryParams['sort'] ?? 'relevance';

        $query = $this->Products->find()
            ->contain([
                'ProductVariants.ProductVariantAttributes.AttributeValues',
                'ProductImages',
            ]);

        // Apply the filter to restrict the query to search results if product IDs are passed
        if (!empty($productIds)) {
            $query->where(['Products.id IN' => $productIds]);
        }

        // Apply category filter if available
        if (!empty($category)) {
            $query->where(['category' => $category]);
        }

        // Apply additional filters from query params
        $selectedFilters = array_filter($queryParams, function ($value, $key) {
            return $key !== 'category' && $key !== 'sort' && $key !== 'q' && is_array($value) && !empty($value);
        }, ARRAY_FILTER_USE_BOTH);

        // Applying custom filters if any
        $query = $this->Products->findFiltered($query, $selectedFilters);

        // Apply sorting
        switch ($sort) {
            case 'price-asc':
                $query->orderBy(['base_price' => 'ASC']);
                break;
            case 'price-desc':
                $query->orderBy(['base_price' => 'DESC']);
                break;
            case 'latest':
                $query->orderBy(['Products.created_at' => 'DESC']);
                break;
            case 'name-asc':
                $query->orderBy(['name' => 'ASC']);
                break;
            case 'name-desc':
                $query->orderBy(['name' => 'DESC']);
                break;
            default:
                break;
        }

        return $query;
    }
}
