<div>

    <livewire:layouts.header />

    <div class="main-content" style="margin: auto;">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Gratis Daftar !</h5>
                                            <p>Bergabunglah menjadi member Sumbar mountain Advanture secara gratis.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="https://www.pinclipart.com/picdir/big/488-4886416_camping-png-background-image-camping-png-clipart.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle" style="background: rgb(235, 243, 242)">
                                                <img src="{{ asset("assets/images/logo-dark.png")}}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal">

                                        <div class="form-group">
                                            <label for="userNick">Nick Name</label>
                                            <input type="text" class="form-control" id="userNick" placeholder="Enter Nick Name" wire:model.lazy="form.userNick">
                                            @error('form.userNick') <span style="color: red"> {{$message}} </span> @enderror
                                            @if($checkUser)
                                                @if($nick == 0)
                                                    <span class="pt-2" style="color: green"><i class="fas fa-check"></i>Email Dapat Digunakan</span>
                                                @else
                                                    <span class="pt-2" style="color: red"><i class="fas fa-times"></i> Nick Name telah di pakai</span>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="userNama">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="userNama" placeholder="Enter Nama " wire:model.lazy="form.userNama">
                                            @error('form.userNama') <span style="color: red"> {{$message}} </span> @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="userMail">E mail</label>
                                            <input type="mail" class="form-control" id="userMail" placeholder="Enter E - Mail" wire:model.lazy="form.userMail">
                                            @error('form.userMail') <span style="color: red"> {{$message}} </span> @enderror
                                            @if($checkUser)
                                                @if($mail == 0)
                                                    <span class="pt-2" style="color: green"><i class="fas fa-check"></i>Email Dapat Digunakan</span>
                                                @else
                                                    <span class="pt-2" style="color: red"><i class="fas fa-times"></i> Email telah di pakai</span>
                                                @endif
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <label for="userAlamat">Alamat</label>
                                            <textarea type="text" class="form-control" id="userAlamat" placeholder="Enter Alamat" wire:model.lazy="form.userAlamat"></textarea>
                                            @error('form.userAlamat') <span style="color: red"> {{$message}} </span> @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="userJob">Pekerjaan / Sekolah</label>
                                            <input type="text" class="form-control" id="userJob" placeholder="Enter pekerjaan / Sekolah" wire:model.lazy="form.userJob">
                                            @error('form.userJob') <span style="color: red"> {{$message}} </span> @enderror
                                        </div>




                                        <div class="form-group">
                                            <label for="userPhone">No Hp</label>
                                            <input type="number" class="form-control" id="userPhone" placeholder="Enter No HP" wire:model.lazy="form.userPhone">
                                            @error('form.userPhone') <span style="color: red"> {{$message}} </span> @enderror
                                            @if($checkUser)
                                                @if($phone == 0)
                                                    <span class="pt-2" style="color: green"><i class="fas fa-check"></i>No Hp Dapat Digunakan</span>
                                                @else
                                                    <span class="pt-2" style="color: red"><i class="fas fa-times"></i> No Hp telah di pakai</span>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="userPassword">Password</label>
                                            <input type="password" class="form-control" id="userPassword" placeholder="Enter password" wire:model.lazy="form.userPassword">
                                            @error('form.userPassword') <span style="color: red"> {{$message}} </span> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="userRePassword">Re Type Password</label>
                                            <input type="password" class="form-control" id="userRePassword" placeholder="Enter password" wire:model.lazy="form.userRePassword">
                                            @error('form.userRePassword') <span style="color: red"> {{$message}} </span> @enderror
                                        </div>

                                        <div class="mt-5">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit" wire:click.prevent="regist">Daftar</button>
                                        </div>


                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <livewire:layouts.footer />
    </div>



    </div>

