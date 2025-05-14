<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Response;
use Exception;
use Stripe\StripeClient;


/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    private StripeClient $stripe;

    public function initialize(): void
    {
        parent::initialize();

        $stripeSecretKey = Configure::read('Stripe.secret_key');
        $this->stripe = new StripeClient($stripeSecretKey);

        $this->Authentication->allowUnauthenticated(['success', 'cancel']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Orders->find()
            ->contain(['Users']);
        $orders = $this->paginate($query);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, contain: ['Users', 'OrderItems']);
        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @return Response|null
     */
    public function success(): Response|null
    {
        $sessionId = $this->request->getQuery('session_id');

        try {
            $checkoutSession = $this->stripe->checkout->sessions->retrieve($sessionId);
            // Prepare the stripe data to save to Orders table
            $order = $this->Orders->newEntity([]);
            $order->status = 'paid';
            $order->total_price = $checkoutSession->amount_total / 100; // Convert from cents to dollars
            if ($this->Orders->save($order)) {
                $session = $this->request->getSession();
                $session->delete('Cart.items');
                $this->Flash->success('Payment successful! Your order is being processed.');
                return $this->redirect(['controller' => 'Orders', 'action' => 'view', $order->id]);
            }
        } catch (Exception $e) {
            $this->Flash->error('There was an error processing your payment.');
        }
        return $this->redirect(['controller' => 'Orders', 'action' => 'index']);
    }

    /**
     * @return Response|null
     */
    public function cancel(): Response|null
    {
        $this->Flash->error('Payment was canceled. Please try again or contact support.');
        return $this->redirect(['controller' => 'Products', 'action' => 'index']);
    }
}
