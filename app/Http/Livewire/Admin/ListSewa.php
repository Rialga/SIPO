<?php

namespace App\Http\Livewire\Admin;

use App\Model\Alat;
use App\Model\DetailSewa;
use App\Model\Penyewaan;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class ListSewa extends Component
{

    public $invoice, $tglPinjam , $tglKembali , $sewaNohp , $sewaNama , $sewaJob , $sewaAlamat , $sewaMail, $sewaTujuan, $tglBayar, $sewaStatus, $fullPrice , $totalHari;

    public $sewaTglCreate = null;

    public $alat = [];
    public $stok = [];

    public $dataSewa , $dataAlat;

    public $hargaTotal = 0;

    public $inputs = [];
    public $num = 0;

    public $formSewa = false;

    public $sortBy = 'penyewaan.created_at';
    public $sortDiraction = 'desc';
    public $showPage = 10;
    public $search='';


    public function mount(){

        $this->dataAlat = Alat::all();

    }

    // View
    public function render()
    {
        $data = Penyewaan::search($this->search)
            ->join('user', 'penyewaan.sewa_user', '=', 'user.user_id')
            ->join('status_sewa', 'penyewaan.sewa_status', '=', 'status_sewa.status_id')
            ->orderBy($this->sortBy, $this->sortDiraction)
            ->paginate($this->showPage);
        return view('livewire.admin.listSewa.list-sewa',['data'=>$data]);
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

    // Fungsi Harga Total
    public function checkTotal(){


        foreach ($this->stok as $key => $value) {

            $alat = Alat::where('alat_kode', $this->alat[$key])->first();
            $harga = $alat->jenis_alat->jenis_alat_harga;
            $total = $harga * $this->stok[$key];
            $price[] = $total;

        }

             $this->hargaTotal = array_sum($price);

    }


    // add field
    public function add($num, $val)
    {
        $num++;
        $this->num = $num;
        array_push($this->inputs ,$num);

    }

    public function remove($num , $val)
    {
        unset($this->stok[$val]);
        unset($this->alat[$val]);
        unset($this->inputs[$num]);
    }


    // Create
    public function create(){

        $this->validate([
            'alat.*' => 'required',
            'stok.*' => 'required',
            'sewaNama' => 'required',
            'sewaMail' => 'required|email',
            'sewaAlamat' => 'required',
            'sewaJob' => 'required',
            'sewaNohp' => 'required',
            'tglPinjam' => 'required',
            'tglKembali' => 'required',
            'sewaTujuan' => 'required',
        ]);


        // Genereate No Invoice
        $invoice = 'INVC/II/'.Carbon::now()->format('Ymd/His');
        //Generate Id Member
        $idMember = 'M-'.Carbon::now()->format('ymdHis');

        //Genereate nickname
        $firstName = explode(' ',trim($this->sewaNama));
        $nickname = $firstName[0];
        $uniqcode = substr(md5(time()), 0, 3);
        if(User::where('user_nick',$nickname)->exists()) {
            $nickname = $firstName[0] .'_'. $uniqcode;
        }


        // insert data memeber
        $member = new User();
        $member->user_id = $idMember;
        $member->user_nick = $nickname;
        $member->user_role = 3;
        $member->user_nama = $this->sewaNama;
        $member->user_mail = $this->sewaMail;
        $member->user_alamat = $this->sewaAlamat;
        $member->user_job = $this->sewaJob;
        $member->user_phone = $this->sewaNohp;
        $member->user_password = Hash::make('123qweasd');
        $member->save();

        //insert penyewaan
        $createSewa = new Penyewaan();
        $createSewa->sewa_no = $invoice;
        $createSewa->sewa_status = 3;
        $createSewa->sewa_user = $idMember;
        $createSewa->sewa_tglsewa = $this->tglPinjam;
        $createSewa->sewa_tglkembali = $this->tglKembali;
        $createSewa->sewa_buktitf = 'Lunas';
        $createSewa->sewa_tglbayar = Carbon::now();
        $createSewa->sewa_tujuan = $this->sewaTujuan;
        $createSewa->save();


        //insert fetail penyewaan
        foreach ($this->stok as $key => $value) {
            $detail = new DetailSewa();

            $detail->detail_sewa_alat_kode = $this->alat[$key];
            $detail->detail_sewa_nosewa = $invoice;
            $detail->detail_sewa_total = $this->stok[$key];

            $detail->save();

        }

        return $this->clearForm();

    }


    // Upadate Status
    public function updateStatus($id){
        $status = Penyewaan::where('sewa_no' , $id)->first();

        if($status->sewa_status == 3){


            foreach($status->detail_sewa as $item){

                $updateStok = Alat::where('alat_kode',$item->alat->alat_kode)->first();
                $stokNow = $updateStok->alat_total - $item->detail_sewa_total;

                $updateStok->alat_total = $stokNow  ;
                $updateStok->update();
            }

            $status->sewa_status = 4;
            $status->update();
        }

        elseif($status->sewa_status == 4){
            $status->sewa_status = 5;
            $status->update();
        }
        else{
            dd('WTF');
        }

    }


    // Show Edit page
    public function showDetailPage($id){

        $invoice = str_replace("/","-",$id);

        $status = Penyewaan::where('sewa_no' , $id)->first();



        if($status->sewa_status == 2){
            return redirect('detailpembayaran/'.$invoice);
        }
        elseif($status->sewa_status == 5){
            return redirect('detailpengembalian/'.$invoice);
        }
        else{
            return redirect('detailsewa/'.$invoice);
        }


    }

    // Show Page Add
    public function showFormSewa(){
        $this->formSewa = true;
    }

    //Cleat form
    public function clearForm(){

        $this->validate([]);
        $this->tglPinjam = null;
        $this->tglKembali = null;
        $this->sewaNama = null;
        $this->sewaNohp = null;
        $this->sewaJob = null;
        $this->sewaAlamat = null;
        $this->sewaMail = null;
        $this->sewaTujuan = null;
        $this->invoice = null;
        $this->totalHari = null;
        $this->fullPrice = null;


        $this->formSewa = false;

        $this->inputs = [];
        $this->num = 1;


        $this->hargaTotal = 0;

        $this->alat = [];
        $this->stok = [];

        $this->sortBy = 'sewa_no';
        $this->sortDiraction = 'asc';
        $this->showPage = 10;
        $this->search='';

    }

}



