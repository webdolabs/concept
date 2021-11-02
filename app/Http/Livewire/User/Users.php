<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;
    public $user;
    public $confirmUserDelete;

    public function confirmUserDelete($id)
    {
        $this->confirmUserDelete = $id;
    }

    public function deleteUser($id)
    {
        $this->users->find($id)->delete();
        $this->user = null;
        $this->confirmUserDelete = false;
        $this->users = User::orderBy('created_at', 'desc')->get();

        $flash = [
            'type' => 'success',
            'title' => 'Uživatel odstraněn',
            'message' => 'Uživatel byl kompletně vymazán z naší databáze.',
        ];
        
        flash($flash, $this);
    }

    public function showUser($id)
    {
        $this->user = $this->users->find($id);
    }

    public function closeUser()
    {
        $this->user = null;
    }

    public function mount()
    {
        $this->users = User::orderBy('created_at', 'desc')->get();
    }
    
    public function render()
    {
        return view('livewire.user.list');
    }
}