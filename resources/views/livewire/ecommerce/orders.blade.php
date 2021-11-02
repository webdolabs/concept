<div>
    @section('title')
        Objednávky
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <a href="{{ url('web/product/create') }}" class="btn-primary">
                <span class="px-3 py-1">Vytvořit objednávku</span>
            </a>
        </div>
    </x-layout.page-title>

    <x-ecommerce.orders.detail :status="$status" :statuses="$statuses" :order="$order"/>

    <div 
        x-data="{
            selected: []
        }"
        class="flex flex-col"
    >
        <div class="flex justify-between">
            <div class="flex items-center px-4 pb-4 space-x-2">
                @if(!empty($select))
                    <div class="pr-2 text-sm text-gray-500">Vybrané ({{ count($select) }})</div>
                    <button class="text-red-500 bg-red-100 btn hover:text-red-700">
                        Smazat
                    </button>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="btn bg-light-blue-100 text-light-blue-500 hover:text-light-blue-700">
                            Změnit status
                        </button>
                        <div @click.away="open = false" x-show="open" class="absolute z-30 flex flex-col text-sm shadow-md -right-1/2 bg-blue-gray-800 top-12 rounded-xl text-blue-gray-400 whitespace-nowrap">
                            @foreach ($statuses as $key => $statusSlug)
                                <button @click="open = false" wire:click="changeMultipleStatus('{{ $statusSlug }}')" class="py-2.5 text-left hover:bg-blue-gray-700 pl-6 pr-8 hover:text-white cursor-pointer {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }}">
                                    {{ __('ecommerce/orders.badge.' . $statusSlug) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="flex items-center px-4 pb-4 space-x-2">
                <div class="pr-2 text-sm text-gray-500">Filtr:</div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="px-4 py-2 text-sm text-gray-600 bg-blue-900 rounded-lg bg-opacity-5 hover:bg-opacity-10">
                        Status
                    </button>
                    <div @click.away="open = false" x-show="open" style="display: none" class="absolute right-0 z-30 flex flex-col py-5 text-sm text-gray-800 bg-white shadow-md px-7 top-12 rounded-xl whitespace-nowrap">
                        @foreach ($statuses as $key => $statusSlug)
                            <label class="flex items-center justify-start mb-2">
                                <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border border-gray-300 rounded">
                                    <input wire:model.defer="filterForm.status" value="{{ $statusSlug }}" type="checkbox" class="absolute opacity-0 checkbox" />
                                    <svg class="w-3 h-3 transition duration-200 ease-in-out transform opacity-0 fill-current text-light-blue-500" viewBox="0 0 20 20">
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                    </svg>
                                </div>
                                {{ __('ecommerce/orders.badge.' . $statusSlug) }}
                            </label>
                        @endforeach
                        <button @click="open = false" wire:click="submitFilter()" type="button" class="w-full mt-2 btn-primary">
                            <span class="w-full text-center">Použít</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-4 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 pl-6"></th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                                    Titulek
                                </th>
                                <th scope="col" class="px-5 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                                    Status
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                                    Vytvoření
                                </th>
                                <th scope="col" class="py-3 pr-6"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td class="py-3 pl-6 whitespace-nowrap">
                                        <label class="flex items-center justify-start mb-1">
                                            <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border border-gray-300 rounded">
                                                <input wire:model.lazy="select" value="{{ $order->id }}" type="checkbox" class="absolute opacity-0 checkbox" />
                                                <svg class="w-3 h-3 transition duration-200 ease-in-out transform opacity-0 fill-current text-light-blue-500" viewBox="0 0 20 20">
                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                </svg>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="w-full px-4 py-3 whitespace-nowrap">
                                        <button wire:click="showOrder('{{ $order->id }}')" type="button" class="text-left text-gray-900 hover:text-light-blue-500">
                                            <div>
                                                {{ $order->billingAddress->first_name }} {{ $order->billingAddress->last_name }} - {{ $order->billingAddress->city }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Cena: {{ $order->total_VAT }} Kč
                                            </div>
                                        </button>
                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <span class="badge-{{ $order->status }} px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">
                                            {{ __('ecommerce/orders.badge.' . $order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-right text-gray-500 whitespace-nowrap">
                                        {{ date("H:i d.m.Y", strtotime($order->submited_at)) }}
                                    </td>
                                    <td class="py-3 pr-6 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="#" class="text-yellow-400 hover:text-yellow-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="#" class="text-light-blue-400 hover:text-light-blue-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <a href="#" class="text-red-400 hover:text-red-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <style>
                            .badge-done {
                                color: #fff;
                                background: #059669;
                            }
                            .badge-delivered {
                                color: #059669;
                                background: #D1FAE5;
                            }
                            .badge-send {
                                color: #D97706;
                                background: #FEF3C7;
                            }
                            .badge-waiting-for-send {
                                color: #475569;
                                background: #F1F5F9;
                            }
                            .badge-packing {
                                color: #2563EB;
                                background: #DBEAFE;
                            }
                            .badge-waiting-for-packing {
                                color: #7C3AED;
                                background: #EDE9FE;
                            }
                            .badge-waiting-for-payment {
                                color: #DC2626;
                                background: #FEE2E2;
                            }
                            .badge-canceled {
                                color: #fff;
                                background: #DC2626;
                            }
                        </style>
                    </table>
                </div>
             </div>
        </div>
        <div class="flex items-center justify-center pt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>