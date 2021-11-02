<?php

namespace App\Http\Livewire\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\OrderItem;
use App\Models\Ecommerce\OrderAddress;
use Livewire\WithPagination;
use Livewire\Component;

use SoapClient;
use SoapFault;

class Orders extends Component
{
    use WithPagination;

    public $order;
    public $packageDetails = [];
    public $cart;
    public $statuses = [
        'canceled',
        'waiting-for-payment',
        'waiting-for-packing',
        'packing',
        'waiting-for-send',
        'send',
        'delivered',
        'done'
    ];
    public $status;
    public $select = [];
    public $filter = [];
    public $filterForm = ['status'=>[]];

    public function submitPackageZasilkovna()
    {
        $gw = new SoapClient('http://www.zasilkovna.cz/api/soap.wsdl');
        //$apiPassword = "3120a6b3c3b20d97392425ce88fa0991"config('option.zasilkovna_apikey');
        $apiPassword = config('option.zasilkovna_apikey');

        try {
            $packet = $gw->createPacket($apiPassword, array(
                'number' => $this->order->billing_number,
                'name' => $this->order->shippingAddress->first_name ?? $this->order->billingAddress->full_name,
                'surname' => $this->order->shippingAddress->last_name ?? $this->order->billingAddress->last_name,
                'email' => $this->order->email,
                'phone' => $this->order->billingAddress->telephone_number,
                'addressId' => $this->order->shipping_type == 'zasilkovna_na_adresu' ? 106 : $this->order->delivery_number,
                'street' => $this->order->shippingAddress->street ?? $this->order->billingAddress->street,
                'houseNumber' => $this->order->shippingAddress->street_plus ?? $this->order->billingAddress->street_plus,
                'city' => $this->order->shippingAddress->city ?? $this->order->billingAddress->city,
                'zip' => $this->order->shippingAddress->post_code ?? $this->order->billingAddress->post_code,
                'cod' => $this->order->payment_type == 'on-delivery' ? $this->order->total_VAT : 0,
                'value' => $this->order->total_VAT,
                'weight' => $this->packageDetails['weight'],
            ));
        }
        catch(SoapFault $e) {
            return flashError([
                'title' => 'Chyba při podání!',
                'message' => 'Nepodařilo se podat zásilku, můžete to udělat ručně.',
            ], $this);
        }
        $this->order->weight = $this->packageDetails['weight'];
        $this->order->status = 'packing';
        $this->order->save();
        $this->status = array_search('packing', $this->statuses);

        return flashSuccess([
            'title' => 'Zásilka úspěšně podána!',
            'message' => 'Zásilka byla úspěšně nahrána do databáze Zásilkovny.',
        ], $this);
    }

    public function submitFilter()
    {
        $this->filter = $this->filterForm;
        $this->resetPage();
    }

    public function showOrder($id)
    {
        $this->order = Order::find($id);
        //$this->cart = OrderItem::where('order_id', $this->order->id)->get();
        $this->status = array_search($this->order->status, $this->statuses);
    
        $this->packageDetails['weight'] = $this->order->weight;
    }

    public function closeOrder()
    {
        $this->order = null;
    }

    public function changeMultipleStatus($status)
    {
        if(!empty($this->select)) {
            foreach($this->select as $id) {
                $order = Order::find($id);
                $order->status = $status;
                $order->save();
            }
            flashSuccess([
                'title' => 'Status změněn!',
                'message' => 'Statusy byly  objednávek úspěšně změněny.',
            ], $this);
            $this->select = [];
        }
    }

    public function changeStatus($status, $id)
    {
        $this->order->status = $status;
        $this->order->save();
        $this->status = $id;
    }

    public function mount()
    {
        
    }

    public function render()
    {
        $orders = Order::where('submited', '1');
        foreach($this->filter as $key => $filter) {
            if(!empty($filter)) {
                $orders = $orders->whereIn($key, $filter);
            }
        }
        $orders = $orders->orderBy('submited_at', 'desc')->paginate(25);
        return view('livewire.ecommerce.orders')->with('orders', $orders);
    }
}