<div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="card-title mb-4">Form Alat</h4>
                    <form id="form" class="form-horizontal">

                        {{-- Kode Alat --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Kode Alat</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    @if($updateMode)
                                    <input type="text" name="kodeAlat" class="form-control" placeholder="kode alat" wire:model.lazy ="inputKodeAlat"  disabled/>
                                    @else
                                    <input type="text" name="kodeAlat" class="form-control" placeholder="kode alat" wire:model.lazy ="inputKodeAlat" />
                                    <span class="input-group-prepend">
                                        <button wire:click="checkKodeAlat()" class="btn btn-default" id="checkKodeAlat" onclick="return false"><i class="fas fa-sync-alt"></i> Check </button>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @error('inputKodeAlat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror

                            @if($checkKode)
                                @if($countAlat == 0)
                                    <span class="pt-2" style="color: green"><i class="fas fa-check"></i> Dapat Digunakan</span>
                                    @else
                                    <span class="pt-2" style="color: red"><i class="fas fa-times"></i> Kode Alat teelah di pakai</span>
                                @endif
                            @endif
                        </div>

                        {{-- Jenis --}}
                        @if($pageJenis)
                            @include('livewire.admin.alat.fieldAdd.jenisCreate')
                        @else
                            <div class="form-group row" id="div_selectJenis">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Jenis Alat</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <select class="form-control select2" wire:model.lazy="selectJenisAlat">
                                            <optgroup label="Data  Jenis">
                                                @if ($dataJenis->count() == 0)
                                                    <option value=""> >> Data Kosong << </option>
                                                    @else
                                                    <option value=""> >> Pilih << </option>
                                                    @foreach ($dataJenis as $itemJenis)
                                                        <option value="{{ $itemJenis->jenis_alat_id }}">{{$itemJenis->jenis_alat_nama}}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        </select>
                                        @if ($updateMode)

                                        @else
                                        <span class="input-group-prepend">
                                            <button wire:click="addJenis()" class="btn btn-success" id="btnAddJenis" onclick="return false"><i class="fas fa-plus"></i> Tambah Jenis</button>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @error('selectJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        {{-- Merk --}}
                        @if($pageMerk)
                            @include('livewire.admin.alat.fieldAdd.merkCreate')
                        @else
                            <div class="form-group row" id="div_selectMerk">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Merk</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <select class="form-control select2" wire:model.lazy="selectMerk" >
                                            <optgroup label="Data  Merk">
                                                @if ($dataMerk->count() == 0)
                                                    <option value=""> >> Data Kosong << </option>
                                                @else
                                                    <option value=""> >> Pilih << </option>
                                                    @foreach ($dataMerk as $itemMerk)
                                                        <option value="{{ $itemMerk->merk_id }}">{{$itemMerk->merk_nama}}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        </select>
                                        @if ($updateMode)

                                        @else
                                        <span class="input-group-prepend">
                                            <button wire:click="addMerk()" class="btn btn-success" id="btnAddMerk" onclick="return false"><i class="fas fa-plus"></i> Tambah Merk</button>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @error('selectMerk') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        {{-- Tipe --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Tipe</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" name="tipe" class="form-control" placeholder="Tipe" wire:model.lazy="inputTipe" />
                                </div>
                            </div>
                            @error('inputTipe') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Jumlah</label>
                            <div class="col-sm-1">
                                <div class="input-group">
                                    <input type="number" name="jumlah" class="form-control" wire:model.lazy="inputJumlah" />
                                </div>
                            </div>
                            @error('inputJumlah') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                        </div>

                        {{-- Gambar --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Gambar</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="file"  id="gambar" name="gambar[]" wire:model.lazy="gambar" multiple/>
                                </div>
                                <br>
                                <div id="showGambar"></div>
                                <br>
                                @if($updateMode)
                                    <span> Gambar Alat :</span><br>
                                    @foreach ($dataGambar as $list)
                                    <img src="{{ asset("storage/gambarAlat/$list->gambar_file") }}" width="100" height="100" />
                                    <a wire:click="deletePict({{ $list->gambar_id }})" class="btn btn-danger btn-default waves-effect waves-light" title="hapus"><i class="fas fa-window-close" style="color: white"></i></a>
                                    <br><br>
                                    @endforeach
                                @endif
                            </div>
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
<script>




</script>


