@props(['title', 'right' => null, 'submit' => null])
@if($submit)
<form wire:submit.prevent="{{ $submit }}" class="max-w-lg pt-6 mx-auto mb-6">
    <x-validation-errors/>
@else
<div class="max-w-lg pt-6 mx-auto mb-6">
@endif
    <div class="flex items-center justify-between w-full px-6 py-4 bg-gray-50">
        <h2 class="text-lg font-bold">{{ $title }}</h2>
        {{ $right }}
    </div>
    <div class="w-full px-6 pt-4 pb-8 space-y-4 bg-white">
        {{ $slot }}
    </div>
@if($submit)
</form>
@else
</div>
@endif