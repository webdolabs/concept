@props(['title' => null, 'buttons' => null])

<div class="flex items-center justify-between w-full h-20 px-6 bg-white shadow-sm">
    <h1 class="py-2 pl-4 text-xl font-bold text-blue-gray-900">
        {{ $title }}
    </h1>
    <div class="flex items-center pr-4 space-x-4">
        {{ $buttons }}
    </div>
</div>

