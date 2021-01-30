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
                                        <h5 class="text-primary">Haii !</h5>
                                        <p>Ayo Login untuk dapat mengakses fitur lainnya.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="https://www.pinclipart.com/picdir/big/488-4886416_camping-png-background-image-camping-png-clipart.png" class="img-fluid">
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
                                <form class="form-horizontal" wire:submit.prevent="submit">

                                    <div class="form-group">
                                        <label for="username">E-mail</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username" wire:model.lazy="form.email">
                                        @error('form.email') <span style="color: red"> {{$message}} </span> @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password" wire:model.lazy="form.password">
                                        @error('form.password') <span style="color: red"> {{$message}} </span> @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                    </div>

                                    <div class="mt-3 text-center">
                                        <span>  -- Or -- </span>
                                    </div>

                                    <div class="mt-3">
                                        <a type="submit" class="btn btn-primary btn-block waves-effect waves-light" href="{{ url('auth/google') }}">
                                            <i class="mdi mdi-google"> </i> Login with Google
                                        </a>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <p>Belum Punya Akun ? <a href={{ url('register') }} class="font-weight-medium text-primary"> Daftar sekarang </a> </p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mvalidasilog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body" style="text-align: center">
                                        <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                        <h4 class="mb-4"> Opps Periksa Kembali Email dan Password !</h4>
                                        <button type="button" class="btn btn-secondary waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">close</button>
                                </div>
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

<script>
    window.addEventListener('validasiLog', event => {
        $("#mvalidasilog").modal('show');
    })

</script>
