<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        @if($detailPage)
                        <h4 class="card-title mb-4">Profile</h4>
                        @else
                        <h4 class="card-title mb-4">Input Petugas</h4>
                        @endif
                        <form id="form" class="form-horizontal">

                            {{-- User ID--}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">User ID</label>
                                <div class="col-sm-5">
                                    @if($detailPage)
                                    <h4 class="col-sm-6 control-label text-sm-left pt-1">{{ $userId }}</h4>
                                    @else
                                        <div class="input-group">
                                            <input type="text" name="userId" class="form-control" placeholder="User ID"  wire:model.lazy ="userId" required/>
                                            <span class="input-group-prepend">
                                                <button wire:click="checkUserId" class="btn btn-default" id="checkUserId" onclick="return false"><i class="fas fa-sync-alt"></i> Check </button>
                                            </span>
                                        </div>

                                        @if($checkUser)
                                            @if($countUserId == 0)
                                                <span class="pt-2" style="color: green"><i class="fas fa-check"></i> Dapat Digunakan</span>
                                            @else
                                                <span class="pt-2" style="color: red"><i class="fas fa-times"></i> User Id telah di pakai</span>
                                            @endif
                                        @endif
                                        <br>
                                        @error('userId') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                    @endif
                                </div>
                            </div>

                            {{-- User Nama --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Nama Lengkap</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" name="userNama" class="form-control" placeholder="Nama Lengkap"  wire:model.lazy ="userNama" required/>
                                    </div>
                                    <br> @error('userNama') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Mail --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Email</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="email" name="userMail" class="form-control" placeholder="example@mail.com" wire:model.lazy ="userMail" required/>
                                    </div>
                                    <br>@error('userMail') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Alamat --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Alamat</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <textarea type="text" name="userAlamat" class="form-control" wire:model.lazy ="userAlamat" placeholder="Alamat" required></textarea>
                                    </div>
                                    <br> @error('userAlamat') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Job --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Pekerjaan / Sekolah</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" name="userJob" class="form-control" wire:model.lazy ="userJob" placeholder="Pekerjaan / Sekolah" required/>
                                    </div>
                                    <br> @error('userJob') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            {{-- User Phone --}}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">No Hp</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="number" name="userPhone" class="form-control" wire:model.lazy ="userPhone" placeholder="08xxxx" required/>
                                    </div>
                                    <br> @error('userPhone') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                </div>
                            </div>

                            @if($fieldPassword)

                                @include('livewire.admin.petugas.fieldAdd.fieldPassword')

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
                                    <button wire:click="clearForm()"  onclick="return false"  class="btn btn-default">Kembali</button>&nbsp; &nbsp;&nbsp;
                                @if($detailPage)
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



