<x-guest-layout>
    <x-validation-errors title="Chyba přihlašení"/>
    <div class="max-w-xl px-4 pt-16 mx-auto md:pt-32">
        <div class="flex items-center justify-between pb-3">
            <h1 class="text-2xl font-extrabold leading-50">Příhlásit se</h1>
            <a href="#" class="btn-transparent">
                Vrátit se zpět
            </a>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="flex items-center py-3 space-x-2">
                <div class="w-1/3 text-gray-600">emailová adresa</div>
                <x-input style="height: 2.8rem" placeholder="email@adresa.cz" type="email" name="email" :value="old('email')" required autofocus/>
            </div>

            <div class="flex items-center py-3 space-x-2">
                <div class="w-1/3 text-gray-600">heslo</div>
                <x-input style="height: 2.8rem" placeholder="Heslo123" type="password" name="password" required autocomplete="current-password"/>
            </div>

            <label class="flex items-center justify-start my-3">
                <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border-2 border-gray-300 rounded">
                    <input name="remember" type="checkbox" class="absolute opacity-0 checkbox" />
                    <svg class="w-3 h-3 transition duration-200 ease-in-out transform opacity-0 fill-current text-light-blue-500" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                </div>
                <div class="text-blue-gray-500">Zapamatovat si mě</div>
            </label>

            <div class="flex justify-center w-full mt-8 mb-3">
                <button type="submit" name="submit" class="btn-primary">
                    <span class="px-5 py-1">Přihlásit se</span>
                </button>
            </div>
            @if (Route::has('password.request'))
                <a class="text-light-blue-500 hover:underline" href="{{ route('password.request') }}">
                    Zapomenuté heslo?
                </a>
            @endif
        </form>
        <div class="w-full mt-16 text-sm text-center text-gray-600">
          Tento web běží na systému <a href="#" class="text-light-blue-500 hover:text-light-blue-700">Webdo</a>, který nabízí efektivní řešení správy webu.
        </div>
    </div>
</x-guest-layout>