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

             {{-- TABLE --}}
             <div class="row">
                 <div class="col">
                     <section class="card">
                         <header class="card-header">
                             <h2 class="card-title">Data Jenis Alat</h2>
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
                                @if ($dataJenis->count() == 0)
                                    <tr>
                                        <td colspan="5" style="text-align: center">Tidak Ada data yang Akan ditampilkan</td>
                                    </tr>
                                 @else
                                    @foreach ($dataJenis as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->jenis_alat_nama}}</td>
                                            <td>{{$row->jenis_alat_harga}}</td>
                                            <td>
                                                <a class="btn btn-rounded btn-warning box-shadow-2 mb-2" title="edit" wire:click="editPage({{ $row->alat_kode }})"><i class="fas fa-edit" style="color: white"></i></a>
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
     </div>
</div>

@include('livewire.admin.jenis.modalJenis')


<script type="text/javascript">

</script>
