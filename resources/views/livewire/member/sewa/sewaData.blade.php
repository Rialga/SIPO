<div>

    <table class="table table-hover mb-0">


        <tbody>

            @forelse ($dataSewa as $item)

                <tr>
                    <td>
                     <p> {{ Carbon\Carbon::parse($item->created_at)->format('d, M Y') }} </p>
                     <hr width="100%">

                     <div class="row">
                         <div class="col-lg-3">
                             <a class="mb-4" data-toggle="collapse" href="#sewa{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapseExample">
                                 <span style="color: black"> {{ $item->sewa_no }} </span>
                             </a>
                         </div>
                         <div class="col-lg-2" style="text-align: center">
                            @if($item->sewa_status == 0)
                                Status :<br> <b style="color: red"> {{ $item->status_sewa->status_detail }} </b>
                            @elseif($item->sewa_status == 1)
                                Status :<br> <b style="color: orange"> {{ $item->status_sewa->status_detail }}  </b>
                            @elseif($item->sewa_status == 2 or $item->sewa_status == 3 or $item->sewa_status == 4 or $item->sewa_status == 5)
                                Status :<br> <b style="color: #0AC8C8"> {{ $item->status_sewa->status_detail }}  </b>
                            @elseif($item->sewa_status == 6)
                                Status :<br> <b style="color: green"> {{ $item->status_sewa->status_detail }}  </b>
                            @else
                                Status :<br> <b style="color: red"> {{ $item->status_sewa->status_detail }}  </b>
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
                        @foreach ($item->detail_sewa as $data)
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="product-img position-relative text-center">
                                    <img class="card-img img-fluid mt-4" src="{{ asset("storage/gambarAlat/".$data->alat->gambar_alat[0]->gambar_file) }}" alt="" class="img-fluid mx-auto d-block" style=" width:100px; height: 100px;">
                                </div>
                                <div class="mt-2 mb-4 text-center">
                                    <h5 class="card-title">{{ $data->detail_sewa_alat_kode }}</h5>
                                    <p class="card-text">{{ $data->alat->jenis_alat->jenis_alat_nama }} <br>( {{ $data->alat->merk->merk_nama }} ) <br> {{ $data->alat->alat_tipe }}</p>
                                    <p class="card-text"><b class="text-muted">Rp. {{ $data->alat->jenis_alat->jenis_alat_harga }} x {{ $data->detail_sewa_total}} unit</b></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row justify-content-end">
                        @if($item->sewa_status == 1 OR $item->sewa_status == 7)
                         <a class="btn btn-warning" style="cursor: pointer; color: white;" wire:click="showPage('{{ $item->sewa_no }}' ,  {{ $item->sewa_status }})">
                            Bayar Sekarang <i class="mdi mdi-arrow-right mr-1"></i>
                         </a>
                         @else
                         <a class="btn btn-info " style="cursor: pointer; color: white;" wire:click="showPage('{{ $item->sewa_no }}' ,  {{ $item->sewa_status }})">
                            Detail Sewa <i class="mdi mdi-arrow-right mr-1"></i>
                         </a>
                         @endif
                     </div>

                    </td>
                 </tr>
            @empty

            <h3 class="mb-5" style="text-align: center">

                <br><br>
                    <i style="color: gray">Tidak Ada Data</i>
                <br>

            </h3>

            @endforelse
        </tbody>

    </table>


</div>
