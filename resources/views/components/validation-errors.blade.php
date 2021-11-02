@props(['title' => 'Chyba ve formuláři'])

@forelse($errors->all() as $key => $error)
    <div
        wire:key="error{{ date('His') . $key }}" 
        x-data="{ }" 
        x-init="
            $dispatch('flashadded', { 
                title: `{{ $title }}`,
                message: `{{ $error }}`,
                type: 'error'
            })
        "
    ></div>
@endforeach