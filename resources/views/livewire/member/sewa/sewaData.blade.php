<div>

    <table class="table table-hover mb-0">


        <tbody>

            @foreach ($dataSewa as $item)

                <tr>
                    <td>
                     <p> {{ Carbon\Carbon::parse($item->created_at)->format('d, M Y') }} </p>
                     <hr width="100%">

                     <div class="row">
                         <div class="col-lg-3">
                             <a class="mb-4" data-toggle="collapse" href="#sewa{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapseExample">
                                 <b style="color: green"> {{ $item->sewa_no }} </b>
                             </a>
                         </div>
                         <div class="col-lg-2" style="text-align: center">
                            @if($item->sewa_status == 0)
                                Status :<br> <b style="color: red"> Dibatalkan </b>
                            @elseif($item->sewa_status == 1)
                                Status :<br> <b style="color: orange"> Belum Bayar </b>
                            @elseif($item->sewa_status == 2)
                                Status :<br> <b style="color: #0AC8C8"> Menunggu Konfirmasi</b>
                            @elseif($item->sewa_status == 3)
                                Status :<br> <b style="color: #0AC8C8"> Pembayaran Telah dikonfirmasi </b>
                            @elseif($item->sewa_status == 4 or 5)
                                Status :<br> <b style="color: #0AC8C8"> Barang Siap Diambil </b>
                            @elseif($item->sewa_status == 6)
                                Status :<br> <b style="color: green"> Dikembalikan </b>
                            @else
                                Status :<br> <b style="color: red"> Pembayaran Ditolak </b>
                            @endif
                         </div>
                         <div class="col-lg-4" style="text-align: center">
                             Tanggal Sewa : {{ Carbon\Carbon::parse($item->sewa_tglsewa)->format('d, M Y') }} <br>
                             Tanggal Kembali : {{ Carbon\Carbon::parse($item->sewa_tglkembali)->format('d, M Y') }}<br>
                             Estimasi : {{  Carbon\Carbon::parse( $item->sewa_tglsewa)->diffInDays( $item->sewa_tglkembali) }} Hari
                         </div>
                         <div class="col-lg-3" style="text-align: right">
                              Total Pembayaran : <br>
                              <h4 style="color: orange"> Rp {{ $totalAll[$loop->iteration - 1] }} </h4>
                         </div>
                     </div>
                     <hr width="100%">

                     <div class="row collapse" id="sewa{{ $loop->iteration }}">
                         <div class="col-lg-9">
                            @foreach ($item->detail_sewa as $data)
                             <div class="row no-gutters align-items-center">
                                 <div class="col-md-4">
                                     <img class="card-img img-fluid" src="{{ asset("storage/gambarAlat/".$data->alat->gambar_alat[0]->gambar_file) }}" alt="Card image" style="object-fit: cover; width:  170px; height: 200px;">
                                 </div>
                                 <div class="col-md-4">
                                     <div class="card-body">
                                         <h5 class="card-title">{{ $data->detail_sewa_alat_kode }}</h5>
                                         <p class="card-text">{{ $data->alat->jenis_alat->jenis_alat_nama }} ( {{ $data->alat->merk->merk_nama }} ) <br> {{ $data->alat->alat_tipe }}</p>
                                         <p class="card-text"><b class="text-muted">Rp. {{ $data->alat->jenis_alat->jenis_alat_harga }} x {{ $data->detail_sewa_total}} unit</b></p>
                                     </div>
                                 </div>
                             </div> <br>
                             @endforeach
                         </div>
                         <div class="col-lg-3" style="text-align: right">
                            @if($item->sewa_status == 1)
                             <a class="btn btn-warning" style="cursor: pointer; color: white;" wire:click="showPage('{{ $item->sewa_no }}' ,  {{ $item->sewa_status }})">
                                Bayar Sekarang <i class="mdi mdi-arrow-right mr-1"></i>
                             </a>
                             @else
                             <a class="btn btn-info " style="cursor: pointer; color: white;" wire:click="showPage('{{ $item->sewa_no }}' ,  {{ $item->sewa_status }})">
                                Detail Sewa <i class="mdi mdi-arrow-right mr-1"></i>
                             </a>
                             @endif
                         </div>
                     </div>

                     </td>
                 </tr>
            @endforeach
        </tbody>

    </table>


</div>
