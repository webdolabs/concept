<?php

namespace App\Http\Controllers\Tools;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\OrderItem;
use App\Models\Ecommerce\OrderInvoice;
use App\Models\Ecommerce\OrderAddress;
use App\Http\Controllers\Controller;

class ImportFromPrevVersionController extends Controller
{
    public function importOrders() {
        $orders = json_decode(file_get_contents('../eshop_orders.json'), true);
        $order_items = json_decode(file_get_contents('../eshop_order_items.json'), true);
        $order_address = json_decode(file_get_contents('../eshop_order_address.json'), true);
        $invoices = json_decode(file_get_contents('../eshop_invoices.json'), true);

        foreach($orders as $order) {
            $billingAddress = collect($order_address)->where('order_id', $order['id'])->where('type', 'order')->first();
            if($billingAddress) {
                $billingAddressRecord = new OrderAddress;
                $billingAddressRecord->first_name = $billingAddress['name'];
                $billingAddressRecord->last_name = $billingAddress['surname'];
                $billingAddressRecord->telephone_number = $order['telephone'];
                $billingAddressRecord->street = $billingAddress['street'];
                $billingAddressRecord->street_plus = $billingAddress['number'];
                $billingAddressRecord->city = $billingAddress['city'];
                $billingAddressRecord->post_code = $billingAddress['post_code'];
                $billingAddressRecord->country = $billingAddress['state'];
                $billingAddressRecord->type = 'billing';
                $billingAddressRecord->save();
            }

            $shippingAddress = collect($order_address)->where('order_id', $order['id'])->where('type', 'delivery')->first();
            if($shippingAddress) {
                $shippingAddressRecord = new OrderAddress;
                $shippingAddressRecord->first_name = $shippingAddress['name'];
                $shippingAddressRecord->last_name = $shippingAddress['surname'];
                $shippingAddressRecord->telephone_number = $order['telephone'];
                $shippingAddressRecord->street = $shippingAddress['street'];
                $shippingAddressRecord->street_plus = $shippingAddress['number'];
                $shippingAddressRecord->city = $shippingAddress['city'];
                $shippingAddressRecord->post_code = $shippingAddress['post_code'];
                $shippingAddressRecord->country = $shippingAddress['state'];
                $shippingAddressRecord->type = 'shipping';
                $shippingAddressRecord->save();
            }
            
            $orderRecord = new Order;
            $orderRecord->email = $order['email'];
            $orderRecord->locale = "cs";
            $orderRecord->currency_symbol = "Kč";
            $orderRecord->status = $order['status'];
            $orderRecord->delivery_number = $order['shipment_code'];
            $orderRecord->billing_number = $order['payment_code'];
            $orderRecord->shipping_address_id = null;
            $orderRecord->billing_address_id = $billingAddressRecord->id ?? null;
            if($order['shipment_id'] == 1) { $orderRecord->shipping_type = "zasilkovna"; $orderRecord->shipping_price_VAT = 49; $order['total'] -= 49; }
            elseif($order['shipment_id'] == 2) { $orderRecord->shipping_type = "ceska_posta"; $orderRecord->shipping_price_VAT = 99; $order['total'] -= 99; }
            elseif($order['shipment_id'] == 3) { $orderRecord->shipping_type = "zasilkovna_na_adresu"; $orderRecord->shipping_price_VAT = 109; $order['total'] -= 109; }
            $orderRecord->shipping_id = $order['shipment_id'];
            if($order['payment_id'] == 1) { $orderRecord->payment_type = "on-delivery"; $orderRecord->payment_price_VAT = 19; $order['total'] -= 19; }
            elseif($order['payment_id'] == 2) { $orderRecord->payment_type = "banktransfer"; $orderRecord->payment_price_VAT = 0; }
            elseif($order['payment_id'] == 3) { $orderRecord->payment_type = "gopay-platba-kartou"; $orderRecord->payment_price_VAT = 0; }
            $orderRecord->payment_id = $order['payment_id'];
            $orderRecord->customer_note = $order['note'];
            $orderRecord->admin_note = "old id: " . $order['id'] . ",old code: " . $order['code'];
            $orderRecord->weight = (double)$order['weight'];
            $orderRecord->weight_unit = "Kg";
            $orderRecord->submited = !$order['cart'];
            $orderRecord->payment_waiting = $order['status'] == 'waiting-for-payment' ? 1 : 0;
            $orderRecord->admin_updated_at = !$order['cart'] ? $order['updated_at'] : null;
            $orderRecord->submited_at = $order['submited_at'];
            $orderRecord->created_at = $order['created_at'];
            $orderRecord->updated_at = $order['submited_at'];
            $orderRecord->items_total = $order['total'];
            $orderRecord->items_total_VAT = $order['total'];
            $orderRecord->save();

            $invoice = collect($invoices)->where('order_id', $order['id'])->first();

            if($invoice) {
                $orderRecord->invoice()->create([
                    'prefix' => $invoice['prefix'],
                    'number' => $invoice['number'],
                    'synced' => 0,
                    'created_at' => $invoice['created_at']
                ]);
            }

            $items = collect($order_items)->where('order_id', $order['id'])->all();

            foreach($items as $item) {
                $itemRecord = [
                    'price' => 269,
                    'price_VAT' => 269,
                    'VAT' => 0,
                    'quantity' => $item['quantity'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at']
                ];
                // UELR113903 pio: 94a80d1e-59f5-4f92-bf80-2e834e18e891
                // RUCU401131 250: 94a80d1e-6992-420a-979d-72f0a18f69a4
                // 69AG146013 350: 94a80d1e-7c96-4b8a-a68b-0137159ead27
                // LTHC943101 stad: 94a80d1e-9c71-4845-966b-e280ddca6276
                // HT4D407131 bab: 94a80d1e-8eeb-478d-808f-42dd980b49e2
                
                if($item['variant_id'] == 1) {
                    $itemRecord['item_id'] = '94a80d1e-5cc1-47dd-aa74-9beb3315d235';
                    $itemRecord['name'] = 'Jawa 50 Pionýr';
                    $itemRecord['sub_name'] = 'S';
                }elseif($item['variant_id'] == 2) {
                    $itemRecord['item_id'] = '94a80d1e-5fe9-436b-b4d7-cc28c5c2e876';
                    $itemRecord['name'] = 'Jawa 50 Pionýr';
                    $itemRecord['sub_name'] = 'M';
                }elseif($item['variant_id'] == 3) {
                    $itemRecord['item_id'] = '94a80d1e-620b-4157-be41-9be831d3ac37';
                    $itemRecord['name'] = 'Jawa 50 Pionýr';
                    $itemRecord['sub_name'] = 'L';
                }elseif($item['variant_id'] == 4) {
                    $itemRecord['item_id'] = '94a80d1e-63f8-4a44-94bb-932f7b2e9251';
                    $itemRecord['name'] = 'Jawa 50 Pionýr';
                    $itemRecord['sub_name'] = 'XL';
                }elseif($item['variant_id'] == 5) {
                    $itemRecord['item_id'] = '94a80d1e-6d06-4beb-beb7-d8eb229f3fb1';
                    $itemRecord['name'] = 'Jawa 250';
                    $itemRecord['sub_name'] = 'S';
                }elseif($item['variant_id'] == 6) {
                    $itemRecord['item_id'] = '94a80d1e-6f52-4ff8-9399-695b7cf82d05';
                    $itemRecord['name'] = 'Jawa 250';
                    $itemRecord['sub_name'] = 'M';
                }elseif($item['variant_id'] == 7) {
                    $itemRecord['item_id'] = '94a80d1e-72da-4f02-9de4-191ad3cd61ee';
                    $itemRecord['name'] = 'Jawa 250';
                    $itemRecord['sub_name'] = 'L';
                }elseif($item['variant_id'] == 8) {
                    $itemRecord['item_id'] = '94a80d1e-75d0-48c8-a1ea-90e3d024ad86';
                    $itemRecord['name'] = 'Jawa 250';
                    $itemRecord['sub_name'] = 'XL';
                }elseif($item['variant_id'] == 9) {
                    $itemRecord['item_id'] = '94a80d1e-82be-45ba-b795-e721121d853e';
                    $itemRecord['name'] = 'Jawa 350/634';
                    $itemRecord['sub_name'] = 'S';
                }elseif($item['variant_id'] == 10) {
                    $itemRecord['item_id'] = '94a80d1e-8668-47fd-98c7-839dbe867174';
                    $itemRecord['name'] = 'Jawa 350/634';
                    $itemRecord['sub_name'] = 'M';
                }elseif($item['variant_id'] == 11) {
                    $itemRecord['item_id'] = '94a80d1e-882e-4c78-9e78-f7fe04838238';
                    $itemRecord['name'] = 'Jawa 350/634';
                    $itemRecord['sub_name'] = 'L';
                }elseif($item['variant_id'] == 12) {
                    $itemRecord['item_id'] = '94a80d1e-898c-4b95-a9a5-d105b392eeb1';
                    $itemRecord['name'] = 'Jawa 350/634';
                    $itemRecord['sub_name'] = 'XL';
                }elseif($item['variant_id'] == 13) {
                    $itemRecord['item_id'] = '94a80d1e-922e-4dfd-b85e-f8bdb36da57d';
                    $itemRecord['name'] = 'Babetta 210';
                    $itemRecord['sub_name'] = 'S';
                }elseif($item['variant_id'] == 14) {
                    $itemRecord['item_id'] = '94a80d1e-9456-4870-ac9b-25b79657b1b5';
                    $itemRecord['name'] = 'Babetta 210';
                    $itemRecord['sub_name'] = 'M';
                }elseif($item['variant_id'] == 15) {
                    $itemRecord['item_id'] = '94a80d1e-964f-4fed-ba43-c42054e5794c';
                    $itemRecord['name'] = 'Babetta 210';
                    $itemRecord['sub_name'] = 'L';
                }elseif($item['variant_id'] == 16) {
                    $itemRecord['item_id'] = '94a80d1e-9889-4c68-85a9-f0b19e900869';
                    $itemRecord['name'] = 'Babetta 210';
                    $itemRecord['sub_name'] = 'XL';
                }elseif($item['variant_id'] == 17) {
                    $itemRecord['item_id'] = '94a80d1e-9f21-4605-b6fd-fc72a7dd48b9';
                    $itemRecord['name'] = 'Stadion S11';
                    $itemRecord['sub_name'] = 'S';
                }elseif($item['variant_id'] == 18) {
                    $itemRecord['item_id'] = '94a80d1e-a040-470c-8bb1-39c5d6d7dbab';
                    $itemRecord['name'] = 'Stadion S11';
                    $itemRecord['sub_name'] = 'M';
                }elseif($item['variant_id'] == 19) {
                    $itemRecord['item_id'] = '94a80d1e-a19d-49fe-9e7f-49955c064ecf';
                    $itemRecord['name'] = 'Stadion S11';
                    $itemRecord['sub_name'] = 'L';
                }elseif($item['variant_id'] == 20) {
                    $itemRecord['item_id'] = '94a80d1e-a349-4edb-8015-e66b36842097';
                    $itemRecord['name'] = 'Stadion S11';
                    $itemRecord['sub_name'] = 'XL';
                }elseif($item['variant_id'] == 52) {
                    $itemRecord['item_id'] = '94a80d1e-66f2-448c-9f15-28c9f464bdec';
                    $itemRecord['name'] = 'Jawa 50 Pionýr';
                    $itemRecord['sub_name'] = '2XL';
                }elseif($item['variant_id'] == 53) {
                    $itemRecord['item_id'] = '94a80d1e-6833-476e-92c1-ccef8b50789d';
                    $itemRecord['name'] = 'Jawa 50 Pionýr';
                    $itemRecord['sub_name'] = '3XL';
                }elseif($item['variant_id'] == 54) {
                    $itemRecord['item_id'] = '94a80d1e-784d-481e-8e0b-ebd1e76fee44';
                    $itemRecord['name'] = 'Jawa 250';
                    $itemRecord['sub_name'] = '2XL';
                }elseif($item['variant_id'] == 55) {
                    $itemRecord['item_id'] = '94a80d1e-7aec-4bc9-9f1c-ddc6f6606abb';
                    $itemRecord['name'] = 'Jawa 250';
                    $itemRecord['sub_name'] = '3XL';
                }elseif($item['variant_id'] == 56) {
                    $itemRecord['item_id'] = '94a80d1e-8bb0-4fc1-8820-78f92064a182';
                    $itemRecord['name'] = 'Jawa 350/634';
                    $itemRecord['sub_name'] = '2XL';
                }elseif($item['variant_id'] == 57) {
                    $itemRecord['item_id'] = '94a80d1e-8d26-4333-a149-5d03c5a17068';
                    $itemRecord['name'] = 'Jawa 350/634';
                    $itemRecord['sub_name'] = '3XL';
                }elseif($item['variant_id'] == 58) {
                    $itemRecord['item_id'] = '94a80d1e-99e9-40b9-8cf3-6c7538dda02a';
                    $itemRecord['name'] = 'Babetta 210';
                    $itemRecord['sub_name'] = '2XL';
                }elseif($item['variant_id'] == 59) {
                    $itemRecord['item_id'] = '94a80d1e-9b3f-494e-b8e1-142f62856128';
                    $itemRecord['name'] = 'Babetta 210';
                    $itemRecord['sub_name'] = '3XL';
                }elseif($item['variant_id'] == 60) {
                    $itemRecord['item_id'] = '94a80d1e-a478-4b17-a1ec-94bb531a6bde';
                    $itemRecord['name'] = 'Stadion S11';
                    $itemRecord['sub_name'] = '2XL';
                }elseif($item['variant_id'] == 61) {
                    $itemRecord['item_id'] = '94a80d1e-a80c-4e73-8aee-2b3c49480557';
                    $itemRecord['name'] = 'Stadion S11';
                    $itemRecord['sub_name'] = '3XL';
                }
                $orderRecord->items()->create($itemRecord);
            }
        }

        dd($orders, $order_items, $order_address, $invoices);
    }
}