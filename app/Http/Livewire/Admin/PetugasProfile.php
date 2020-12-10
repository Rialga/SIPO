<?php

namespace App\Http\Livewire\Admin;

use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PetugasProfile extends Component
{


    public $userNick, $userNama, $userMail, $userAlamat, $userJob, $userPhone, $userPassword, $retypePassword ;

    public $fieldPassword = false;


    public function mount(){

        $this->userNick = Auth::user()->user_nick;
        $this->userNama = Auth::user()->user_nama;
        $this->userMail = Auth::user()->user_mail;
        $this->userAlamat = Auth::user()->user_alamat;
        $this->userJob = Auth::user()->user_job;
        $this->userPhone = Auth::user()->user_phone;

    }

    public function render()
    {
        return view('livewire.admin.profile.petugas-profile');
    }


    public function update(){

        $update = User::where('user_id', Auth::user()->user_id )->first();

        if($this->fieldPassword){
            $this->validate([
                'userNick' => "required | max:20 | regex:/^\S*$/u|unique:user,user_nick,$update->user_id,user_id",
                'userNama' => 'required | max:30',
                'userMail' => "required | max:35 |email|unique:user,user_mail,$update->user_id,user_id",
                'userAlamat' => 'required | max:100',
                'userJob' => 'required | max:30',
                'userPhone' => "required | max:15|unique:user,user_phone,$update->user_id,user_id",

                'userPassword' => 'min:8 | required_with:retypePassword | same:retypePassword' ,
                'retypePassword' => 'required | min:8'
            ]);

            $update->user_password = Hash::make($this->userPassword);

        }

        $this->validate([
            'userNick' => "required | max:20 | regex:/^\S*$/u|unique:user,user_nick,$update->user_id,user_id",
            'userNama' => 'required | max:30',
            'userMail' => "required | max:35 |email|unique:user,user_mail,$update->user_id,user_id",
            'userAlamat' => 'required | max:100',
            'userJob' => 'required | max:40',
            'userPhone' => "required | max:15|unique:user,user_phone,$update->user_id,user_id",
        ]);

        $update->user_nick = $this->userNick;
        $update->user_nama = $this->userNama;
        $update->user_mail = $this->userMail;
        $update->user_alamat = $this->userAlamat;
        $update->user_job = $this->userJob;
        $update->user_phone = $this->userPhone;

        $update->update();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data Diubah',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

    }

    public function addPassword($id){

        $this->fieldPassword = $id;

    }
}
