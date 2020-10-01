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
                                    <h2 class="mb-4">Notifikasi</h2>

                                    <form id="form" class="form-horizontal">


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
