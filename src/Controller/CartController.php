<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Exception;
use Stripe\StripeClient;

class CartController extends AppController
{
    private StripeClient $stripe;

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['add', 'remove', 'checkout']);
        $stripeSecretKey = Configure::read('Stripe.secret_key');
        $this->stripe = new StripeClient($stripeSecretKey);    }

    /**
     * Get the current cart items in the session
     */
    public function getItems(): Response
    {
        $session = $this->request->getSession();
        $cartItems = $session->read('Cart.items') ?? [];
        $result = [
            'cartItems' => $cartItems,
            'cartCount' => count($cartItems),
        ];
        return $this->response->withType('application/json')->withStringBody(json_encode($result));
    }

    /**
     * Add a product to the cart
     */
    public function add($productId)
    {
        $this->request->allowMethod(['post']);

        $session = $this->request->getSession();
        $product = $this->fetchTable('Products')->get($productId);

        $cart = $session->read('Cart.items') ?? [];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->base_price,
                'quantity' => 1,
                'image_url' => $product->image
            ];
        }

        $session->write('Cart.items', $cart);

        $this->Flash->success("{$product->name} added to your cart!");

        return $this->redirect($this->referer());
    }


    /**
     * Remove a product to the cart
     */
    public function remove($productId)
    {
        $this->request->allowMethod(['post', 'ajax']);

        $session = $this->request->getSession();
        $cart = $session->read('Cart.items') ?? [];

        if (isset($cart[$productId])) {
            $productName = $cart[$productId]['name'];
            unset($cart[$productId]);
            $session->write('Cart.items', $cart);
            $this->Flash->success("{$productName} was removed from your cart.");
        } else {
            $this->Flash->error("Product not found in cart.");
        }

        return $this->redirect($this->referer());
    }



    public function count()
    {
        $this->request->allowMethod(['get']);
        $session = $this->request->getSession();
        $cart = $session->read('Cart.items') ?? [];
        $count = array_sum(array_column($cart, 'quantity'));

        $this->set([
            'count' => $count,
            '_serialize' => ['count']
        ]);
    }


    /**
     * Checkout method to initiate Stripe payment
     */
    public function checkout()
    {
        // Retrieve cart items from session
        $session = $this->request->getSession();
        $cartItems = $session->read('Cart.items') ?? [];

        if (empty($cartItems)) {
            throw new NotFoundException('Your cart is empty.');
        }

        // Prepare line items for Stripe checkout
        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'aud',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => (int)($item['price'] * 100), // Convert price to cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Get the base URL of the current site (domain)
        $baseUrl = 'https://' . $this->request->domain();
        try {
            $checkoutSession = $this->stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $baseUrl . '/orders/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $baseUrl . '/order/cancel?session_id={CHECKOUT_SESSION_ID}',
            ]);

            return $this->redirect($checkoutSession->url);
        } catch (Exception $e) {
            $this->Flash->error('Error creating checkout session: ' . $e->getMessage());
            return $this->redirect(['action' => 'index']);
        }
    }
}
