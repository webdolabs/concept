<a 
    href="{{ url($url) }}"
    class="flex items-center w-full px-5 py-4 group sm:py-2"
>
    @if (explode('/',$url)[0] == explode('/',$_SERVER['REQUEST_URI'])[1] && explode('/',$url)[1] == explode('/',$_SERVER['REQUEST_URI'])[2])
        <div class="flex items-center transition duration-150 rounded-full bg-light-blue-100 text-light-blue-600">
            <div class="flex-none w-10 h-10 p-2 transition duration-150 rounded-full bg-light-blue-200">
                {{ $slot }}
            </div>
            <div class="py-2 pl-4 pr-10 font-semibold">
                {{ $name }}
            </div>
        </div>
    @else
        <div class="flex items-center transition duration-150 rounded-full group-hover:bg-blue-gray-100 group-hover:text-blue-gray-700">
            <div class="flex-none w-10 h-10 p-2 transition duration-150 rounded-full bg-blue-gray-100 group-hover:bg-blue-gray-200">
                {{ $slot }}
            </div>
            <div class="py-2 pl-4 pr-10 font-semibold">
                {{ $name }}
            </div>
        </div>
    @endif
    
</a>