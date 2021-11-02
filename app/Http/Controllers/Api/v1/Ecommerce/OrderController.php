<?php

namespace App\Http\Controllers\Api\v1\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\OrderAddress;
use App\Models\Ecommerce\Shipping;
use App\Models\Ecommerce\Payment;
use App\Mail\OrderSend;

use App\Actions\Integrations\Gopay\GeneratePayment;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use GeneratePayment;

    public function update(Request $request) {
        $request = $request->all();

        // Get order
        $order = Order::find($request['order']);
        if(!$order) {
            return ['error' => "Order not exists"];
        }

        $order = $this->updateOrder($request['details'], $order);

        $order->save();
    }

    public function submit(Request $request) {
        $request = $request->all();

        // Get order
        $order = Order::find($request['order']);
        if(!$order) {
            return ['error' => "Order not exists"];
        }

        $order = $this->updateOrder($request['details'], $order);

        $order->billing_number = date('mdHi') . mt_rand(10, 99);
        $order->shipping_price_VAT = Shipping::find($order->shipping_id)->price_VAT;
        $order->payment_price_VAT = Payment::find($order->payment_id)->price_VAT;
        $order->items_total = $request['total'];
        $order->items_total_VAT = $request['total'];

        if($order->payment_type == 'banktransfer') {
            $order->status = "waiting-for-payment";
            $order->payment_waiting = true;
        }elseif($order->payment_type == 'gopay-platba-kartou') {
            $params = [
                'contact' => [
                    'first_name' => $order->billingAddress->first_name,
                    'last_name' => $order->billingAddress->last_name,
                    'email' => $order->email,
                    'phone_number' => $order->billingAddress->telephone_number,
                    'city' => $order->billingAddress->city,
                    'street' => $order->billingAddress->street,
                    'postal_code' => $order->billingAddress->post_code,
                    'country_code' => 'CZE'
                ],
                'total' => $order->items_total_VAT + $order->shipping_price_VAT + $order->payment_price_VAT,
                'payment_code' => $order->billing_number,
            ];

            $payment = $this->generateGoPayCreditCardPayment($params);
            $order->status = "waiting-for-payment";
            $order->payment_waiting = true;
            $order->billing_number = $payment['id'] ?? $order->billing_number;
        }else {
            $order->status = "waiting-for-packing";
        }

        $order->submited = true;
        $order->submited_at = now();
        $order->save();

        $email = [
            'order' => $order,
            'products' => $order->items,
        ];
        try {
            Mail::to($order->email)->send(new OrderSend($email));
        } catch (\Exception $e) {
            $order->status = "email-send-fail";
            $order->save();
        }

        return [
            'status' => 'done',
            'redirect' => $payment['url'] ?? null,
            'payment_id' => $payment['id'] ?? null
        ];
    }

    public function updateOrder($data, $order) {
        if(isset($data['billing_address']) && !empty($data['billing_address'])) {
            if($order->billingAddress) {
                $order->billingAddress()->update(
                    $data['billing_address']
                );
            }else {
                $order->billingAddress()->associate(
                    OrderAddress::create(array_merge(
                        $data['billing_address'],
                        [
                            'type' => 'billing'
                        ]
                    ))
                );
            }
        }

        if(isset($data['shipping_address']) && !empty($data['shipping_address'])) {
            if($order->shippingAddress) {
                $order->shippingAddress()->update(
                    $data['shipping_address']
                );
            }else {
                $order->shippingAddress()->associate(
                    OrderAddress::create(array_merge(
                        $data['shipping_address'],
                        [
                            'type' => 'shipping'
                        ]
                    ))
                );
            }
        }

        $order->email = $data['email'] ?? null;
        $order->delivery_number = $data['delivery_number'] ?? null;
        $order->billing_number = $data['billing_number'] ?? null;
        $order->shipping_type = $data['shipping_type'] ?? null;
        $order->shipping_id = $data['shipping_id'] ?? null;
        $order->payment_type = $data['payment_type'] ?? null;
        $order->payment_id = $data['payment_id'] ?? null;
        $order->customer_note = $data['customer_note'] ?? null;

        return $order;
    }
}