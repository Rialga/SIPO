<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        @if($detailPage)
                        <h4 class="card-title mb-4">Profile Member</h4>
                        @else
                        <h4 class="card-title mb-4">Input Member</h4>
                        @endif
                        <form id="form" class="form-horizontal">

                            {{-- User ID--}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Nick Name</label>
                                <div class="col-sm-5">
                                    @if($detailPage)
                                    <h4 class="col-sm-6 control-label text-sm-left pt-1">{{ $userNick }}</h4>
                                    @else
                                        <div class="input-group">
                                            <input type="text" name="userNick" class="form-control" placeholder="Nick Name"  wire:model ="userNick" required/>
                                            <span class="input-group-prepend">
                                                <button wire:click="checkUserNick" class="btn btn-default" id="checkUserNick" onclick="return false"><i class="fas fa-sync-alt"></i> Check </button>
                                            </span>
                                        </div>

                                        @if($checkUser)
                                            @if($countUserNick == 0)
                                                <span class="pt-2" style="color: green"><i class="fas fa-check"></i> Dapat Digunakan</span>
                                            @else
                                                <span class="pt-2" style="color: red"><i class="fas fa-times"></i> User Id telah di pakai</span>
                                            @endif
                                        @endif
                                        <br>
                                        @error('userNick') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                    @endif
                                </div>
                            </div>

                            {{-- User Nama --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Nama Lengkap</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" name="userNama" class="form-control" placeholder="Nama Lengkap"  wire:model ="userNama" required/>
                                    </div>
                                    <br> @error('userNama') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Mail --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Email</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="email" name="userMail" class="form-control" placeholder="example@mail.com" wire:model ="userMail" required/>
                                    </div>
                                    <br>@error('userMail') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Alamat --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Alamat</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <textarea type="text" name="userAlamat" class="form-control" wire:model ="userAlamat" placeholder="Alamat" required></textarea>
                                    </div>
                                    <br> @error('userAlamat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Job --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Pekerjaan / Sekolah</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" name="userJob" class="form-control" wire:model ="userJob" placeholder="Pekerjaan / Sekolah" required/>
                                    </div>
                                    <br> @error('userJob') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Phone --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">No Hp</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="number" name="userPhone" class="form-control" wire:model ="userPhone" placeholder="08xxxx" required/>
                                    </div>
                                    <br> @error('userPhone') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            @if($fieldPassword)

                                @include('livewire.admin.member.fieldAdd.fieldPassword')

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

                            {{-- Button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                    <div wire:loading class="spinner-border text-warning" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <button wire:loading.remove wire:click="clearForm()"  onclick="return false"  class="btn btn-default">Kembali</button>&nbsp; &nbsp;&nbsp;
                                @if($detailPage)
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



