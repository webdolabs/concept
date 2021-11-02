<?php

namespace App\Http\Controllers\Api\v1\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\Item;
use App\Models\Ecommerce\OrderItem;
use App\Models\Ecommerce\Shipping;
use App\Models\Ecommerce\Payment;
use App\Mail\OrderPaymentSend;

use App\Actions\Api\BuildPageQuery;

use App\Http\Resources\Ecommerce\CartItemResource;
use App\Http\Resources\Ecommerce\CartResource;
use App\Http\Resources\MediaFullUrlResource;

use App\Actions\Integrations\Gopay\PaymentStatus;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    use PaymentStatus;
    use BuildPageQuery;

    public function detail(Request $request) {
        $request = $request->all();

        /*
        *   Validate if locale exists
        */
        $resolveLocaleResult = $this->resolveLocale($request['locale']);
        if(isset($resolveLocaleResult['error'])) return $resolveLocaleResult;
        unset($request['locale']);

        $cart = Order::find($request['cart']);

        if(!$cart) {
            return [
                'status' => 'not found'
            ];
        }

        if($cart->submited && $cart->payment_type == 'gopay-platba-kartou'){
            $status = $this->getGoPayPaymentStatus($cart->billing_number);
            $status = $status['state'] ?? 'FAIL';
            if($status == 'PAID') {
                $cart->status = "waiting-for-packing";
                $cart->payment_waiting = false;
            }else {
                $status = 'FAIL';

                $email = [
                    'order' => $cart
                ];
                try {
                    Mail::to($cart->email)->send(new OrderPaymentSend($email));
                } catch (\Exception $e) {

                }

                $cart->status = "waiting-for-payment";
                $cart->payment_waiting = true;
            }
            $cart->save();
            return [
                'status' => $status
            ];
        }

        $items = CartItemResource::collection($cart->items);

        // Add media
        if($request['media'] ?? false) {
            foreach($items as $returnKey => $returnItem) {
                $returnMedia = [];
                foreach($request['media'] as $media) {
                    $returnMedia[$media] = MediaFullUrlResource::collection(Item::find($returnItem['item_id'])->post->getMedia($media));
                    if(count($returnMedia[$media]) == 1) {
                        $returnMedia[$media] = $returnMedia[$media][0];
                    }
                }
                $items[$returnKey] = collect($items[$returnKey])->merge($returnMedia);
            }
        }

        return [
            'status' => 'found',
            'shippings' => Shipping::where('active', 1)->get(),
            'payments' => Payment::where('active', 1)->get(),
            'cart' => array_merge(
                (new CartResource($cart))->toArray(request())
                , ['total' => collect($items)->sum('total')]
            ),
            'items' => $items
        ];
    }
}