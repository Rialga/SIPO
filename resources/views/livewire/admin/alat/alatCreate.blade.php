
<section role="main" class="content-body">
    <header class="page-header">
         <h2><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></h2>
    </header>


    <div class="row">
        <div class="col-lg-12">
            <form id="form" class="form-horizontal">
                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="{{ url('/alat') }}"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <h2 class="card-title">Form Tambah Alat</h2>
                     </header>

                    <div class="card-body">

                         {{-- Kode Alat --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Kode Alat</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" name="kodeAlat" class="form-control" placeholder="kode alat" wire:model.lazy ="inputKodeAlat" />
                                    <span class="input-group-prepend">
                                        <button wire:click="checkKodeAlat()" class="btn btn-default" id="checkKodeAlat" onclick="return false"><i class="fas fa-sync-alt"></i> Check </button>
                                    </span>
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
                                        <select data-plugin-selectTwo class="form-control populate" wire:model.lazy="selectJenisAlat">
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
                                        <span class="input-group-prepend">
                                        <button wire:click="addJenis()" class="btn btn-success" id="btnAddJenis" onclick="return false"><i class="fas fa-plus"></i> Tambah Jenis</button>
                                        </span>
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
                                    <select data-plugin-selectTwo class="form-control populate" wire:model.lazy="selectMerk" >
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
                                    <span class="input-group-prepend">
                                        <button wire:click="addMerk()" class="btn btn-success" id="btnAddMerk" onclick="return false"><i class="fas fa-plus"></i> Tambah Merk</button>
                                    </span>
                                </div>
                            </div>
                            @error('selectMerk') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                        </div>
                        @endif

                         {{-- Tipe --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Tipe</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" name="tipe" class="form-control" placeholder="Tipe" wire:model.lazy="inputTipe" />
                                </div>
                            </div>
                            @error('inputTipe') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                        </div>


                        {{-- Jumlah --}}
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">Jumlah</label>
                            <div class="col-sm-2">
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
                                    <input type="file"  id="gambar" name="gambar" wire:change="$emit('gambar')" multiple/>
                                </div>
                                <br>
                                @if($gambar != null)

                                    @if (count($gambar) > 3)
                                    <span style="color: red"> Maksimal Upload Hanya 3 Foto  {{$gsmbar=null}} </span>

                                    @else
                                        <button wire:click="cancelAddGambar()" class="btn btn-danger"  onclick="return false"> <i class="fas fa-window-close"></i></button>  &nbsp;&nbsp;
                                        @foreach ($gambar as $preview)
                                            <img src="{{ $preview }}" width="100" />
                                        @endforeach

                                    @endif

                                @endif

                            </div>
                        </div>

                    </div>
                    <footer class="card-footer" >
                        <div class="row justify-content-end">
                            <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                <a href="{{ url('/alat') }}" type="reset" class="btn btn-default">Kembali</a>&nbsp; &nbsp;&nbsp;
                                <button class="btn btn-primary" onclick="return false" wire:click="create()">Submit</button>
                            </div>
                        </div>
                    </footer>
                </section>
            </form>
        </div>
    </div>

</section>

<script>

    window.livewire.on('gambar', () => {

        let inputField = document.getElementById('gambar').files
        var data = []
        var i=0;

        for (let file of inputField) {
            let reader = new FileReader();
            reader.onload = function(e) {

            // INSERT DATA TO ARRAY
            data[i] = e.target.result
                i++
            };
            // Read in the image file as a data URL.
            reader.readAsDataURL(file);
        }

        window.livewire.emit('dataGambar', data)

    })


</script>


