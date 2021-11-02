<div class="flex items-center">
    <span class="inline-flex items-center justify-center flex-none w-12 h-12 rounded-full bg-light-blue-200">
        <span class="text-xl font-medium leading-none text-light-blue-500">
            {{ substr(explode(" ", Auth::user()->name)[0], 0, 1) ?? null . substr(explode(" ", Auth::user()->name)[1], 0, 2) ?? null }}
        </span>
    </span>
    <div class="ml-3">
        <p class="text-sm font-medium leading-5 text-gray-700 group-hover:text-gray-900">
            {{ Auth::user()->name }}
        </p>
        <form method="POST" action="{{ url('logout') }}" class="flex text-xs leading-4 text-gray-500 transition duration-150 ease-in-out">
            @csrf
            <a href="{{ url('user/profile') }}" class="pr-2 font-medium hover:text-gray-700">{{ __('layout.userpanel.settings') }}</a>
            <button class="font-medium hover:text-gray-700" onclick="event.preventDefault();this.closest('form').submit();">{{ __('layout.userpanel.logout') }}</button>
        </form>
    </div>
</div>