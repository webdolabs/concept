<x-settings-box submit="updateProfileInformation">
    <x-slot name="title">
        Informace
    </x-slot>
    <x-slot name="right">
        <button type="submit" class="btn-primary">
            <span>Uložit</span>
            <x-loading-spin size="4" target="updateProfileInformation" />
        </button>
    </x-slot>

    <x-input name="name" label="Jméno" placeholder="Honza Novák" type="text" wire:model.defer="state.name" autocomplete="name" />
    <x-input name="email" label="Emailová adresa" placeholder="honza.novak@mujmail.cz" type="email" wire:model.defer="state.email" autocomplete="email" />

    <div class="hidden" x-data=""
        x-init="@this.on('saved', () => { 
            $dispatch('flashadded', { 
                title: 'Úspěšně upraveno!',
                message: 'Profilové informace byly úspěšně upraveny.',
                type: 'success'
            }) 
        })"
    ></div>
</x-settings-box>
