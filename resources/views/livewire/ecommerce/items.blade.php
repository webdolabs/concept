<div>
    @section('title')
        Skladové položky
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <a href="{{ url('web/item/create') }}" class="btn-primary">
                <span class="px-3 py-1">Vytvořit novou položku</span>
            </a>
        </div>
    </x-layout.page-title>

    <x-ecommerce.items.detail :item="$item"/>

    <div 
        x-data="{
            selected: []
        }"
        class="flex flex-col max-w-2xl mx-auto"
    >
        <div class="">
            @foreach($items as $post)
                <div class="flex justify-between px-6 py-5 mb-2 bg-white">
                    <div>{{ $post->first()->post->locale->post_title }}</div>
                    <div class="flex divide-x divide-gray-300">
                        @foreach($post as $item)
                            <button wire:click="showItem('{{ $item->id }}')" class="w-20 py-2 text-center hover:bg-gray-300">
                                <p class="font-bold">{{ $item->sub_name }}</p>
                                <p class="text-sm text-gray-600">
                                    @if(isset($ordersItems[$item->id]))
                                        {{ $item->quantity - collect($ordersItems[$item->id])->whereNotIn('order_id', $paymentWaitingIds)->sum('quantity') }}
                                    @else
                                        {{ $item->quantity }}
                                    @endif
                                    /
                                    @if(isset($ordersItems[$item->id]))
                                        {{ $item->quantity - $ordersItems[$item->id]->sum('quantity') }}
                                    @else
                                        {{ $item->quantity }}
                                    @endif
                                </p>
                                <p class="text-sm text-gray-600">
                                    @if(isset($ordersItems[$item->id]))
                                        {{ collect($ordersItems[$item->id])->whereNotIn('order_id', $paymentWaitingIds)->sum('quantity') }}
                                    @else
                                        0
                                    @endif
                                    /
                                    @if(isset($ordersItems[$item->id]))
                                        {{ $ordersItems[$item->id]->sum('quantity') }}
                                    @else
                                        0
                                    @endif
                                </p>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex items-center justify-center pt-4">
            {{-- {{ $items->links() }} --}}
        </div>
    </div>
</div>