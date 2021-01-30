<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{

    public $form = [
        'email' => '',
        'password' => '',
    ];

    public function submit(){
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required|min:8'
        ]);



        $loginType = filter_var($this->form['email'], FILTER_VALIDATE_EMAIL) ? 'user_mail' : 'user_mail';


        $login = [
            $loginType => $this->form['email'],
            'password' => $this->form['password']
        ];


        if(Auth::attempt($login)){

            if(Auth::user()->user_role == 3){
                return redirect('/');
                $this->emit('cartAdded');
            }
            else{
                return redirect('/dashboard');
            }

        }
        else{

            $this->dispatchBrowserEvent('validasiLog');
        }



    }




    public function render()
    {
        return view('livewire.login');
    }
}
