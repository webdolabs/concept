<div>
    <div class="fixed inset-0 z-40 flex items-center justify-center w-full min-h-screen px-8 py-3 bg-opacity-50 bg-blue-gray-800 sm:bottom-auto">
        <div class="w-full sm:max-w-3xl">
            <div class="flex flex-col w-full bg-white shadow-lg rounded-3xl">
                <div class="px-6 py-8 sm:px-9">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-lg font-bold text-gray-800">
                            Přidat uživatele:
                        </div>
                        <button @click="open = false" class="flex items-center justify-center w-10 h-10 text-gray-700 rounded-full opacity-50 cursor-pointer hover:bg-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="space-y-4 md:w-1/2">
                            <x-input wire:model.defer="state.name" name="name" label="Jméno Příjmení" placeholder="Pepa Novák"/>
                            <x-input wire:model.defer="state.email" name="email" label="Emailová adresa" placeholder="jmeno@uzasnyprojekt.cz"/>
                        </div>
                        <p class="text-sm text-gray-600">Heslo bude zasláno na registrovaný email a poté si jej bude moct nový uživatel změnit.</p>
                        <button wire:click="submit" class="btn-primary">
                            Vytvořit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>