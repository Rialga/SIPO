<div>

<livewire:layouts.header />

<div class="main-content" style="margin: auto;">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">

                <livewire:layouts.sidebar />

                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h2 class="mb-4">Profile</h2>

                                <form id="form" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">User ID</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="userId" class="form-control" placeholder="User ID"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">Nama Lengkap</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="userId" class="form-control" placeholder="User ID"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">Email</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="userId" class="form-control" placeholder="User ID"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">Alamat</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="userId" class="form-control" placeholder="User ID"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">Pekerjaan / Sekolah</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="userId" class="form-control" placeholder="User ID"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">No Hp</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="userId" class="form-control" placeholder="User ID"  required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                                            <button class="btn btn-primary" onclick="return false" wire:click="create">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <livewire:layouts.footer />
</div>


</div>
