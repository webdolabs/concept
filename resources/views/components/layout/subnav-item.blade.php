@if(explode('/',$_SERVER['REQUEST_URI'])[3] == explode('/',$url)[2])
    <a 
        href="{{ url($url) }}" 
        class="relative flex items-center px-3 py-4 focus:outline-none text-light-blue-500"
    >
        {{ $slot }}
        <span class="hidden md:block absolute bottom-0 w-8 h-0.5 transform -translate-x-1/2 rounded bg-light-blue-400 left-1/2"></span>
    </a>
@else
    <a 
        href="{{ url($url) }}" 
        class="relative flex items-center px-3 py-4 transition duration-150 focus:outline-none hover:text-blue-gray-700 group"
    >
        {{ $slot }}
        <span class="hidden md:block absolute bottom-0 w-8 h-0.5 transform bg-transparent -translate-x-1/2 rounded group-hover:bg-blue-gray-700 left-1/2 transition duration-150"></span>
    </a>
@endif