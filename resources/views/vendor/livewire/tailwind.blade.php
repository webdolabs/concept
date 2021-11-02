<div class="w-full">
    @if ($paginator->hasPages())
        <div class="flex justify-between flex-1 sm:hidden">
            <span>
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" dusk="previousPage.before" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                        {!! __('pagination.previous') !!}
                    </button>
                @endif
            </span>

            <span>
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" dusk="nextPage.before" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                        {!! __('pagination.next') !!}
                    </button>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </span>
        </div>

        <div class="flex-col hidden sm:flex">
            <div>
                <p class="text-sm leading-5 text-gray-700">
                    <span>Zobrazen</span>
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    <span> až </span>
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    <span> výsledek (z </span>
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>výsledků)</span>
                </p>
            </div>

            <div class="flex justify-center py-4">
                <div class="flex items-center justify-center space-x-1">
                    @if ($paginator->onFirstPage())
                        <span class="p-2 text-sm text-gray-400 rounded-lg hover:text-light-blue-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <button wire:click="previousPage" dusk="previousPage.after" rel="prev" class="p-2 text-sm text-gray-400 rounded-lg hover:text-light-blue-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                    @endif
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <div class="px-2 text-gray-400">{{ $element }}</div>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span wire:key="paginator-page{{ $page }}">
                                    @if ($page == $paginator->currentPage())
                                        <div aria-current="page" class="py-2 text-sm text-center text-white rounded-lg w-9 bg-light-blue-500">
                                            {{ $page }}
                                        </div>
                                    @else
                                        <button wire:click="gotoPage({{ $page }})" class="py-2 text-sm text-gray-500 bg-white rounded-lg w-9 hover:text-light-blue-500">
                                            {{ $page }}
                                        </button>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" dusk="nextPage.after" rel="next" class="p-2 text-sm text-gray-400 rounded-lg hover:text-light-blue-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @else
                        <span class="p-2 text-sm text-gray-400 rounded-lg hover:text-light-blue-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
