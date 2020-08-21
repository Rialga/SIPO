<div>

<livewire:layouts.header />

<div role="main" class="main shop py-4">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-9">
                <div class="featured-box featured-box-primary text-left mt-0">
                    <div class="box-content">
                        <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Form Login</h4>

                        <form class="needs-validation" wire:submit.prevent="submit">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="font-weight-bold text-dark text-2">Username or E-mail Address</label>
                                    <input type="text" value="" class="form-control form-control-lg" wire:model.lazy="form.email">
                                    @error('form.email') <span style="color: red"> {{$message}} </span> @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <a class="float-right" href="#">(Lost Password?)</a>
                                    <label class="font-weight-bold text-dark text-2">Password</label>
                                    <input type="password" value="" class="form-control form-control-lg" wire:model.lazy="form.password">
                                    @error('form.password') <span style="color: red"> {{$message}} </span> @enderror
                                </div>
                            </div>

                            <br>

                            <div class="form-row">
                                <div class="form-group col-lg-6"></div>
                                <div class="form-group col-lg-6">
                                    <button class="btn btn-primary btn-modern float-right">Login</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<livewire:layouts.footer />

</div>
