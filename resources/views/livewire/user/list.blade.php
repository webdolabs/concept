<div x-data="{ open: false }">
    @section('title')
        {{ __('web/users.title') }}
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <button @click="open = true" type="button" class="btn-primary">
                Přidat uživatele
            </button>
        </div>
    </x-layout.page-title>
    <div x-show="open" style="display: none">
        <livewire:user.create-user/>
    </div>
    @if($confirmUserDelete)
    <div class="fixed inset-0 z-50 w-full min-h-screen px-8 py-3 bg-opacity-50 bg-blue-gray-800 sm:bottom-auto">
        <div class="shadow-lg bg-blue-gray-100 rounded-3xl sm:max-w-xl sm:mx-auto">
          <div class="flex items-center px-3 py-3 bg-white shadow-sm sm:px-6 rounded-3xl">
            <div class="mr-3 sm:mr-5">
              <div class="flex items-center justify-center w-10 h-10 text-red-500 bg-red-100 rounded-full">
    
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </div>
            </div>
            <div class="flex-grow text-gray-700">
              <p class="font-bold">Odstranit uživatele</p>
              <p class="text-sm">Opravdu chcete uživatele odstranit? Nebude ho již možno nijak obnovit.</p>
            </div>
          </div>
          <div class="flex items-center justify-end px-6 py-2 space-x-2 text-sm">
            <button wire:click="$set('confirmUserDelete', null)" class="px-4 py-2 font-semibold text-gray-600 hover:bg-blue-gray-200 rounded-xl ">Zrušit</button>
            <button wire:click="deleteUser({{ $confirmUserDelete }})" class="px-4 py-2 font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Odstranit</button>
          </div>
        </div>
      </div>
    @endif
    @if($user)
    <div class="fixed inset-0 z-40 flex items-center justify-center w-full min-h-screen px-8 py-3 bg-opacity-50 bg-blue-gray-800 sm:bottom-auto">
        <div class="w-full sm:max-w-3xl">
            <div class="flex flex-col w-full bg-white shadow-lg rounded-3xl">
                <div class="flex flex-col justify-between px-6 py-8 bg-white shadow-sm sm:flex-row sm:px-9 rounded-3xl">
                    <div class="">
                        <p class="font-bold text-gray-700">Informace o uživateli:</p>
                        <div class="flex items-center mt-4 space-x-4 text-sm leading-6">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full sm:h-16 sm:w-16 bg-light-blue-300">
                                <span class="text-2xl font-medium leading-none text-white">OŠ</span>
                            </div>
                            <div>
                                <strong>Jméno</strong>: {{ $user->name }} <br />
                                <strong>Email</strong>: {{ $user->email }} <br />
                            </div>
                        </div>
                        <div class="mt-6 space-y-2 text-sm leading-6">
                            <button wire:click="confirmUserDelete({{ $user->id }})" class="px-4 py-2 font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Smazat uživatele</button>
                        </div>
                    </div>
                    <div class="mt-2 space-y-2 text-sm leading-6 sm:mt-0">
                        <div class="flex justify-end mb-6">
                            <button wire:click="closeUser" class="flex items-center justify-center w-10 h-10 text-gray-700 rounded-full opacity-50 cursor-pointer hover:bg-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="border rounded-lg">
                            <div class="flex items-center justify-between px-4 py-2 space-x-4 cursor-pointer hover:bg-gray-100">
                                <div>
                                    <p class="font-bold">Administrátor</p>
                                    <p class="text-sm text-gray-500">Může dělat cokoliv</p>
                                </div>
                                <div class="">
                                    <div class="flex items-center justify-center w-6 h-6 bg-white border-2 rounded-full">
                                        <div class="w-3 h-3 rounded-full bg-light-blue-400"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-4 py-2 space-x-4 border-t cursor-pointer hover:bg-gray-100">
                                <div>
                                <p class="font-bold">Správce</p>
                                <p class="text-sm text-gray-500">Spravuje nastavení webu</p>
                                </div>
                                <div class="">
                                <div class="flex items-center justify-center w-6 h-6 bg-white border-2 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-4 py-2 space-x-4 border-t cursor-pointer hover:bg-gray-100">
                                <div>
                                <p class="font-bold">Redaktor</p>
                                <p class="text-sm text-gray-500">Může vkládat textový obsah</p>
                                </div>
                                <div class="">
                                <div class="flex items-center justify-center w-6 h-6 bg-white border-2 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-4 py-2 space-x-4 border-t cursor-pointer hover:bg-gray-100">
                                <div>
                                <p class="font-bold">Zablokovaný</p>
                                <p class="text-sm text-gray-500">Má zablokované všechny funkce</p>
                                </div>
                                <div class="">
                                <div class="flex items-center justify-center w-6 h-6 bg-white border-2 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="space-y-3">
        @foreach($users as $key => $user)
            <div wire:key="{{ $user->id }}" class="flex {{ $loop->first ? '' : '' }}">
                <div class="flex flex-col justify-between flex-grow w-2/3 px-4 py-4 text-sm font-medium leading-5 bg-white md:items-center md:flex-row sm:px-6">
                    <div class="flex items-center">
                        <div class="hidden w-8 mr-6 text-base text-center sm:block">
                            {{ $key+1 }}
                        </div>
                        <div class="text-gray-800 truncate">
                            {{ $user->name }} - {{ $user->email }}<br>
                            <span class="text-gray-500">
                                <span class="hidden text-gray-400 md:inline-block">Vytvořeno:</span> 
                                {{ date("H:i d.m.Y", strtotime($user->created_at)) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-shrink-0 sm:ml-2 sm:flex-row sm:items-center sm:space-x-4">
                        <button type="button" wire:click="showUser({{ $user->id }})" class="transition duration-200 bg-blue-gray-100 text-blue-gray-500 hover:text-light-blue-500 btn">
                            Upravit
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>