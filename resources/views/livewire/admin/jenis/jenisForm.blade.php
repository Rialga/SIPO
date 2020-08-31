<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        @if($updateMode)
                        <h4 class="card-title mb-4">Form Edit Jenis Alat</h4>
                        @else
                        <h4 class="card-title mb-4">Form Input Jenis Alat</h4>
                        @endif
                        <form id="form" class="form-horizontal">

                            {{-- Nama Jenis --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Jenis</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="jenisnama" class="form-control" placeholder="Jenis..." wire:model.lazy ="fieldJenisAlat" />
                                    </div>
                                </div>
                                @error('fieldJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Harga</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <label class="pt-2">Rp</label> &nbsp;&nbsp;
                                        <input type="number" name="jenisharga" class="form-control" placeholder="harga.." wire:model.lazy ="fieldJenisHarga" />
                                    </div>
                                </div>
                                @error('fieldJenisHarga') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
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



