<?php

namespace App\Http\Livewire\Admin;

use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Petugas extends Component
{

    public $userNick , $userNama , $userMail , $userAlamat , $userPhone , $userPassword , $retypePassword , $selectRole;

    public $countUserNick;

    public $formPetugas = false;
    public $detailPage = false;
    public $checkUser = false;
    public $fieldPassword = true;

    public $sortBy = 'user_id';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';


    public function render()
    {
        $data = User::where('user_role','<',3)->search($this->search)
        ->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.petugas.petugas',['data'=>$data]);
    }


    // sorting
    public function sortBy($field){
        if ($this->sortDiraction == 'asc' ){
            $this->sortDiraction = 'desc';
        }
        else{
            $this->sortDiraction = 'asc';
        }

        return $this->sortBy = $field;
    }

    // Check NICK
    public function checkUserNick(){

        $this->checkUser = false;
        $this->validate([
            'userNick' => 'required | max:20 | regex:/^\S*$/u',
        ]);

        $this->checkUser = true;
        $userNick  = $this->userNick;
        $this->countUserNick = User::where('user_nick',$userNick)->count();
    }

    // create
    public function create(){

        $this->checkUser = false;

        $this->validate([
            'userNick' => 'required | max:20 | regex:/^\S*$/u ',
            'userNama' => 'required | max:30',
            'selectRole'=>'required',
            'userMail' => 'required | max:35 |email',
            'userAlamat' => 'required | max:100',
            'userPhone' => 'required | max:15',
            'userPassword' => 'min:8 | required_with:retypePassword | same:retypePassword' ,
            'retypePassword' => 'required | min:8'
        ]);


        $this->countUserNick = User::where('user_nick', $this->userNick)->count();

        if($this->countUserNick == 0){
            $userId ='M-'.Carbon::now()->format('ymdHis');
            $create = new User();

            $create->user_id = $userId;
            $create->user_nick = $this->userNick;
            $create->user_role = $this->selectRole;
            $create->user_nama = $this->userNama;
            $create->user_mail = $this->userMail;
            $create->user_alamat = $this->userAlamat;
            $create->user_phone = $this->userPhone;
            $create->user_password = Hash::make($this->userPassword);

            if($this->selectRole == 1){
                $create->user_job = 'Admin Sumbar Montain Advanture';
            }
            else{
                $create->user_job = 'Petugas Sumbar Montain Advanture';
            }

            $create->save();

            return $this->clearForm();
        }

        else{
            $this->checkUser = true;
        }


    }

    // Update
    public function update(){

        $update = User::where('user_nick', $this->userNick)->first();

        if($this->fieldPassword){
            $this->validate([
                'userNama' => 'required | max:30',
                'userMail' => 'required | max:35 |email',
                'userAlamat' => 'required | max:100',
                'userPhone' => 'required | max:15',

                'userPassword' => 'min:8 | required_with:retypePassword | same:retypePassword' ,
                'retypePassword' => 'required | min:8'
            ]);

            $update->user_password = Hash::make($this->userPassword);

        }

        $this->validate([
            'userNama' => 'required | max:30',
            'userMail' => 'required | max:35 |email',
            'userAlamat' => 'required | max:100',
            'userPhone' => 'required | max:15',
        ]);

        $update->user_nama = $this->userNama;
        $update->user_mail = $this->userMail;
        $update->user_alamat = $this->userAlamat;
        $update->user_phone = $this->userPhone;

        $update->update();

        return $this->clearForm();

    }

    //DELETE
    public function delete($id){

        User::where('user_id',$id)->delete();

    }

    // show Detail and edit page
    public function showDetailPage($id){


        $detail = User::where('user_id' , $id)->first();

        $this->userNick = $detail->user_nick;
        $this->userNama = $detail->user_nama;
        $this->userAlamat = $detail->user_alamat;
        $this->userMail = $detail->user_mail;
        $this->userPhone = $detail->user_phone;
        $this->selectRole = $detail->user_role;

        $this->detailPage = true;
        $this->formPetugas = true;
        $this->fieldPassword = false;
    }


    // show input form
    public function showFormPetugas(){

        $this->formPetugas = true;

    }



    public function addPassword($id){

        $this->fieldPassword = $id;

    }

    //clear public variable
    public function clearForm(){

        $this->validate([]);

        $this->userNick = null;
        $this->selectRole = null;
        $this->userNama = null;
        $this->userMail = null;
        $this->userAlamat = null;
        $this->userPhone = null;
        $this->userPassword = null;

        $this->retypePassword = null;

        $this->countUserNick = null;

        $this->formPetugas = false;
        $this->detailPage = false;
        $this->checkUser = false;
        $this->fieldPassword = true;

        $this->sortBy = 'user_id';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';
    }
}
