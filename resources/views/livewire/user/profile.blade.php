<div>
    @section('title')
        Nastavení - <span class="text-light-blue-500">{{ Auth::user()->name }}</span>
    @endsection
    <div>
        <div class="max-w-lg mx-auto">            
            @livewire('profile.update-profile-information-form')
            
            @livewire('profile.update-password-form')
            
            @livewire('profile.logout-other-browser-sessions-form')
        </div>
    </div>
</div>