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

    public function success()
    {
        $sessionId = $this->request->getQuery('session_id');

        if (empty($sessionId)) {
            $this->Flash->error('Invalid session ID.');
            return $this->redirect(['controller' => 'Products', 'action' => 'index']);
        }

        try {
            // Retrieve the Stripe session and expand line items + products
            $session = $this->stripe->checkout->sessions->retrieve($sessionId, [
                'expand' => ['line_items.data.price.product']
            ]);

            // Shipping address
            $shippingAddress = $session->collected_information->shipping_details->address ?? null;

            // Customer info
            $customerName = $session->customer_details->name ?? 'Unknown';
            $customerEmail = $session->customer_details->email ?? 'Unknown';
            $customerPhone = $session->customer_details->phone ?? 'Unknown';

            // Payment info
            $paymentStatus = $session->payment_status ?? 'Unknown';
            $paymentMethod = $session->payment_method_types[0] ?? 'Unknown';
            $currency = strtoupper($session->currency ?? 'AUD');

            // Totals
            $shippingAmount = ($session->total_details->amount_shipping ?? 0) / 100;
            $taxAmount = ($session->total_details->amount_tax ?? 0) / 100;
            $discountAmount = ($session->total_details->amount_discount ?? 0) / 100;
            $totalAmount = ($session->amount_total ?? 0) / 100;

            // Create order entity
            $order = $this->Orders->newEmptyEntity();
            $order->session_id = $sessionId;
            $order->user_id = $this->Authentication->getIdentity()->id ?? null;
            $order->total_price = $totalAmount;
            $order->status = 'Completed';
            $order->customer_name = $customerName;
            $order->customer_email = $customerEmail;
            $order->customer_phone = $customerPhone;
            $order->shipping_address = json_encode($shippingAddress);
            $order->payment_status = $paymentStatus;
            $order->payment_method = $paymentMethod;
            $order->shipping_amount = $shippingAmount;
            $order->tax_amount = $taxAmount;
            $order->discounts = json_encode($session->discounts);
            $order->currency = $currency;
            $order->cancel_url = $session->cancel_url ?? null;
            $order->success_url = $session->success_url ?? null;
            $order->expires_at = $session->expires_at;

            if ($this->Orders->save($order)) {
                // Process each line item
                $this->processOrderItems($order->id, $session->line_items->data);
                $this->getRequest()->getSession()->delete('Cart');
                $this->Flash->success('Your order has been placed successfully!');
                return $this->redirect(['controller' => 'Orders', 'action' => 'view', $order->id]);
            } else {
                $this->Flash->error('There was an error saving your order.');
            }
        } catch (Exception $e) {
            $this->Flash->error('Error processing order: ' . $e->getMessage());
        }

        return $this->redirect(['controller' => 'Products', 'action' => 'index']);
    }


    /**
     * Process the order items and link them to the order
     */
    private function processOrderItems($orderId, $lineItems)
    {
        $orderItemsTable = $this->getTableLocator()->get('OrderItems');
        $variantsTable = $this->getTableLocator()->get('ProductVariants');

        foreach ($lineItems as $item) {
            $variantId = $item->price->product->metadata->variant_id;
            $quantity = $item->quantity;

            $orderItem = $orderItemsTable->newEmptyEntity();
            $orderItem->order_id = $orderId;
            $orderItem->variant_id = $item->price->product->metadata->variant_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price->unit_amount / 100; // Convert price to dollars
            $orderItem->amount_subtotal = $item->amount_subtotal / 100; // Store subtotal in dollars
            $orderItem->amount_total = $item->amount_total / 100; // Store total price in dollars
            $orderItem->tax_amount = $item->amount_tax / 100; // Store tax in dollars
            $orderItem->discount_amount = $item->amount_discount / 100; // Store discount amount

            $orderItemsTable->save($orderItem);

            $variant = $variantsTable->get($variantId);
            $variant->stock_quantity = max(0, $variant->stock_quantity - $quantity);

            $variantsTable->save($variant);
        }
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
