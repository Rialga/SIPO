<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-4">Input Transaksi Sewa</h4>
                        <form id="form" class="form-horizontal">

                            {{-- Total Biaya --}}
                            <div class="form-group row">
                                <label class="col-sm-12 control-label text-sm-right pt-2">
                                    <button wire:click="checkTotal" class="btn btn-default text-sm-right pt-2" id="checkKodeAlat" onclick="return false"><i class="fas fa-sync-alt"></i> Check </button>
                                    Total Biaya
                                </label>
                                <h2 class="col-sm-12 control-label text-sm-right pt-2">Rp. {{ $hargaTotal }}</h2>
                            </div>

                            {{-- Rentang Sewa --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Tanggal Sewa</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="date" class="form-control" wire:model.lazy="tglPinjam" id="tglPinjam" name="tglPinjam">
                                        <label class="control-label pt-2"> &nbsp; Sampai  &nbsp;</label>
                                        <input type="date" class="form-control" wire:model.lazy="tglKembali" id="tglKembali" name="tglKembali">
                                    </div>
                                    <br>
                                    @error('tglPinjam') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror<br>
                                    @error('tglKembali') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- Pilih Alat --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Pilih Alat</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control select2" wire:model.lazy ="alat.0">
                                        @if ($dataAlat->count() == 0)
                                            <option value=""> >> Data Kosong << </option>
                                        @else
                                            <option value=""> >> Pilih << </option>
                                            @foreach ($dataAlat as $row)
                                                <option value="{{ $row->alat_kode }}"> [{{$row->alat_kode}}] {{$row->jenis_alat->jenis_alat_nama}} - {{$row->merk->merk_nama}}</option>
                                            @endforeach
                                        @endif
                                        </select>

                                        &nbsp;&nbsp;
                                        <span class="input-group-prepend">
                                            <input type="number" name="stok" class="form-control col-sm-4" wire:model.lazy ="stok.0" required/> &nbsp;
                                            <label class="control-label text-sm-right pt-2">Unit</label>&nbsp;&nbsp;

                                            <button wire:click.prevent="add({{$num}})" class="btn btn-success" onclick="return false"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                    <br>
                                    @error('alat.0') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                    @error('stok.0') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>

                            </div>

                            @foreach($inputs as $key => $value)

                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">{{ $key }} {{ $value }} </label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control select2" wire:model.lazy ="alat.{{ $value }}">
                                        @if ($dataAlat->count() == 0)
                                            <option value=""> >> Data Kosong << </option>
                                        @else
                                            <option value=""> >> Pilih << </option>
                                            @foreach ($dataAlat as $row)
                                                <option value="{{ $row->alat_kode }}"> [{{$row->alat_kode}}] {{$row->jenis_alat->jenis_alat_nama}} - {{$row->merk->merk_nama}}</option>
                                            @endforeach
                                        @endif
                                        </select>

                                        &nbsp;&nbsp;
                                        <span class="input-group-prepend">
                                            <input type="number" name="stok" class="form-control col-sm-4" wire:model.lazy="stok.{{ $value }}" required/> &nbsp;
                                            <label class="control-label text-sm-right pt-2">Unit</label>&nbsp;&nbsp;

                                            <button wire:click.prevent="remove({{$key}},{{$value}})" class="btn btn-danger" onclick="return false"><i class="fas fa-minus"></i></button>
                                        </span>
                                    </div>
                                    <br>
                                    @error('alat.'.$value) <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                    @error('stok.'.$value) <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            @endforeach

                             {{-- tujuuan Sewa --}}
                             <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Tujuan</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="sewaTujuan" class="form-control" placeholder="Tujuan..." wire:model.lazy="sewaTujuan"/>
                                    </div>
                                </div>   <br>
                                @error('sewaTujuan') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>


                            {{-- Nama Penyewa --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Nama Penyewa</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="sewaNama" class="form-control" placeholder="Nama..."/ wire:model.lazy="sewaNama">
                                    </div>
                                </div>   <br>
                                @error('sewaNama') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>

                            {{-- Mail  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">E - Mail</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="mail" name="sewaMail" class="form-control" placeholder="email.." wire:model.lazy="sewaMail"/>
                                    </div>
                                </div>   <br>
                                @error('sewaMail') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>

                            {{-- No Hp --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">No HP</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="number" name="sewaNohp" class="form-control" placeholder="HP..." wire:model.lazy="sewaNohp"/>
                                    </div>
                                </div>   <br>
                                @error('sewaNohp') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>


                            {{-- Pekerjaan  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Pekerjaan</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="sewaJob" class="form-control" placeholder="Pekerjaan.." wire:model.lazy="sewaJob"/>
                                    </div>
                                </div>   <br>
                                @error('sewaJob') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>

                            {{-- Alamat  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Alamat</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <textarea type="text" name="sewaAlamat" class="form-control" placeholder="Alamat.." wire:model.lazy="sewaAlamat"/></textarea>
                                    </div>
                                </div>   <br>
                                @error('sewaAlamat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>



                            {{-- Button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                    <button wire:click="clearForm()"  onclick="return false"  class="btn btn-default">Kembali</button>&nbsp; &nbsp;&nbsp;
                                    <button class="btn btn-primary" onclick="return false" wire:click="create">Buat</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



