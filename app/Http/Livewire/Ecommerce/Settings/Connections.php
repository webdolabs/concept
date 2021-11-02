<?php

namespace App\Http\Livewire\Ecommerce\Settings;

use App\Actions\System\UpdateSystemOptions;

use Livewire\Component;

class Connections extends Component
{
    use UpdateSystemOptions;

    public $form;

    public function submit() {
        $this->updateSystemOptions($this->form);

        $flash = [
            'type' => 'success',
            'title' => 'Nastevní uloženo',
            'message' => 'Nastavení bylo úspěšně uloženo.',
        ];

        flash($flash , $this);
    }

    public function mount() {
        $this->form['zasilkovna_apikey'] = config('option.zasilkovna_apikey');
        $this->form['gp_goid'] = config('option.gp_goid');
        $this->form['gp_ClientID'] = config('option.gp_ClientID');
        $this->form['gp_ClientSecret'] = config('option.gp_ClientSecret');
        $this->form['gp_return_url'] = config('option.gp_return_url');
        $this->form['gp_test'] = config('option.gp_test');
    }

    public function render()
    {
        return view('livewire.ecommerce.settings.connections');
    }
}