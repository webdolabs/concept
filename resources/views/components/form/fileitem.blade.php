<div class="flex justify-between px-4 py-2 mb-2 bg-white">
    @if(isset($image))
        <div 
            x-data="{ show: false }" 
            @keydown.escape="show = false" 
            class="relative w-12 h-12 bg-gray-700 bg-center bg-cover rounded-lg" 
            style="background-image: url('{{ $image }}')"
        >
            <button @click="show = true" class="flex items-center justify-center w-full h-full transition duration-200 ease-in-out opacity-0 hover:opacity-100" type="button" name="button">
                <svg class="w-10 h-10 p-2 text-white bg-black rounded-lg bg-opacity-60 opacity-80" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                </svg>
            </button>
            <div x-show="show" class="fixed inset-0 z-40 overflow-y-auto" style="display: none;">
                <div class="fixed inset-0 transition-opacity">
                    <div class="fixed inset-0 bg-black bg-opacity-40"></div>
                    <button 
                        @click="show = false"
                        type="button"
                        class="absolute z-50 w-8 h-8 text-gray-100 cursor-pointer top-4 right-4" 
                    >
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <img 
                    @click.away="show = false" 
                    class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                    src="{{ $image }}" 
                    alt="" 
                    style="top: 50%;left: 50%;"
                >
            </div>
        </div>
    @endif
    
    <div class="flex items-center space-x-2">
        <button class="flex items-center justify-center w-8 h-8 rounded text-light-blue-700 bg-light-blue-300">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.75 19.25L9 18.25L18.9491 8.30083C19.3397 7.9103 19.3397 7.27714 18.9491 6.88661L17.1134 5.05083C16.7228 4.6603 16.0897 4.6603 15.6991 5.05083L5.75 15L4.75 19.25Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M14.0234 7.03906L17.0234 10.0391" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <button wire:click="{{ $delete }}" class="flex items-center justify-center w-8 h-8 text-red-700 bg-red-300 rounded">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.75 7.75L6.59115 17.4233C6.68102 18.4568 7.54622 19.25 8.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75H5.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M9.75 10.75V16.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M13.25 10.75V16.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M8.75 7.75V6.75C8.75 5.64543 9.64543 4.75 10.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M4.75 7.75H18.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>
</div>