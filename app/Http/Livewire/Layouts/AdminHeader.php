<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminHeader extends Component
{

    public function logout(){

        Auth::logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.layouts.admin-header');
    }
}
