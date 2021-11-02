<div>
    @section('title')
        {{ __('web/settings.title') }}
    @endsection
    <div class="w-full">
        <nav class="flex flex-col w-full py-3 pl-5 pr-6 mx-auto mb-6 space-x-3 text-sm font-medium leading-5 bg-white lg:flex-row text-blue-gray-500">
            <x-layout.subnav-item url="ecommerce/settings/general">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span>Obecné nastavení</span>
            </x-layout.subnav-item>
            <x-layout.subnav-item url="ecommerce/settings/marketing">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                </svg>
                <span>Marketing</span>
            </x-layout.subnav-item>
            <x-layout.subnav-item url="ecommerce/settings/connections">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
                <span>Propojení</span>
            </x-layout.subnav-item>
        </nav>
        @livewire('ecommerce.settings.' . $page)
    </div>
</div>