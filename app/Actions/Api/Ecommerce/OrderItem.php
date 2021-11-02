<?php

namespace App\Actions\Api\Ecommerce;

use App\Actions\Api\Ecommerce\Order as OrderAction;

trait OrderItem
{
    use OrderAction;

    private function getOrderItem($itemId, $orderId) {
        return OrderItem::where('item_id', $itemId)->where('order_id', $orderId)->first();
    }

    private function createOrderItem($itemId, $orderId, $quantity = 0) {
        $item = Item::find($itemId);
        if($item) {
            return OrderItem::create([
                'item_id' => $itemId,
                'order_id' => $cart->id,
                'name' => $item->post->locale->post_title,
                'sub_name' => $item->sub_name,
                'price' => $item->currency->price,
                'price_VAT' => $item->currency->price_VAT,
                'VAT' => $item->currency->VAT,
                'quantity' => $quantity
            ]);
        }else {
            return false;
        }
    }

    public function setQuantiyOrderItem() {
        $order = $this->findOrCreateOrder();

        $orderItem = $this->getOrderItem($request['item'], $order->id);

        if(!$orderItem)
            return $this->createOrderItem($request['item'], $order->id, $request['quantity']);
        
        $orderItem->quantity = $request['quantity'];
        $orderItem->save();
        return $orderItem;
    }

    public function addQuantiyOrderItem() {
        $order = $this->findOrCreateOrder();

        $orderItem = $this->getOrderItem($request['item'], $order->id);

        if(!$orderItem)
            return $this->createOrderItem($request['item'], $order->id, $request['quantity']);
        
        $orderItem->quantity += $request['quantity'];
        $orderItem->save();
        return $orderItem;
    }

    public function removeOrderItem() {
        $order = $this->findOrCreateOrder();
        
        $orderItem = $this->getOrderItem($request['item'], $order->id);

        if($orderItem)
            return $orderItem->delete();
            
        return false;
    }
}