@props(['inputId' => rand(1111111, 9999999), 'name', 'label' => null, 'size' => 'sm', 'type' => 'text', 'startLabel' => null, 'endLabel' => null])
<div class="w-full text-sm">
    @if($label)
        <label for="{{ $inputId }}" class="pl-2 text-blue-gray-500">
            {{ $label }} @error($name) - <span class="font-normal text-red-500">{{ $message }}</span> @enderror
        </label>
    @endif
    <div class="relative mt-1">
        @if ($startLabel)
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm sm:leading-5">
                {{ $startLabel }}
            </span>
        </div>
        @endif

        <input 
            id="{{ $inputId }}" 
            name="{{ $name }}" 
            type="{{ $type }}" 
            {!! $attributes !!} 
            class="w-full {{ $size == 'lg' ? 'px-6 py-3' : 'px-4 py-2' }} bg-white border rounded-lg form focus:outline-none border-gray-300  @error($name) border-red-300 @enderror" 
        />

        @if ($endLabel)
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm sm:leading-5">
                {{ $endLabel }}
            </span>
        </div>
        @endif
    </div>

</div>