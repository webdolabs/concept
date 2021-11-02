<?php

namespace App\Http\Livewire\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\OrderItem;
use App\Models\Ecommerce\Item;
use App\Models\Ecommerce\InventoryManipulation;

use Livewire\WithPagination;
use Livewire\Component;

class Items extends Component
{
    use WithPagination;

    public $ordersItems, $paymentWaitingIds;
    public $item = [];
    public $submitManipulation = [];

    public function closeItem() {
        $this->item = [];
    }

    public function submitManipulation() {
        $record = new InventoryManipulation;
        $record->item_id = $this->item['id'];
        $record->manipulation = $this->submitManipulation['manipulation'];
        $record->note = $this->submitManipulation['note'] ?? null;
        $record->save();

        $this->submitManipulation = [];

        $this->showItem($this->item['id']);

        $item = Item::find($this->item['id']);
        $item->quantity = collect($this->item['manipulations'])->sum('manipulation');
        $item->save();
    }

    public function showItem($id) {
        $this->item['id'] = $id;
        $this->item['manipulations'] = InventoryManipulation::where('item_id', $id)->get();
        $ordersIds = Order::where('submited', 1)->get()->pluck('id');
        $this->item['order_items'] = OrderItem::whereIn('order_id', $ordersIds)->where('item_id', $id)->get();
    }

    public function render()
    {
        $this->paymentWaitingIds = Order::where('submited', 1)->where('status', 'waiting-for-payment')->get()->pluck('id');
        $ordersIds = Order::where('submited', 1)->get()->pluck('id');
        $this->ordersItems = OrderItem::whereIn('order_id', $ordersIds)->get();
        $this->ordersItems = collect($this->ordersItems)->groupBy('item_id');
        $items = Item::get();
        $items = collect($items)->groupBy('post_id');
        return view('livewire.ecommerce.items')->with('items', $items);
    }
}