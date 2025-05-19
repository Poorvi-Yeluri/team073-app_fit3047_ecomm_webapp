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
        $this->Authentication->allowUnauthenticated(['add', 'remove', 'count', 'getItems', 'checkout']);
        $this->stripe = new StripeClient(Configure::read('Stripe.secret_key'));
    }

    /**
     * Get the current cart items in the session
     */
    public function getItems(): Response
    {
        $session = $this->request->getSession();
        $cartItems = $session->read('Cart.items') ?? [];

        return $this->response->withType('application/json')->withStringBody(json_encode([
            'cartItems' => $cartItems,
            'cartCount' => count($cartItems),
        ]));
    }

    /**
     * Add a product variant to the cart
     */
    public function add($variantId)
    {
        $this->request->allowMethod(['post']);
        $session = $this->request->getSession();
        $data = $this->request->getData();

        $variant = $this->fetchTable("ProductVariants")->get($variantId, [
            'contain' => ['Products', 'ProductVariantImages', 'ProductVariantAttributes.AttributeValues.Attributes']
        ]);

        $quantityToAdd = (int)($data['quantity'] ?? 1);
        if ($quantityToAdd <= 0) {
            $this->Flash->error("Invalid quantity.");
            return $this->redirect($this->referer());
        }

        $attributes = [];
        if ($variant->product->category === 'jewellery') {
            $size = $data['size'] ?? null;

            $validSizes = array_reduce($variant->product_variant_attributes, function ($carry, $attr) {
                if ($attr->attribute_value->attribute->name === 'Size') {
                    $carry[] = $attr->attribute_value->value;
                }
                return $carry;
            }, []);

            if (!$size || !in_array($size, $validSizes)) {
                $this->Flash->error("Please select a valid size.");
                return $this->redirect($this->referer());
            }

            $attributes['Size'] = $size;
        }

        $cart = $session->read('Cart.items') ?? [];
        $key = $variantId . '-' . md5(json_encode($attributes));
        $existingQuantity = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;
        $newTotalQuantity = $existingQuantity + $quantityToAdd;

        if ($newTotalQuantity > $variant->stock_quantity) {
            $this->Flash->error("Only {$variant->stock_quantity} in stock for {$variant->name}. You have {$existingQuantity} in your cart.");
            return $this->redirect($this->referer());
        }

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantityToAdd;
        } else {
            $cart[$key] = [
                'variant_id' => $variantId,
                'name' => $variant->name,
                'price' => $variant->price,
                'quantity' => $quantityToAdd,
                'attributes' => $attributes,
                'image' => $variant->main_image_url,
            ];
        }

        $session->write('Cart.items', $cart);
        $this->Flash->success("{$variant->name} added to your cart!");

        return $this->redirect($this->referer());
    }


    /**
     * Remove a product variant from the cart by cart key
     */
    public function remove($cartKey)
    {
        $this->request->allowMethod(['post', 'ajax']);

        $session = $this->request->getSession();
        $cart = $session->read('Cart.items') ?? [];

        if (isset($cart[$cartKey])) {
            $productName = $cart[$cartKey]['name'];
            unset($cart[$cartKey]);
            $session->write('Cart.items', $cart);
            $this->Flash->success("{$productName} was removed from your cart.");
        } else {
            $this->Flash->error("Item not found in your cart.");
        }

        return $this->redirect($this->referer());
    }

    /**
     * Get cart item count
     */
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
        $session = $this->request->getSession();
        $cartItems = $session->read('Cart.items') ?? [];

        if (empty($cartItems)) {
            throw new NotFoundException('Your cart is empty.');
        }

        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'aud',
                    'unit_amount' => (int)($item['price'] * 100),
                    'product_data' => [
                        'name' => $item['name'],
                        'metadata' => [
                            'variant_id' => (string) $item['variant_id'],
                            'attributes' => json_encode($item['attributes']),
                        ],
                    ],
                ],
                'quantity' => $item['quantity'],
            ];
        }


        $baseUrl = 'https://' . $this->request->getUri()->getHost();

        try {
            $checkoutSession = $this->stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'phone_number_collection' => ['enabled' => true],
                'billing_address_collection' => 'required',
                'shipping_address_collection' => ['allowed_countries' => ['AU']],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $baseUrl . '/orders/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => $baseUrl . '/products/',
            ]);

            return $this->redirect($checkoutSession->url);
        } catch (Exception $e) {
            $this->Flash->error('Error creating checkout session: ' . $e->getMessage());
            return $this->redirect($this->referer());
        }
    }
}
