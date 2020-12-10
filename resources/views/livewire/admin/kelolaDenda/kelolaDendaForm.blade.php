<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        @if($updateMode)
                        <h4 class="card-title mb-4">Form Edit Denda</h4>
                        @else
                        <h4 class="card-title mb-4">Form Input Denda</h4>
                        @endif
                        <form id="form" class="form-horizontal">

                            {{-- Nama Jenis --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Kondisi Alat</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <textarea type="text" name="ket" class="form-control" placeholder="Ket..." wire:model ="fieldKondisiKet" ></textarea>
                                    </div>
                                </div>
                                @error('fieldKondisiKet') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="form-group row">
                                <label class="col-sm-4 control-label text-sm-right pt-2">Harga</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <label class="pt-2">Rp</label> &nbsp;&nbsp;
                                        <input type="number" name="denda" class="form-control" placeholder="denda..." wire:model ="fieldKondisiDenda" />
                                    </div>
                                </div>
                                @error('fieldKondisiDenda') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                            </div>


                            {{-- Button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                    <div wire:loading class="spinner-border text-warning" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                        <button wire:loading.remove wire:click="clearForm()"  onclick="return false"  class="btn btn-default">Kembali</button>&nbsp; &nbsp;&nbsp;
                                    @if($updateMode)
                                        <button wire:loading.remove class="btn btn-primary" onclick="return false" data-toggle="modal" data-target="#update">Ubah</button>
                                    @else
                                        <button wire:loading.remove class="btn btn-primary" onclick="return false" wire:click="create">Simpan</button>
                                    @endif
                                </div>
                            </div>

                        </form>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



