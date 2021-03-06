<div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    @if($updateMode)
                    <h4 class="card-title mb-4">Form Edit Alat</h4>
                    @else
                    <h4 class="card-title mb-4">Form Input Alat</h4>
                    @endif
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
                                    <span class="pt-2" style="color: red"><i class="fas fa-times"></i> Kode Alat telah di pakai</span>
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
                                            <button wire:click="add('jenis')" class="btn btn-success" id="btnAddJenis" onclick="return false"><i class="fas fa-plus"></i> Tambah Jenis</button>
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
                                            <button wire:click="add('merk')" class="btn btn-success" id="btnAddMerk" onclick="return false"><i class="fas fa-plus"></i> Tambah Merk</button>
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

                        {{-- Kondisi Terbaru --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Kondisi Terbaru</label>
                            <div class="col-sm-4">

                                    <div class="custom-control custom-radio custom-radio-danger mb-3 ml-2">
                                        <input type="radio" id="1" name="radio"  value="0% - 20%" class="custom-control-input" wire:model.lazy="kondisiTerbaru">
                                        <label class="custom-control-label" for="1">0% - 20%</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-radio-warning mb-3 ml-2">
                                        <input type="radio" id="2" name="radio"  value="21% - 40%" class="custom-control-input" wire:model.lazy="kondisiTerbaru">
                                        <label class="custom-control-label" for="2">21% - 40%</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-radio-success mb-3 ml-2">
                                        <input type="radio" id="3" name="radio"  value="41% - 60%" class="custom-control-input" wire:model.lazy="kondisiTerbaru">
                                        <label class="custom-control-label" for="3">41% - 60%</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-radio-info mb-3 ml-2">
                                        <input type="radio" id="4" name="radio"  value="61% - 80%" class="custom-control-input" wire:model.lazy="kondisiTerbaru">
                                        <label class="custom-control-label" for="4">61% - 80%</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-radio-primary mb-3 ml-2">
                                        <input type="radio" id="5" name="radio"  value="81% - 100%" class="custom-control-input" wire:model.lazy="kondisiTerbaru">
                                        <label class="custom-control-label" for="5">81% - 100%</label>
                                    </div>
                                @error('kondisiTerbaru') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror

                            </div>
                        </div>

                        {{-- Gambar --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Gambar</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="file"  id="gambar" name="gambar[]" wire:model.lazy="gambar" multiple/>
                                </div>
                                <span style="color: orange">(* Ukuran File max: 1MB harus bertipe gambar : png,jpg,gif,dll )</span> <br>
                                @error('gambar.*') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror

                                <br>
                                <div id="showGambar"></div>
                                <br>
                                @if($updateMode)
                                    <span> Gambar Alat :</span><br>
                                    @if($dataGambar->count() != 0)
                                        @foreach ($dataGambar as $list)
                                            <img src="{{ asset("storage/gambarAlat/$list->gambar_file") }}" width="100" height="100" />
                                            <a wire:click="modal({{ $list->gambar_id }},'gambar')"  class="btn btn-danger btn-default waves-effect waves-light" title="hapus"><i class="fas fa-window-close" style="color: white"></i></a>
                                            <br><br>
                                        @endforeach
                                    @endif
                                @endif

                            </div>
                        </div>

                        {{-- Button --}}
                        <div class="row justify-content-end">
                            <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                <div wire:loading class="spinner-border text-warning" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <button wire:loading.remove wire:click="clearForm()"  onclick="return false"  class="btn btn-default">Kembali</button>&nbsp; &nbsp;&nbsp;

                                @if($updateMode)
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update">Ubah</button>
                                @else
                                <button wire:loading.remove class="btn btn-primary" onclick="return false" wire:click="create" data-dismiss="modal">Simpan</button>
                                @endif

                            </div>
                        </div>
                    </form>


                    {{-- MODAL UPDATE --}}
                    <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="update">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body" style="text-align: center">
                                        <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                        <h4 class="mb-4"> Ubah Data? </h4>
                                        <button class="btn btn-success mb-2 mt-2 mr-2" onclick="return false" wire:click="update" data-dismiss="modal">Ubah</button>
                                        <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL DELETE --}}
                    <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mgambar">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body" style="text-align: center">
                                        <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                        <h4 class="mb-2"> Hapus Gambar? </h4>
                                        <button type="button" class="btn btn-success waves-effect mb-2 mt-2 mr-2" data-dismiss="modal" wire:click="deletePict">Hapus</button>
                                        <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    window.addEventListener('mGambar', event => {
        $("#mgambar").modal('show');
    })

</script>




