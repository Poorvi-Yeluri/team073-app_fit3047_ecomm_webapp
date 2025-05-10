<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ContactMessages Controller
 *
 * @property \App\Model\Table\ContactMessagesTable $ContactMessages
 */
class ContactMessagesController extends AppController
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Get the filter type from the query parameter
        $type = $this->request->getQuery('type', '');

        // Build the query based on the filter type
        $query = $this->ContactMessages->find();

        // Apply message type filter
        if (!empty($type)) {
            $query->where(['message_type' => $type]);
        }

        // Paginate the results
        $contactMessages = $this->paginate($query);

        // Pass the contact messages and filter type to the view
        $this->set(compact('contactMessages', 'type'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $contactMessage = $this->ContactMessages->get($id, contain: []);
        $this->set(compact('contactMessage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactMessage = $this->ContactMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            if ($this->Recaptcha->verify()) {
                $contactMessage = $this->ContactMessages->patchEntity($contactMessage, $this->request->getData());
                if ($this->ContactMessages->save($contactMessage)) {
                    $this->Flash->success(__("Your contact message has been sent."));

                    return $this->redirect($this->referer());
                } else {
                    $this->Flash->error(__('Your contact message could not be sent. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Recaptcha verification failed.'));
            }
        }
        $this->set(compact('contactMessage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $contactMessage = $this->ContactMessages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactMessage = $this->ContactMessages->patchEntity($contactMessage, $this->request->getData());
            if ($this->ContactMessages->save($contactMessage)) {
                $this->Flash->success(__('The contact message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact message could not be saved. Please, try again.'));
        }
        $this->set(compact('contactMessage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactMessage = $this->ContactMessages->get($id);
        if ($this->ContactMessages->delete($contactMessage)) {
            $this->Flash->success(__('The contact message has been deleted.'));
        } else {
            $this->Flash->error(__('The contact message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
