<div>

    <livewire:layouts.admin-header />

     <div class="inner-wrapper" style="background: #e1e2e5 ">

         <livewire:layouts.admin-sidebar />

         <section role="main" class="content-body">
             <header class="page-header">
                 <h2><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></h2>
             </header>

             <div style="display: flex; justify-content: flex-end">
                <a class=" btn btn-rounded btn-primary box-shadow-2 mb-2" data-toggle="modal" data-target="#modalJenisAlat" style="color: white">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>

            {{-- MODAL --}}
            <div class="modal fade" id="modalJenisAlat" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Form Jenis Alat</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="demo-form" class="mb-4" novalidate="novalidate">
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 text-left text-sm-right mb-0">Jenis Alat</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="jenisAlat" class="form-control" placeholder="Jenis Alat"  required/>
                                    </div>
                                    @error('fieldJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 text-left text-sm-right mb-0">Harga Sewa</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label class="pt-2">Rp:</label> &nbsp;&nbsp;&nbsp;
                                            <input type="number" name="jenisHarga" class="form-control" placeholder="Harga Sewa"  required/>
                                        </div>
                                        @error('fieldJenisHarga') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

             {{-- TABLE --}}
             <div class="row">
                 <div class="col">
                     <section class="card">
                         <header class="card-header">
                             <h2 class="card-title">Data Member</h2>
                              <div class="card-actions">
                                  <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                              </div>
                         </header>

                         <div class="card-body">
                             <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Alat</th>
                                        <th>Harga Sewa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>

                             </table>
                         </div>
                     </section>
                 </div>
             </div>

         </section>
     </div>
</div>


<script type="text/javascript">

</script>
