<?php

namespace App\Http\Livewire\Admin;

use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Petugas extends Component
{

    public $userId , $userNama , $userMail , $userAlamat , $userJob , $userPhone , $userPassword , $retypePassword;

    public $countUserId;

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
        $data = User::where('user_role',1)->search($this->search)
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

        // Check Kode alat
        public function checkUserId(){

            $this->checkUser = false;
            $this->validate([
                'userId' => 'required | max:20 | regex:/^\S*$/u',
            ]);

            $this->checkUser = true;
            $userId  = $this->userId;
            $this->countUserId = User::where('user_id',$userId)->count();
        }

    // create
    public function create(){

        $this->checkUser = false;

        $this->validate([
            'userId' => 'required | max:20 | regex:/^\S*$/u ',
            'userNama' => 'required | max:30',
            'userMail' => 'required | max:35 |email',
            'userAlamat' => 'required | max:100',
            'userJob' => 'required | max:25',
            'userPhone' => 'required | max:15',
            'userPassword' => 'min:8 | required_with:retypePassword | same:retypePassword' ,
            'retypePassword' => 'required | min:8'
        ]);


        $this->countUserId = User::where('user_id', $this->userId)->count();

        if($this->countUserId == 0){
            $create = new User();

            $create->user_id = $this->userId;
            $create->user_role = 1;
            $create->user_nama = $this->userNama;
            $create->user_mail = $this->userMail;
            $create->user_alamat = $this->userAlamat;
            $create->user_job = $this->userJob;
            $create->user_phone = $this->userPhone;
            $create->user_password = Hash::make($this->userPassword);

            $create->save();

            return $this->clearForm();
        }

        else{
            $this->checkUser = true;
        }


    }

    // Update
    public function update(){

        $update = User::where('user_id', $this->userId)->first();

        if($this->fieldPassword){
            $this->validate([
                'userNama' => 'required | max:30',
                'userMail' => 'required | max:35 |email',
                'userAlamat' => 'required | max:100',
                'userJob' => 'required | max:25',
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
            'userJob' => 'required | max:25',
            'userPhone' => 'required | max:15',
        ]);

        $update->user_nama = $this->userNama;
        $update->user_mail = $this->userMail;
        $update->user_alamat = $this->userAlamat;
        $update->user_job = $this->userJob;
        $update->user_phone = $this->userPhone;

        $update->update();

        return $this->clearForm();

    }


    // show Detail and edit page
    public function showDetailPage($id){


        $detail = User::where('user_id' , $id)->first();

        $this->userId = $detail->user_id;
        $this->userNama = $detail->user_nama;
        $this->userAlamat = $detail->user_alamat;
        $this->userMail = $detail->user_mail;
        $this->userPhone = $detail->user_phone;
        $this->userJob = $detail->user_job;

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

        $this->userId = null;
        $this->userNama = null;
        $this->userMail = null;
        $this->userAlamat = null;
        $this->userJob = null;
        $this->userPhone = null;
        $this->userPassword = null;

        $this->retypePassword = null;

        $this->countUserId = null;

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
