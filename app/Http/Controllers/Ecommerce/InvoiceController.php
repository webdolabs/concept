<?php

namespace App\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\OrderItem;
use App\Models\Ecommerce\OrderInvoice;
use LaravelDaily\Invoices\Invoice as PdfInvoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function show($id) {
        $invoice = OrderInvoice::findOrFail($id);
        $order = Order::find($invoice->order_id);
        
        if($order->billingAddress->country == 'czech' || !$order->billingAddress->country) {
            $order->billingAddress->country = "Česká republika";
        }

        $customer = new Buyer([
            'name'          => $order->billingAddress->first_name . " " . $order->billingAddress->last_name,
            'address'       => $order->billingAddress->street . " " . $order->billingAddress->street_plus,
            'custom_fields' => [
                'address_2' => $order->billingAddress->post_code . " " . $order->billingAddress->city,
                'state' => $order->billingAddress->state,
            ],
        ]);

        $fileName = str_shuffle(date("jmi")) . strtolower($order->billingAddress->last_name) . $invoice->prefix . $invoice->number . '.pdf';

        $invoicePdf = PdfInvoice::make()
            ->serialNumberFormat($invoice->prefix . $invoice->number)
            ->date($invoice->created_at)
            ->buyer($customer)
            ->filename($fileName);

        foreach($order->items as $item) {
            $item = (new InvoiceItem())
                ->title($item->name . ' - ' . $item->sub_name)
                ->pricePerUnit($item->price_VAT)
                ->quantity($item->quantity);
            $invoicePdf = $invoicePdf->addItem($item);
        }

        if($order->shipping->price_VAT > 0) {
            $item = (new InvoiceItem())->title('Doprava: ' . $order->shipping->label)->pricePerUnit($order->shipping->price_VAT);
            $invoicePdf = $invoicePdf->addItem($item);
        }

        if($order->payment->price_VAT > 0) {
            $item = (new InvoiceItem())->title($order->payment->label)->pricePerUnit($order->payment->price_VAT);
            $invoicePdf = $invoicePdf->addItem($item);
        }
        
        // if($invoice->sale) {
        //     $invoicePdf = $invoicePdf->discountByPercent($invoice->sale);
        // }
        
        return $invoicePdf->stream();
    }

    public function generate($orderId)
    {
        $latest = OrderInvoice::whereYear('created_at', '=', date('Y'))->orderBy('created_at', 'desc')->pluck('number')->first();
        if(!$latest) {
            $latest = date('y') * 1000000;
        }
        if(!OrderInvoice::where('order_id', $orderId)->exists()) {
            $invoice = new OrderInvoice;
            $invoice->prefix = "FA";
            $invoice->number = $latest+1;
            $invoice->order_id = $orderId;
            $invoice->save();
        }
        $invoice = OrderInvoice::where('order_id', $orderId)->first();
        return redirect('ecommerce/invoice/show/' . $invoice->id);
    }
}