<?php

namespace App\Http\Livewire\Admin;

use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Member extends Component
{

    public $userNick , $userNama , $userMail , $userAlamat , $userJob , $userPhone , $userPassword , $retypePassword;

    public $countUserNick;

    public $formMember = false;
    public $detailPage = false;
    public $checkUser = false;
    public $fieldPassword = true;

    public $sortBy = 'user_id';
    public $sortDiraction = 'asc';
    public $showPage = 10;
    public $search='';

    public $rowId;



    public function modal($id){


        $this->rowId = $id;
        $this->dispatchBrowserEvent('mPenyewa');

    }


    public function render()
    {
        $data = User::where('user_role',3)->search($this->search)
        ->orderBy($this->sortBy, $this->sortDiraction)
        ->paginate($this->showPage);
        return view('livewire.admin.member.member',['data'=>$data]);
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

        $this->validate([
            'userNick' => 'required | max:20 | regex:/^\S*$/u|unique:user,user_nick',
            'userNama' => 'required | max:30',
            'userMail' => 'required | max:35 |email|unique:user,user_mail',
            'userAlamat' => 'required | max:100',
            'userPhone' => 'required | max:15|unique:user,user_phone',
            'userPassword' => 'min:8 | required_with:retypePassword | same:retypePassword' ,
            'retypePassword' => 'required | min:8',
            'userJob' => 'required | max:25',
        ]);



            $userId ='M-'.Carbon::now()->format('ymdHis');
            $create = new User();

            $create->user_id = $userId;
            $create->user_nick = $this->userNick;
            $create->user_role = 3;
            $create->user_nama = $this->userNama;
            $create->user_mail = $this->userMail;
            $create->user_alamat = $this->userAlamat;
            $create->user_job = $this->userJob;
            $create->user_phone = $this->userPhone;
            $create->user_password = Hash::make($this->userPassword);

            $create->save();

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Data Disimpan',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false
            ]);

            return $this->clearForm();
    }



    // Update
    public function update(){

        $update = User::where('user_nick', $this->userNick)->first();

        if($this->fieldPassword){
            $this->validate([
                'userNama' => 'required | max:30',
                'userMail' => "required | max:35 |email|unique:user,user_mail,$update->user_id,user_id",
                'userAlamat' => 'required | max:100',
                'userPhone' => "required | max:15|unique:user,user_phone,$update->user_id,user_id",
                'userJob' => 'required | max:30',

                'userPassword' => 'min:8 | required_with:retypePassword | same:retypePassword' ,
                'retypePassword' => 'required | min:8',
            ]);

            $update->user_password = Hash::make($this->userPassword);

        }

        $this->validate([
            'userNama' => 'required | max:30',
            'userMail' => "required | max:35 |email|unique:user,user_mail,$update->user_id,user_id",
            'userAlamat' => 'required | max:100',
            'userPhone' => "required | max:15|unique:user,user_phone,$update->user_id,user_id",
            'userJob' => 'required | max:40',
        ]);

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


        return $this->clearForm();

    }


    public function delete($id){


        User::where('user_id',$this->rowId)->delete();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data Dihapus',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton' => false
        ]);

    }

    // show Detail and edit page
    public function showDetailPage($id){


        $detail = User::where('user_id' , $id)->first();

        $this->userNick = $detail->user_nick;
        $this->userNama = $detail->user_nama;
        $this->userAlamat = $detail->user_alamat;
        $this->userMail = $detail->user_mail;
        $this->userPhone = $detail->user_phone;
        $this->userJob = $detail->user_job;

        $this->detailPage = true;
        $this->formMember = true;
        $this->fieldPassword = false;
    }



    // show input form
    public function showFormMember(){

        $this->formMember = true;

    }



    public function addPassword($id){

        $this->fieldPassword = $id;

    }


    // celear variabel value
    public function clearForm(){

        $this->validate([]);

        $this->userNick = null;
        $this->userNama = null;
        $this->userMail = null;
        $this->userAlamat = null;
        $this->userJob = null;
        $this->userPhone = null;
        $this->userPassword = null;

        $this->retypePassword = null;

        $this->countUserNick = null;

        $this->formMember = false;
        $this->detailPage = false;
        $this->checkUser = false;
        $this->fieldPassword = true;

        $this->sortBy = 'user_id';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';
    }
}
