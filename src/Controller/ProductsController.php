<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
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
        if ($this->Authentication->getIdentity()) {
            $this->viewBuilder()->setTemplate('index.private');
        } else {
            $this->viewBuilder()->setTemplate('index.public');
        }

        $queryParams = $this->request->getQuery();

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


    /**
     * View method
     *
     * @param string|null $slug Product slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $slug = null)
    {
        $variant = $this->Products->findBySlug($slug);
        $this->set(compact('variant', ));
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
     * Handles variant search based on a query term.
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
        $variants = [];

        if (!empty($queryTerm)) {
            // Search only for product variants
            $searchResult = $this->Products->ProductVariants->find()
                ->contain([
                    'Products', // If you want to include product details as well
                    'ProductVariantImages', // If you want variant images
                    'ProductVariantAttributes.AttributeValues.Attributes', // If filtering by attributes
                ])
                ->where(function ($exp, $q) use ($queryTerm) {
                    return $exp->like('ProductVariants.name', '%' . $queryTerm . '%');
                });

            $usedFallback = false; // No fallback needed for variants search

            if ($searchResult->count() > 0) {
                // Apply additional filters
                $variantIds = collection($searchResult)->extract('id')->toList();
                $query = $this->prepareVariantQueryWithVariants($variantIds, $queryParams);

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
            ->contain(['ProductVariantAttributes.AttributeValues.Attributes']);

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

    private function prepareVariantQueryWithVariants(array $variantIds, array $queryParams = []): Query
    {
        $category = $queryParams['category'] ?? null;
        $sort = $queryParams['sort'] ?? 'relevance';

        $query = $this->Products->ProductVariants->find()
            ->contain([
                'Products.ProductImages',
                'ProductVariantAttributes.AttributeValues.Attributes',
            ])
            ->where(['ProductVariants.id IN' => $variantIds]);

        // Apply category filter if available
        if (!empty($category)) {
            $query->matching('Products', function ($q) use ($category) {
                return $q->where(['Products.category' => $category]);
            });
        }

        // Apply attribute filters
        $selectedFilters = array_filter(
            $queryParams,
            function ($value, $key) {
                return $key !== 'category' && $key !== 'sort' && is_array($value);
            },
            ARRAY_FILTER_USE_BOTH
        );

        $attributeValuesTable = TableRegistry::getTableLocator()->get('AttributeValues');
        foreach ($selectedFilters as $attribute => $values) {
            $valueIds = $attributeValuesTable->getValueIdsForFilter($attribute, $values);
            if (!empty($valueIds)) {
                $query->matching('ProductVariantAttributes', function ($q) use ($valueIds) {
                    return $q->where(['ProductVariantAttributes.attribute_value_id IN' => $valueIds]);
                });
            }
        }

        // Apply sorting
        switch ($sort) {
            case 'price-asc':
                $query->orderBy(['ProductVariants.price' => 'ASC']);
                break;
            case 'price-desc':
                $query->orderBy(['ProductVariants.price' => 'DESC']);
                break;
            case 'latest':
                $query->orderBy(['ProductVariants.created_at' => 'DESC']);
                break;
            default:
                // Optional: Add custom relevance logic
                break;
        }

        return $query->distinct(['ProductVariants.id']);
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
