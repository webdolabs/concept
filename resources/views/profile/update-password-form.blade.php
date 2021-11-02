<x-settings-box submit="updatePassword">
    <x-slot name="title">
        Změnit heslo
    </x-slot>
    <x-slot name="right">
        <button type="submit" class="btn-primary">
            <span>Změnit</span>
            <x-loading-spin size="4" target="updatePassword" />
        </button>
    </x-slot>

    <x-input name="current_password" label="Současné heslo" type="password" wire:model.defer="state.current_password" autocomplete="current-password" />
    <x-input name="password" label="Nové heslo" type="password" wire:model.defer="state.password" autocomplete="new-password" />
    <x-input name="password_confirmation" label="Nové heslo znovu" type="password" wire:model.defer="state.password_confirmation" autocomplete="new-password" />

    <div class="hidden" x-data=""
        x-init="@this.on('saved', () => { 
            $dispatch('flashadded', { 
                title: 'Úspěšně změněno!',
                message: 'Heslo bylo úspěšně změněno.',
                type: 'success'
            }) 
        })"
    ></div>
</x-settings-box>

