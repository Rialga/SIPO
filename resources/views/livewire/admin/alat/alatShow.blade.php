<div>
    <livewire:layouts.admin-header />

     <div class="inner-wrapper" style="background: #e1e2e5 ">

         <livewire:layouts.admin-sidebar />

         @if($pageAlat)

            @include('livewire.admin.alat.alatCreate')

         @else

         <section role="main" class="content-body">
             <header class="page-header">
                 <h2><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></h2>
             </header>

             <div style="display: flex; justify-content: flex-end">
                <a wire:click="addAlat()" class=" btn btn-rounded btn-primary box-shadow-2 mb-2" style="color: white">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>

             {{-- TABLE --}}
             <div class="row">
                 <div class="col">
                     <section class="card">
                         <header class="card-header">
                             <h2 class="card-title">Data</h2>
                              <div class="card-actions">
                                  <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                              </div>
                         </header>

                         <div class="card-body">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Kode Alat</th>
                                         <th>Jenis Alat</th>
                                         <th>Merk</th>
                                         <th>Jumlah Stock</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </thead>

                                 <tbody>
                                     @if ($dataAlat->count() == 0)
                                         <tr>
                                             <td colspan="5" style="text-align: center">Tidak Ada data yang Akan ditampilkan</td>
                                         </tr>
                                     @else
                                         @foreach ($dataAlat as $row)
                                             <tr>
                                                 <td>{{$loop->iteration}}</td>
                                                 <td>{{$row->alat_kode}}</td>
                                                 <td>{{$row->jenis_alat->jenis_alat_nama}}</td>
                                                 <td>{{$row->merk->merk_nama}}</td>
                                                 <td>{{$row->alat_total}}</td>
                                                 <td>
                                                     <a class="btn btn-rounded btn-info box-shadow-2 mb-2" title="detail"><i class="fas fa-eye" style="color: white"></i></a>
                                                     <a class="btn btn-rounded btn-warning box-shadow-2 mb-2" title="edit"><i class="fas fa-edit" style="color: white"></i></a>
                                                     <a class="btn btn-rounded btn-danger box-shadow-2 mb-2" title="delete"><i class="fas fa-trash" style="color: white"></i></a>
                                                 </td>

                                             </tr>
                                         @endforeach
                                     @endif
                                 </tbody>
                             </table>
                         </div>
                     </section>
                 </div>
             </div>


         </section>

         @endif
     </div>

</div>

<script type="text/javascript">

    // function preview() {

    //     var item = document.getElementById('gambar')

    //     for (var i = 0; i <= item.files.length - 1; i++) {
    //         $('#image_preview').append("<img width='100px'  src='" + URL.createObjectURL(event.target.files[i]) + "'>");
    //     }

    // }

</script>
