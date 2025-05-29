<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
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
        $this->viewBuilder()->setTemplate('view.private');
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

                        $uploadDir = WWW_ROOT . 'img' . DS . 'product-variants' . DS;
                        $uploadPath = $uploadDir . $fileName;

                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        try {
                            $uploadedFile->moveTo($uploadPath);

                            $imageEntity = $this->ProductVariants->ProductVariantImages->newEntity([
                                'variant_id' => $variantId,
                                'image_url' => 'product-variants' . DS . $fileName,
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
        $productVariant = $this->ProductVariants->get($id, [
            'contain' => ['ProductVariantImages', 'AttributeValues']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Extract and remove images data before patching
            $imagesData = $data['product_variant_images'] ?? [];
            unset($data['product_variant_images']);

            $productVariant = $this->ProductVariants->patchEntity($productVariant, $data, [
                'associated' => ['AttributeValues']
            ]);

            if ($this->ProductVariants->save($productVariant)) {
                $variantId = $productVariant->id;

                // Handle uploaded images
                $files = is_array($imagesData) ? $imagesData : [$imagesData];
                foreach ($files as $index => $uploadedFile) {
                    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                        $originalName = $uploadedFile->getClientFilename();

                        $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                        $fileName = uniqid($safeName . '_') . '.' . $extension;

                        $uploadDir = WWW_ROOT . 'img' . DS . 'product-variants' . DS;
                        $uploadPath = $uploadDir . $fileName;

                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        try {
                            $uploadedFile->moveTo($uploadPath);

                            $imageEntity = $this->ProductVariants->ProductVariantImages->newEntity([
                                'variant_id' => $variantId,
                                'image_url' => 'product-variants' . DS . $fileName,
                                'is_main' => false, // or set based on your logic
                            ]);

                            if ($this->ProductVariants->ProductVariantImages->save($imageEntity)) {
                                $this->Flash->success(__('Image {0} uploaded and saved.', $originalName));
                            } else {
                                $this->Flash->error(__('Failed to save image {0} to database.', $originalName));
                            }
                        } catch (Exception $e) {
                            $this->Flash->error(__('Failed to upload file: {0}', $originalName));
                        }
                    } elseif ($uploadedFile->getError() !== UPLOAD_ERR_NO_FILE) {
                        // Only show error if not "no file uploaded"
                        $this->Flash->error(__('Error uploading file: {0}', $uploadedFile->getClientFilename()));
                    }
                }

                $this->Flash->success(__('The product variant has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product variant could not be saved. Please, try again.'));
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
     * Delete method
     *
     * @param string|null $id Product Variant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        // Load the variant along with associated images
        $productVariant = $this->ProductVariants->get($id, [
            'contain' => ['ProductVariantImages']
        ]);

        // Loop through each associated image to delete the file and record
        foreach ($productVariant->product_variant_images as $image) {
            $filePath = $image->image_url;

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete image record from DB
            $this->ProductVariants->ProductVariantImages->delete($image);
        }

        // Now delete the product variant itself
        if ($this->ProductVariants->delete($productVariant)) {
            $this->Flash->success(__('The product variant and its images have been deleted.'));
        } else {
            $this->Flash->error(__('The product variant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function removeImage(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);

        $connection = $this->ProductVariants->ProductVariantImages->getConnection();
        $connection->begin();

        try {
            $image = $this->ProductVariants->ProductVariantImages->get($id);
            $imagePath = WWW_ROOT . $image->image_url;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            if ($this->ProductVariants->ProductVariantImages->delete($image)) {
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


    public function changeMainImage($variantId = null)
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;


        // Find the current main image for this variant
        $mainImage = $this->ProductVariants->ProductVariantImages->find()
            ->where(['product_variant_id' => $variantId, 'is_main' => true])
            ->first();


        if (!$mainImage) {
            $this->response = $this->response->withStatus(404)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'message' => 'Main image not found for this variant.'
                ]));
            return $this->response;
        }

        $uploadedFile = $this->request->getData('new_main_image');
        debug($mainImage);
debug($uploadedFile);
        if ($uploadedFile && $uploadedFile->getError() === UPLOAD_ERR_OK) {
            $originalName = $uploadedFile->getClientFilename();

            $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $fileName = uniqid($safeName . '_') . '.' . $extension;

            $uploadDir = WWW_ROOT . 'img' . DS . 'product-variants' . DS;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $uploadPath = $uploadDir . $fileName;

            // Delete old image file if it exists
            $oldImagePath = WWW_ROOT . 'img' . DS . $mainImage->image_url;
            error_log($uploadPath);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }


            // Move uploaded file to destination
            $uploadedFile->moveTo($uploadPath);

            // Update record with new image path
            $mainImage->image_url = 'product-variants' . DS . $fileName;

            if ($this->ProductVariants->ProductVariantImages->save($mainImage)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Main image updated successfully.',
                    'newImageUrl' => $this->request->getAttribute('webroot') . 'img/' . $mainImage->image_url,
                ];

                $this->response = $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
                return $this->response;
            } else {
                $this->response = $this->response
                    ->withStatus(500)
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'status' => 'error',
                        'message' => 'Failed to update main image record.'
                    ]));
                return $this->response;
            }
        }

        $this->response = $this->response
            ->withStatus(400)
            ->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'error',
                'message' => 'No image uploaded or upload error.'
            ]));
        return $this->response;
    }

}
