<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        @if($updateMode)
                        <h4 class="card-title mb-4">Form Edit Transaksi Sewa</h4>
                        @else
                        <h4 class="card-title mb-4">Input Transaksi Sewa</h4>
                        @endif
                        <form id="form" class="form-horizontal">

                            {{--  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Tanggal Sewa</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="dd M, yyyy"  data-date-format="dd M, yyyy" data-provide="datepicker" data-date-autoclose="true" wire:model.lazy="tglPinjam">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        <label class="control-label pt-2"> &nbsp; Sampai  &nbsp;</label>
                                        <input type="text" class="form-control" placeholder="dd M, yyyy"  data-date-format="dd M, yyyy" data-provide="datepicker" data-date-autoclose="true" wire:model.lazy="tglKembali">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>

                                </div>
                                {{-- @error('fieldJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror --}}
                            </div>

                            {{--  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Pilih Alat</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control select2" wire:model.lazy="alat.1">
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
                                            <input type="number" name="stok" class="form-control col-sm-4" wire:model.lazy="stok.1" required/> &nbsp;
                                            <label class="control-label text-sm-right pt-2">Unit</label>&nbsp;&nbsp;

                                            <button wire:click.prevent="add({{$num}})" class="btn btn-success" onclick="return false"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @error('alat.0') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>

                            @foreach($inputs as $key => $value)

                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2"></label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control select2" wire:model.lazy="alat.{{ $value }}">
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

                                            <button wire:click.prevent="remove({{$key}})" class="btn btn-danger" onclick="return false"><i class="fas fa-minus"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @error('name.'.$value) <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>

                            @endforeach


                            {{--  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Nama Penyewa</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="sewaNama" class="form-control" placeholder="Nama..."/ wire:model.lazy="sewaNama">
                                    </div>
                                </div>
                                {{-- @error('fieldJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror --}}
                            </div>

                            {{--  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">No HP</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="number" name="sewaNohp" class="form-control" placeholder="HP..." wire:model.lazy="sewaNohp"/>
                                    </div>
                                </div>
                                {{-- @error('fieldJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror --}}
                            </div>

                             {{--  --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Tujuan</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="sewaTujuan" class="form-control" placeholder="Tujuan..." wire:model.lazy="sewaTujuan"/>
                                    </div>
                                </div>
                                {{-- @error('fieldJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror --}}
                            </div>



                            {{-- Button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                    <button wire:click="clearForm()"  onclick="return false"  class="btn btn-default">Kembali</button>&nbsp; &nbsp;&nbsp;
                                @if($updateMode)
                                    <button class="btn btn-primary" onclick="return false" wire:click="update">Ubah</button>
                                @else
                                    <button class="btn btn-primary" onclick="return false" wire:click="create">Simpan</button>
                                @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



