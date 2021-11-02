<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Mail\UserWelcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateUser extends Component
{
    public $state = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
    ];

    public function submit()
    {
        Validator::make($this->state, $this->rules)->validate();

        $password = Str::random(16);
        User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'password' => Hash::make($password),
        ]);

        Mail::to($this->state['email'])->send(new UserWelcome($password));

        $flash = [
            'type' => 'success',
            'title' => 'Uživatel vytvořen',
            'message' => 'Uživatelský účet byl vytvořen.',
        ];
        
        flash($flash);

        return redirect()->to('web/users');
    }
    public function render()
    {
        return view('livewire.user.create');
    }
}