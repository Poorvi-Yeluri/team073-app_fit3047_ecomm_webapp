<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Query;

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
        $queryParams = $this->request->getQuery();
        $query = $this->prepareProductQuery([], $queryParams);

        $filterOptions = $this->Products->productFilters();
        $selectedFilters = array_filter($queryParams, fn($v, $k) => $k !== 'category' && $k !== 'sort' && is_array($v), ARRAY_FILTER_USE_BOTH);

        $products = $this->paginate($query);
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
        $product = $this->Products
            ->findBySlug($slug)
            ->contain([
                'ProductVariants' => ['ProductVariantImages'],
                'ProductImages',
            ])
            ->firstOrFail();
        $this->set(compact('product'));
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
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->slug = $this->Products->generateSlug($product->name, $id ?? null);
            if ($this->Products->save($product)) {
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
        $product = $this->Products->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->slug = $this->Products->generateSlug($product->name, $id);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
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
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
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
        $products = [];
        $usedFallback = false;
        $selectedFilters = [];

        // Only proceed if the query term is not empty
        if (!empty($queryTerm)) {
            // Search for products based on query term
            $searchResult = $this->Products->search($queryTerm);
            $usedFallback = $searchResult['usedFallback'];

            // Get matched product IDs
            $productIds = collection($searchResult['results'])->extract('id')->toList();

            // If product IDs are available, apply filtering and sorting
            if (!empty($productIds)) {
                // Prepare query based on product IDs and filters
                $query = $this->prepareProductQuery($productIds, $queryParams);

                // Only paginate if the query is valid and returns results
                if ($query) {
                    $products = $this->paginate($query);
                }
            }
        }

        // Fetch filter options
        $filterOptions = $this->Products->productFilters();

        // Fetch selected filters from query params
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
     * @return Query
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
                $query->orderBy(['created_at' => 'DESC']);
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
