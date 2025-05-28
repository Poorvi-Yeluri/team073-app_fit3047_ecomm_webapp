<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Log\Log;
use Cake\Filesystem\Folder;
use Exception;

/**
 * ProductVariants Controller
 *
 * @property \App\Model\Table\ProductVariantsTable $ProductVariants
 */
class ProductVariantsController extends AppController
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
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ProductVariants->find()
            ->contain(['Products']);
        $productVariants = $this->paginate($query);

        $this->set(compact('productVariants'));
    }

    /**
     * View method
     *
     * @param string|null $id Product Variant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productVariant = $this->ProductVariants->get($id, contain: ['Products']);
        $this->set(compact('productVariant'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productVariant = $this->ProductVariants->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Remove images temporarily from data before patching
            $imagesData = $data['product_variant_images'] ?? [];
            unset($data['product_variant_images']);

            $productVariant = $this->ProductVariants->patchEntity(
                $productVariant,
                $data,
                ['associated' => ['AttributeValues']]
            );


            if ($this->ProductVariants->save($productVariant)) {
                $variantId = $productVariant->id;

                // Normalize uploaded files
                $files = is_array($imagesData) ? $imagesData : [$imagesData];

                foreach ($files as $index => $uploadedFile) {
                    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                        $originalName = $uploadedFile->getClientFilename();

                        // Sanitize and create unique filename
                        $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                        $fileName = uniqid($safeName . '_') . '.' . $extension;

                        $uploadDir = WWW_ROOT . 'img' . DS . 'uploads' . DS;
                        $uploadPath = $uploadDir . $fileName;

                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        try {
                            $uploadedFile->moveTo($uploadPath);

                            $imageEntity = $this->ProductVariants->ProductVariantImages->newEntity([
                                'variant_id' => $variantId,
                                'image_url' => $uploadPath,
                                'is_main' => ($index === 0),
                            ]);

                            if ($this->ProductVariants->ProductVariantImages->save($imageEntity)) {
                                $this->Flash->success(__('Image {0} uploaded and saved.', $originalName));
                            } else {
                                debug($imageEntity->getErrors());
                                $this->Flash->error(__('Image {0} failed to save to database.', $originalName));
                            }
                        } catch (Exception $e) {
                            $this->Flash->error(__('Failed to upload file: {0}', $originalName));
                        }
                    } else {
                        $this->Flash->error(__('Error uploading file: {0}', $uploadedFile->getClientFilename()));
                    }
                }

                $this->Flash->success(__('The product variant has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The product variant could not be saved. Please, try again.'));
            debug($productVariant->getErrors());
        }

        $products = $this->ProductVariants->Products->find('list')->all();

        $attributeValuesQuery = $this->ProductVariants->AttributeValues->find()
            ->contain(['Attributes'])
            ->all();

        $groupedAttributeValues = [];
        foreach ($attributeValuesQuery as $attrValue) {
            $groupedAttributeValues[$attrValue->attribute->name][$attrValue->id] = $attrValue->value;
        }

        $this->set(compact('productVariant', 'products', 'groupedAttributeValues'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Variant id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productVariant = $this->ProductVariants->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productVariant = $this->ProductVariants->patchEntity($productVariant, $this->request->getData());
            if ($this->ProductVariants->save($productVariant)) {
                $this->Flash->success(__('The product variant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product variant could not be saved. Please, try again.'));
        }
        $products = $this->ProductVariants->Products->find('list', limit: 200)->all();
        $this->set(compact('productVariant', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Variant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productVariant = $this->ProductVariants->get($id);
        if ($this->ProductVariants->delete($productVariant)) {
            $this->Flash->success(__('The product variant has been deleted.'));
        } else {
            $this->Flash->error(__('The product variant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
