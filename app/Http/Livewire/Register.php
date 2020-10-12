<?php

namespace App\Http\Livewire;

use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $nick , $mail , $phone;

    public $form = [
        'userNick' => '',
        'userNama' => '',
        'serMail' => '',
        'userAlamat' => '',
        'userJob' => '',
        'userPhone' => '',
        'userPassword' => '',
        'userRePassword' => '',
    ];

    public $checkUser = false;

    public function render()
    {
        return view('livewire.register');
    }

    public function regist(){

        $this->nick = User::where('user_nick', $this->form['userNick'])->count();
        $this->mail = User::where('user_mail', $this->form['userMail'])->count();
        $this->phone = User::where('user_phone', $this->form['userPhone'])->count();


        $this->validate([
            'form.userNick' => 'required | max:20 | regex:/^\S*$/u ',
            'form.userNama' => 'required | max:30',
            'form.userMail' => 'required | max:35 |email',
            'form.userAlamat' => 'required | max:100',
            'form.userJob' => 'required | max:25',
            'form.userPhone' => 'required | max:15',
            'form.userPassword' => 'min:8 | required_with:form.userRePassword | same:form.userRePassword' ,
            'form.userRePassword' => 'required | min:8',
        ]);



        if($this->nick == 0 && $this->mail == 0 && $this->phone == 0){

            $userId ='M-'.Carbon::now()->format('ymdHis');
            $create = new User();

            $create->user_id = $userId;
            $create->user_nick = $this->form['userNick'];
            $create->user_role = 3;
            $create->user_nama = $this->form['userNama'];
            $create->user_mail = $this->form['userMail'];
            $create->user_alamat = $this->form['userAlamat'];
            $create->user_job = $this->form['userJob'];
            $create->user_phone = $this->form['userPhone'];
            $create->user_password = Hash::make($this->form['userPassword']);

            $create->save();

            return redirect('/login');

        }

        else{
            
            $this->checkUser = true;
        }


    }


}
