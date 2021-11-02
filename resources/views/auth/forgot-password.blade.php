<x-guest-layout>
    <x-validation-errors title="Chyba při obnově hesla"/>
    <div class="max-w-xl px-4 pt-16 mx-auto md:pt-32">
        <div class="flex items-center justify-between pb-3">
            <h1 class="text-2xl font-extrabold leading-50">Zapomenuté heslo</h1>
        </div>
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="flex items-center py-3 space-x-2">
                <div class="w-1/3 text-gray-600">emailová adresa</div>
                <x-input style="height: 2.8rem" placeholder="email@adresa.cz" type="email" name="email" :value="old('email')" required autofocus/>
            </div>

            <div class="flex justify-center w-full pt-8 pb-4">
                <button type="submit" name="submit" class="btn-primary">
                    <span class="px-5 py-1">Zapomenuté heslo</span>
                </button>
            </div>
            <a class="text-light-blue-500 hover:underline" href="{{ route('login') }}">
                Přihlásit se
            </a>
        </form>
        <div class="w-full mt-16 text-sm text-center text-gray-600">
          Tento web běží na systému <a href="#" class="text-light-blue-500 hover:text-light-blue-700">Webdo</a>, který nabízí efektivní řešení správy webu.
        </div>
    </div>
</x-guest-layout>
