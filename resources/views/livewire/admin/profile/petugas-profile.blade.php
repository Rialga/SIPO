<div>

    <livewire:layouts.admin-header />
    <livewire:layouts.admin-sidebar />

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Petugas</h4>
                                <h4 wire:loading> Loading . . . </h4>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-lg-12">

                                                <h4 class="card-title mb-4">Profile</h4>

                                                <form id="form" class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label text-sm-right pt-2">Nick Name</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="text" name="userId" class="form-control" placeholder="User Nick" wire:model="userNick" required/>
                                                            </div>
                                                            <br> @error('userNick') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label text-sm-right pt-2">Nama Lengkap</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="text" name="userId" class="form-control" placeholder="Nama" wire:model="userNama" required/>
                                                            </div>
                                                            <br> @error('userNama') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label text-sm-right pt-2">Email</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="mail" name="userId" class="form-control" placeholder="mail" wire:model="userMail" required/>
                                                            </div>
                                                            <br> @error('userMail') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label text-sm-right pt-2">Alamat</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <textarea type="text" name="userId" class="form-control" placeholder="Alamat" wire:model="userAlamat" required/></textarea>
                                                            </div>
                                                            <br> @error('userAlamat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label text-sm-right pt-2">Pekerjaan / Sekolah</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="text" name="userId" class="form-control" placeholder="User ID" wire:model="userJob" required/>
                                                            </div>
                                                            <br> @error('userJob') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 control-label text-sm-right pt-2">No Hp</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="text" name="userId" class="form-control" placeholder="User ID" wire:model="userPhone" required/>
                                                            </div>
                                                            <br> @error('userPhone') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                                        </div>
                                                    </div>

                                                    @if($fieldPassword)

                                                    @include('livewire.member.profile.filedAdd.fieldPassword')

                                                    @else
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 control-label text-sm-right pt-2">Password</label>
                                                            <div class="col-sm-5">
                                                                <span class="input-group-prepend">
                                                                    <button wire:click="addPassword('{{ true }}')" class="btn btn-warning" id="addPassword" onclick="return false"><i class="dripicons-warning"></i> Ganti Password</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                                            <div wire:loading class="spinner-border text-warning" role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                            <button wire:loading.remove class="btn btn-primary" onclick="return false" data-toggle="modal" data-target="#update">Ubah</button>
                                                        </div>
                                                    </div>
                                                </form>


                                                <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="update">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body" style="text-align: center">
                                                                    <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                                                    <h4 class="mb-4"> Ubah Data? </h4>
                                                                    <button  class="btn btn-success mb-2 mt-2 mr-2" onclick="return false" wire:click="update" data-dismiss="modal">Ubah</button>
                                                                    <button  type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Tidak</button>
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
                    </div>
                </div>

            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2020 © Sumbar Mountain Advanture.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                SIPO Sumber Mountain Advanture
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
</div>
