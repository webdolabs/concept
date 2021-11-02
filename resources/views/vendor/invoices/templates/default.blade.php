<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css" media="screen">
            body {
                font-family: "dejavu sans", serif;
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
                margin-top: 0pt;
            }
            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }
            p {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }
            strong {
                font-weight: bolder;
            }
            img {
                vertical-align: middle;
                border-style: none;
            }
            table {
                border-collapse: collapse;
            }
            th {
                text-align: inherit;
            }
            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }
            h4, .h4 {
                font-size: 1rem;
            }
            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }
            .table th {
                vertical-align: top;
            }
            .table td {
                vertical-align: top;
                padding-top: 4px;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 1px solid #000;
                padding-bottom: 4px;
            }
            .table tbody + tbody {
                border-top: 2px solid #dee2e6;
            }
            .mt-5 {
                margin-top: 3rem !important;
            }
            .pt-10 {
                padding-top: 6rem;
            }
            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }
            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }
            .text-right {
                text-align: right !important;
            }
            .text-center {
                text-align: center !important;
            }
            .text-uppercase {
                text-transform: uppercase !important;
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1rem;
                font-weight: 400;
                padding-top: 1rem;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border: none !important;
            }
            .buyer {
                line-height: 1;
            }
        </style>
    </head>

    <body>
        {{-- Header --}}
        @if($invoice->logo)
            <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
        @endif
        <table class="table mt-5">
            <tbody>
                <tr>
                    <td class="pl-0 border-0" width="70%">
                        <h4 class="">
                            <strong>Faktura - Daňový doklad</strong>
                        </h4>
                    </td>
                    <td class="pl-0 border-0">
                        <p>Číslo faktury: <strong>{{ $invoice->getSerialNumber() }}</strong></p>
                        <p>Datum vytvoření: <strong>{{ $invoice->getDate() }}</strong></p>
                        <p>Datum splatnosti: <strong>{{ $invoice->getPayUntilDate() }}</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4 class="party-header">Prodávající</h4>  
        <div>
            {{ $invoice->seller->name }} <br>
            {{ $invoice->seller->address }}, <br>
            IČ: {{ $invoice->seller->code }}, 
            @if($invoice->seller->vat)
                DIČ: {{ $invoice->seller->vat }},
            @else
                NEPLÁTCE DPH,
            @endif
            Tel: {{ $invoice->seller->phone }}
        </div>
        <h4 class="party-header">Zákazník</h4>  
        <table class="table">
            <tr>
            <td>
            <p class="buyer">
                <strong>Fakturační údaje:</strong>
            </p>
            @if($invoice->buyer->name)
                <p class="buyer">
                    {{ $invoice->buyer->name }}
                </p>
            @endif

            @if($invoice->buyer->address)
                <p class="buyer">
                    {{ $invoice->buyer->address }}
                </p>
            @endif

            @foreach($invoice->buyer->custom_fields as $key => $value)
                <p class="buyer">
                    {{ $value }}
                </p>
            @endforeach
            </td>
            {{-- <td>
            @if($invoice->buyer->name)
                <p class="buyer-name">
                    <strong>{{ $invoice->buyer->name }}</strong>
                </p>
            @endif
            @if($invoice->buyer->address)
                <p class="buyer-address">
                    {{ $invoice->buyer->address }}
                </p>
            @endif
            @foreach($invoice->buyer->custom_fields as $key => $value)
                <p class="buyer-custom-field">
                    {{ $value }}
                </p>
            @endforeach
            </td> --}}
            </tr>
        </table>

        {{-- Table --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="pl-0">Název</th>
                    @if($invoice->hasItemUnits)
                        <th scope="col" class="text-center">Jednotka</th>
                    @endif
                    <th scope="col">Cena za ks</th>
                    <th scope="col" class="text-center">Počet</th>
                    @if($invoice->hasItemDiscount)
                        <th scope="col" class="text-right">{{ __('invoices::invoice.discount') }}</th>
                    @endif
                    @if($invoice->hasItemTax)
                        <th scope="col" class="text-right">{{ __('invoices::invoice.tax') }}</th>
                    @endif
                    <th scope="col" class="pr-0 text-right">Cena</th>
                </tr>
            </thead>
            <tbody class="mt-5">
                {{-- Items --}}
                @foreach($invoice->items as $item)
                <tr>
                    <td class="pl-0">{{ $item->title }}</td>
                    @if($invoice->hasItemUnits)
                        <td class="text-center">{{ $item->units }}</td>
                    @endif
                    <td>
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    @if($invoice->hasItemDiscount)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->discount) }}
                        </td>
                    @endif
                    @if($invoice->hasItemTax)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->tax) }}
                        </td>
                    @endif

                    <td class="pr-0 text-right">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
                @endforeach
                @if($invoice->hasItemOrInvoiceDiscount())
                    <tr>
                        <td colspan="3" class="pl-0">
                            Sleva
                        </td>
                        <td class="pr-0 text-right">
                            - {{ $invoice->formatCurrency($invoice->total_discount) }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <strong class="pt-10">Shrnutí objednávky: </strong> <br>
        {{-- Summary --}}
        <div>
                @if($invoice->taxable_amount)
                    {{ __('invoices::invoice.taxable_amount') }}:
                    {{ $invoice->formatCurrency($invoice->taxable_amount) }} <br>
                @endif
                @if($invoice->tax_rate)
                    {{ __('invoices::invoice.tax_rate') }}:
                    {{ $invoice->tax_rate }}% <br>
                @endif
                @if($invoice->hasItemOrInvoiceTax())
                    {{ __('invoices::invoice.total_taxes') }}:
                    {{ $invoice->formatCurrency($invoice->total_taxes) }} <br>
                @endif
                @if($invoice->shipping_amount)
                    {{ __('invoices::invoice.shipping') }}:
                    {{ $invoice->formatCurrency($invoice->shipping_amount) }} <br>
                @endif
                    Cena celkem:
                    {{ $invoice->formatCurrency($invoice->total_amount) }} <br>
        </div>
                

        @if($invoice->notes)
            <p>
                {{ trans('invoices::invoice.notes') }}: {!! $invoice->notes !!}
            </p>
        @endif

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>