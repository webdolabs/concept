{{-- <div class="max-w-lg pt-6 mx-auto">
    <div class="flex items-center justify-between w-full px-6 py-4 bg-gray-50">
        <h2 class="text-lg font-bold">GoPay</h2>
        <button wire:click="submit" class="btn-primary">Uložit</button>
    </div>
    <div class="w-full px-6 pt-4 pb-8 space-y-4 bg-white">
        <x-input wire:model.defer="form.gp_goid" name="gp_goid" label="Goid" placeholder=""/>
        <x-input wire:model.defer="form.gp_ClientID" name="ClientID" label="ClientID" placeholder=""/>
        <x-input wire:model.defer="form.gp_ClientSecret" name="ClientSecret" label="ClientSecret" placeholder=""/>
        <x-input wire:model.defer="form.gp_return_url" name="return_url" label="return_url" placeholder=""/>
        <x-input wire:model.defer="form.gp_test" name="test" label="Testovací režim" placeholder="true/false"/>
    </div>
</div> --}}
<div>
    <div x-data="{ open: false }" class="max-w-lg pt-6 mx-auto">
        <div 
            class="flex items-center justify-between w-full px-6 py-4 bg-white shadow-sm cursor-pointer"
            :class="{
                'rounded-t-lg': open,
                'rounded-lg shadow': !open
            }"
            @click="open = !open"
        >
            <div>
                <div class="flex items-center">
                    {{-- <div class="h-8 px-3 py-1.5 flex items-center" style="background: #ba1b03">
                        <img class="h-full" src="https://www.zasilkovna.cz/_nuxt/8c3c1900d41168cc70c3299315a994a8.svg" alt="">
                    </div> --}}
                    <div class="flex items-center h-8 py-1">
                        <img class="h-full" src="https://widget.packeta.com/v6/static/media/logo-hd.2a05c702.svg" alt="">
                    </div>
                    <p class="pl-4 text-sm font-semibold text-green-500">Aktivní</p>
                </div>
                <p class="pt-2 text-sm text-gray-500">Nastavení integrace podání zásilek a generování widgetu.</p>
            </div>
            <svg 
                class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                :class="{
                    ' transform rotate-180': open
                }"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
        <div x-show="open" class="w-full px-6 pt-4 pb-8 space-y-4 bg-white rounded-b-lg">
            <x-input wire:model.defer="form.zasilkovna_apikey" name="zasilkovna_apikey" label="APIKEY" placeholder=""/>
            <div class="flex justify-end pt-4">
                <button wire:click="submit" class="btn-primary">
                    <span class="px-2 py-1">Uložit</span>
                </button>
            </div>
        </div>
    </div>

    <div x-data="{ open: false }" class="max-w-lg pt-6 mx-auto">
        <div 
            class="flex items-center justify-between w-full px-6 py-4 bg-white shadow-sm cursor-pointer"
            :class="{
                'rounded-t-lg': open,
                'rounded-lg shadow': !open
            }"
            @click="open = !open"
        >
            <div>
                <div class="flex items-center">
                    <div class="flex items-center h-8 py-1">
                        <img class="h-full" src="https://www.gopay.com/blog/wp-content/themes/v2020/assets/img/gopay-logo.svg" alt="">
                    </div>
                    <p class="pl-4 text-sm font-semibold text-green-500">Aktivní</p>
                </div>
                <p class="pt-2 text-sm text-gray-500">Nastavení integrace platební brány od společnosti GoPay.</p>
            </div>
            <svg 
                class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                :class="{
                    ' transform rotate-180': open
                }"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
        <div x-show="open" class="w-full px-6 pt-4 pb-8 space-y-4 bg-white rounded-b-lg">
            <x-input wire:model.defer="form.gp_goid" name="gp_goid" label="Goid" placeholder=""/>
            <x-input wire:model.defer="form.gp_ClientID" name="ClientID" label="ClientID" placeholder=""/>
            <x-input wire:model.defer="form.gp_ClientSecret" name="ClientSecret" label="ClientSecret" placeholder=""/>
            <x-input wire:model.defer="form.gp_return_url" name="return_url" label="return_url" placeholder=""/>
            <x-input wire:model.defer="form.gp_test" name="test" label="Testovací režim" placeholder="true/false"/>
            <div class="flex justify-end pt-4">
                <button wire:click="submit" class="btn-primary">
                    <span class="px-2 py-1">Uložit</span>
                </button>
            </div>
        </div>
    </div>
</div>