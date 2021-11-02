<?php

namespace App\Http\Controllers\Api\v1\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\Item;
use App\Models\Ecommerce\OrderItem;

use App\Actions\Api\BuildPageQuery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartItemController extends Controller
{
    use BuildPageQuery;

    public function add(Request $request) {
        return $this->modifyCartItem($request->all(), 'add');
    }

    public function update(Request $request) {
        return $this->modifyCartItem($request->all(), 'update');
    }

    private function modifyCartItem($request, $type) {
        /*
        *   Validate if locale exists
        */
        $resolveLocaleResult = $this->resolveLocale($request['locale']);
        if(isset($resolveLocaleResult['error'])) return $resolveLocaleResult;
        unset($request['locale']);

        /*
        *   Check if cart exists
        */
        $cart = $this->getCart($request);

        $orderItem = OrderItem::where('item_id', $request['item'])->where('order_id', $cart->id)->first();
        if($orderItem) {
            if($request['quantity'] == 0) {
                $orderItem->delete();
                $status = "Deleted Cart Item";
            }else {
                if($type == 'add') {
                    $orderItem->quantity = $orderItem->quantity + $request['quantity'];
                }else {
                    $orderItem->quantity = $request['quantity'];
                }
                $orderItem->save();
                $status = "Updated Cart Item";
            }
        }else {
            $item = Item::find($request['item']);
            $orderItem = OrderItem::create([
                'item_id' => $request['item'],
                'order_id' => $cart->id,
                'name' => $item->post->locale->post_title,
                'sub_name' => $item->sub_name,
                'price' => $item->currency->price,
                'price_VAT' => $item->currency->price_VAT,
                'VAT' => $item->currency->VAT,
                'quantity' => $request['quantity']
            ]);
            $status = "Created new Cart Item";
        }

        $items = OrderItem::where('order_id', $cart->id);

        return [
            'status' => $status,
            'cart' => [
                'code' => $cart->id,
                'currency_symbol' => $cart->currency_symbol,
                'count' => $items->count(),
                'total' => collect($items->get()->toArray())->sum('total'),
            ]
        ];
    }

    private function getCart($request) {
        $cart = Order::find($request['cart'] ?? null);
        if(!$cart) {
            $cart = Order::create([
                'locale' => config('request.locale')['name'],
                'currency_symbol' => config('request.locale')['currency_symbol'],
                'status' => 'cart'
            ]);
        }
        return $cart;
    }
}