<div 
    x-data="{
        modalSubmitPackage: false,
        successCopy: false,
        copy(content) {
            var aux = document.createElement('input');
            aux.setAttribute('value', content);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand('copy');
            document.body.removeChild(aux);
            if(this.successCopy == true) {
                this.successCopy = false;
                setTimeout(() => { this.successCopy = true; }, 100);
            }else {
                this.successCopy = true;
            }
            setTimeout(() => { this.successCopy = false; }, 4000);
        }
    }"
>
    @if($order)
        
        <x-modal wireClose="closeOrder">
            <x-slot name="header">
                <p class="font-bold">Detail objednávky</p>
                <p class="text-sm">Informace o objednávce sloužící k odeslání zásilky.</p>
            </x-slot>
            <div class="relative flex flex-col justify-between sm:flex-row">
                <div x-show.transition="successCopy" class="absolute inset-x-0 w-full text-sm font-bold text-center text-green-500 -top-5">
                    Údaj byl zkopírován do schránky!
                </div>
                <div class="text-sm leading-6">
                    <strong>Email</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->email }}</span> <br>
                    <strong>Telefon</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->billingAddress->telephone_number }}</span> <br>

                    <strong>Jméno</strong>: 
                    <span @click="copy($event.target.innerHTML)">{{ $order->billingAddress->first_name }}</span> 
                    <span @click="copy($event.target.innerHTML)">{{ $order->billingAddress->last_name }}</span>
                    <br>
                    @if(isset($order->shippingAddress->first_name) && isset($order->shippingAddress->last_name))
                        <strong>Doručovací jméno</strong>: 
                        <span @click="copy($event.target.innerHTML)">{{ $order->shippingAddress->first_name }}</span> 
                        <span @click="copy($event.target.innerHTML)">{{ $order->shippingAddress->last_name }}</span>
                        <br>
                    @endif

                    <strong>Adresa</strong>: 
                    <span @click="copy($event.target.innerHTML)">{{ $order->billingAddress->street }}</span> 
                    <span @click="copy($event.target.innerHTML)">{{ $order->billingAddress->street_plus }}</span>, 
                    <span @click="copy($event.target.innerHTML)">{{ $order->billingAddress->post_code }}</span> 
                    <span @click="copy($event.target.innerHTML)">{{ $order->billingAddress->city }}</span>
                    <br>
                    @if (isset($order->shippingAddress->street) || isset($order->shippingAddress->number) || isset($order->address['delivery']->post_code) || isset($order->address['delivery']->city))
                        <strong>Doručovací: adresa</strong>: 
                        <span @click="copy($event.target.innerHTML)">{{ $order->shippingAddress->street }}</span> 
                        <span @click="copy($event.target.innerHTML)">{{ $order->shippingAddress->street_plus }}</span>, 
                        <span @click="copy($event.target.innerHTML)">{{ $order->shippingAddress->post_code }}</span> 
                        <span @click="copy($event.target.innerHTML)">{{ $order->shippingAddress->city }}</span>
                        <br>
                    @endif

                    <strong>Stát</strong>: {{ $order->billingAddress->country }} <br>
                    @if (isset($order->shippingAddress->country))
                        <strong>Doručovací stát</strong>: {{ $order->shippingAddress->country }} <br>
                    @endif

                    <strong>Způsob doručení</strong>: {{ $order->shipping->label }} <br>
                    <strong>Způsob platby</strong>: {{ $order->payment->label }} <br>
                    <strong>ID doručení</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->delivery_number }}</span>  <br>
                    <strong>Variabilní symbol</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->billing_number }}</span>  <br>
                </div>
                <div class="flex flex-col items-end mt-2 space-y-2 text-sm leading-6 sm:text-right sm:mt-0">
                    <button @click="modalSubmitPackage = true" type="button" class="flex px-4 py-2 font-semibold text-white bg-green-500 hover:bg-green-600 rounded-xl">
                        Podat zásilku
                    </button>
                    <a 
                        href="{{ url(isset($order->invoice) ? 'ecommerce/invoice/show/' . $order->invoice->id : 'ecommerce/invoice/generate/' . $order->id ) }}" 
                        target="_blank" 
                        class="flex items-center flex-shrink px-4 py-2 font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        Faktura
                    </a>
                    <button wire:click="changeStatus('canceled', 0)" class="px-4 py-2 font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">
                        Storno
                    </button>
                </div>
            </div>
            @if ($order->customer_note)
                <div class="relative pt-3 mt-4">
                    <div class="absolute top-0 px-2 pt-1 text-sm font-bold bg-white left-2">Poznámka</div>
                    <div class="p-4 text-sm leading-6 border">
                        {{ $order->customer_note }}
                    </div>
                </div>
            @endif
            <div class="mt-8 text-sm leading-6 border-t border-l border-r sm:text-right">
                @foreach ($order->items as $item)
                    <div class="flex justify-between px-4 py-2 border-b">
                        <div>
                            {{ $item->quantity }}x {{ $item->name }} - {{ $item->sub_name }}
                        </div>
                        <div>
                            {{ $item->price_VAT }} Kč | {{ $item->price_VAT * $item->quantity }} Kč
                        </div>
                    </div>
                @endforeach
                @if (isset($order->payment) && isset($order->shipping))
                    <div class="flex justify-between px-4 py-2 border-b">
                        <div>
                            Procesní náklady
                        </div>
                        <div>
                            {{ $order->payment_price_VAT + $order->shipping_price_VAT }} Kč
                        </div>
                    </div>
                @endif
                <div class="flex justify-between px-4 py-2 font-bold border-b">
                    <div>
                        Celkem
                    </div>
                    <div>
                        {{ $order->total_VAT }} Kč
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex items-center justify-end space-x-2 text-sm">
                    @if($status > 1)
                        <button wire:click="changeStatus('{{ $statuses[$status-1] }}',{{ $status-1 }})" class="flex items-center px-4 py-2 font-semibold text-white bg-yellow-500 hover:bg-yellow-600 rounded-xl">
                            <span>{{ __('ecommerce/orders.badge.' . $statuses[$status-1]) }}</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </button>
                    @endif
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center btn-transparent">
                            <span>{{ __('ecommerce/orders.badge.' . $statuses[$status]) }}</span>
                        </button>
                        <div @click.away="open = false" x-show="open" class="absolute z-30 flex flex-col text-sm shadow-md -right-1/2 bg-blue-gray-800 bottom-12 rounded-xl text-blue-gray-400 whitespace-nowrap">
                            @foreach ($statuses as $key => $statusSlug)
                                <button @click="open = false" wire:click="changeStatus('{{ $statusSlug }}',{{ $key }})" class="py-2.5 text-left hover:bg-blue-gray-700 pl-6 pr-8 hover:text-white cursor-pointer {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }}">
                                    {{ __('ecommerce/orders.badge.' . $statusSlug) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    @if($status < 7)
                        <button wire:click="changeStatus('{{ $statuses[$status+1] }}',{{ $status+1 }})" class="flex items-center px-4 py-2 font-semibold text-white bg-light-blue-500 hover:bg-light-blue-600 rounded-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            <span>{{ __('ecommerce/orders.badge.' . $statuses[$status+1]) }}</span>
                        </button>
                    @endif
                </div>
            </x-slot>
        </x-modal>
        <x-modal alpineVar="modalSubmitPackage" size="sm" title="Podání zísilky">
            <div class="grid grid-cols-3">
                <div class="text-sm py-2.5 font-bold text-gray-600">Typ dopravce:</div>
                <div x-data="{ open: false, type: 'Zasilkovna' }" class="relative col-span-2">
                    <div @click="open = !open" class="flex w-full px-4 py-2 text-sm bg-white border border-gray-300 rounded-lg">
                        <input x-model="type" disabled type="text" placeholder="Vybrat službu" class="w-full pr-3 text-black truncate form disabled:bg-white"/>
                        <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                        <span :class="{ 'transform rotate-180': open }" class="absolute top-3 right-4 text-blue-gray-400">
                            <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </div>
                    <div @click.away="open = false" x-show="open" class="transition duration-200 ease-in-out">
                        <div @click="open = !open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                            <span @click="type = 'Zasilkovna'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Zasilkovna</span>
                            <span @click="type = 'DPD'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">DPD</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 mt-6">
                <div class="text-sm py-2.5 font-bold text-gray-600">Váha:</div>
                <div class="col-span-2">
                    <x-input wire:model.defer="packageDetails.weight" name="weight" endLabel="Kg"></x-input>
                </div>
            </div>
            <button @click="modalSubmitPackage = false" wire:click="submitPackageZasilkovna" type="button" class="flex px-4 py-2 mt-6 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-xl">
                Podat zásilku
            </button>
        </x-modal>
    @endif
</div>