@props(['alpineVar' => null, 'wire' => null, 'wireClose' => null, 'size' => 'lg', 'title' => null, 'header' => null, 'footer' => null])

<div 
    @if($alpineVar) 
        x-show="{{ $alpineVar }}" @click="{{ $alpineVar }} = false" 
        @close-modal.window="{{ $alpineVar }} = false"
    @endif
    @if($wireClose) wire:click="{{ $wireClose }}" @elseif($wire) wire:click="$set('{{ $wire }}', null)" @endif
    class="fixed inset-0 z-50 bg-black bg-opacity-30"
></div>
<div 
    @if($alpineVar) x-show="{{ $alpineVar }}" @endif 
    class="fixed inset-0 z-50 flex flex-col items-center justify-start py-12 overflow-y-auto"
    style="height: 100vh"
>
    <div @if($alpineVar) @closemodal.window="{{ $alpineVar }} = false" @endif></div>
    <div class="flex flex-col w-full {{ $size == 'lg' ? 'max-w-3xl' : 'max-w-xl' }} bg-gray-100 shadow-lg rounded-xl">
        @if($header)
            <div class="flex items-center justify-between px-6 py-6 text-white bg-gray-800 shadow-sm sm:px-9 rounded-t-xl">
                <div>
                    {{ $header }}
                </div>
                <button
                    @if($alpineVar) @click="{{ $alpineVar }} = false" @endif 
                    @if($wireClose) wire:click="{{ $wireClose }}" @elseif($wire) wire:click="$set('{{ $wire }}', null)" @endif
                    type="button"
                    class="flex items-center justify-center w-10 h-10 text-gray-100 rounded-full opacity-50 cursor-pointer hover:bg-gray-900"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            @else
            <div class="flex items-center justify-between px-6 py-6 sm:px-9">
                <p class="font-bold">{{ $title }}</p>
                <button class="flex items-center justify-center w-10 h-10 text-gray-100 rounded-full opacity-50 cursor-pointer hover:bg-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <button 
                    @if($alpineVar) @click="{{ $alpineVar }} = false" @endif 
                    @if($wireClose) wire:click="{{ $wireClose }}" @elseif($wire) wire:click="$set('{{ $wire }}', null)" @endif
                    type="button"
                    class="flex items-center justify-center w-10 h-10 text-gray-600 rounded-full opacity-50 cursor-pointer hover:bg-gray-200"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif
        <div class="px-6 py-6 bg-white shadow-sm sm:px-9 rounded-b-xl">
          {{ $slot }}
        </div>
        @if($footer)
            <div class="px-6 py-2">
                {{ $footer }}
            </div>
        @endif
    </div>
    <div></div>
    <div></div>
</div>