<x-settings-box>
    <x-slot name="title">
        Přihlášená zařízení
    </x-slot>

    <div class="text-sm text-gray-600">
        Zde vidíte přehled zařízení na kterých jste přihlášení. Pokud chcete můžete odhlasit všechna ostatní zařízení a mít tak jistotu, že nikdo váš přístup nevyužívá. V případě že najdete nějaké vámi neznámé heslo doporučejeme také změnit heslo.
    </div>

    @if (count($this->sessions) > 0)
        <div class="mt-5 space-y-6">
            <!-- Other Browser Sessions -->
            @foreach ($this->sessions as $session)
                <div class="flex items-center">
                    <div>
                        @if ($session->agent->isDesktop())
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                            </svg>
                        @endif
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="font-semibold text-green-500">Aktualní zařízení</span>
                                @else
                                    Poslední aktivita: {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="flex justify-end mt-5">
        <button class="btn-success" type="submit" wire:click="confirmLogout" wire:loading.attr="disabled">
            <span class="px-3 py-1">Odhlásit z ostatních zařízení</span>
        </button>
    </div>

    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmingLogout">
        <x-slot name="title">
            Odhlásit z ostatních zařízení
        </x-slot>

        <x-slot name="content">
            Zadejte heslo pro ověření

            <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-input type="password"
                    name="password"
                    placeholder="Heslo"
                    label="Heslo"
                    x-ref="password"
                    wire:model.defer="password"
                    wire:keydown.enter="logoutOtherBrowserSessions" />
                @forelse($errors->all() as $key => $error)
                    <div
                        wire:key="error{{ date('His') . $key }}" 
                        x-data="{ }" 
                        x-init="
                            $dispatch('flashadded', { 
                                title: 'Chyba ve formuláři',
                                message: '{{ $error }}',
                                type: 'error'
                            })
                        "
                    ></div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <button class="btn-secondary" type="submit" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    <span class="px-3 py-1">Zrušit</span>
                </button>
                <button class="btn-primary" type="submit" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    <span class="px-3 py-1">Odhlásit z ostatních zařízení</span>
                </button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    
    <div class="hidden" x-data=""
        x-init="@this.on('loggedOut', () => { 
            $dispatch('flashadded', { 
                title: 'Úspěšně ohlášeno!',
                message: 'Všechny ostatní zařízení byly odhlášeny.',
                type: 'success'
            }) 
        })"
    ></div>
</x-settings-box>
