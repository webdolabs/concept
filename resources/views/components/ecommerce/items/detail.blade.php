<div>
    @if($item)
        
        <x-modal wireClose="closeItem">
            <x-slot name="header">
                <p class="font-bold">Detail objednávky</p>
                <p class="text-sm">Informace o objednávce sloužící k odeslání zásilky.</p>
            </x-slot>
            <div class="flex flex-col">
                <p class="px-1 py-3 text-lg font-bold">Přidat změnu</p>
                <div class="mb-4">
                    <x-input wire:model.defer="submitManipulation.manipulation" name="manipulation" label="Změna"/>
                </div>
                <div class="mb-4">
                    <x-textarea wire:model.defer="submitManipulation.note" name="note" label="Poznámka" />
                </div>
                <div class="mb-4">
                    <button wire:click="submitManipulation" type="button" class="btn-primary">
                        <span class="px-3 py-1">Přidat</span>
                    </button>
                </div>
            </div>
            <p class="px-1 py-3 text-lg font-bold">Pohyby s položkou</p>
            <div class="text-sm leading-6 border-t border-l border-r sm:text-right">
                @foreach ($item['manipulations'] as $record)
                    <div class="flex justify-between px-4 py-2 border-b">
                        <div>
                            {{ date("H:i d.m.Y", strtotime($record->created_at)) }} - Manipulace
                        </div>
                        <div class="font-bold">
                            {{ $record->manipulation }}
                        </div>
                    </div>
                @endforeach
                @foreach ($item['order_items'] ?? null as $record)
                    <div class="flex justify-between px-4 py-2 border-b">
                        <div>
                            {{ date("H:i d.m.Y", strtotime($record->order->submited_at)) }} - Objednávka {{ $record->order->billing_number ?? null }}
                        </div>
                        <div class="font-bold">
                            {{ $record->quantity }}
                        </div>
                    </div>
                @endforeach
            </div>
        </x-modal>
    @endif
</div>