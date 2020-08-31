<div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="product-detai-imgs">
                            <div class="row">
                                <div class="col-md-2 col-sm-3 col-4">
                                    <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                        @foreach ($detailGambar as $item)
                                        <input hidden id="{{ $idDiv++ }}">
                                        <a class="nav-link " id="product-{{ $idDiv }}-tab" data-toggle="pill" href="#product-{{ $idDiv }}" role="tab" aria-controls="product-{{ $idDiv }}" aria-selected="false">
                                            <img src="{{ asset("storage/gambarAlat/$item->gambar_file") }}" alt="" class="img-fluid mx-auto d-block rounded">
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                    <div class="tab-content" id="v-pills-tabContent">

                                        <div class="tab-pane fade show active " id="product-{{ $idPic }}" role="tabpanel" aria-labelledby="product-{{ $idPic }}-tab">
                                            <div>
                                                <img src="{{ asset("storage/gambarAlat/$detailPic->gambar_file") }}" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                        @foreach ($detailGambar as $item)
                                        <input hidden id="{{ $idPic++ }}">
                                        <div class="tab-pane fade show " id="product-{{ $idPic }}" role="tabpanel" aria-labelledby="product-{{ $idPic }}-tab">
                                            <div>
                                                <img src="{{ asset("storage/gambarAlat/$item->gambar_file") }}" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mt-4 mt-xl-3">
                            <table>
                                <tr>
                                    <td> <h4> {{ $detailAlat->alat_kode }} </h4> </td>
                                </tr>
                                <tr>
                                    <td> <h8> Jenis Alat </h8> </td>
                                    <td> <h8> : </h8> </td>
                                    <td> <h8> {{ $detailAlat->jenis_alat->jenis_alat_nama }} </h8> </td>
                                </tr>
                                <tr>
                                    <td> <h8> Merk Alat </h8> </td>
                                    <td> <h8> : </h8> </td>
                                    <td> <h8> {{ $detailAlat->merk->merk_nama }} </h8> </td>
                                </tr>
                                <tr>
                                    <td> <h8> Tipe Alat </h8> </td>
                                    <td> <h8> : </h8> </td>
                                    <td> <h8> {{ $detailAlat->alat_tipe }} </h8> </td>
                                </tr>
                                <tr>
                                    <td> <h8> Jumlah Stok </h8> </td>
                                    <td> <h8> : </h8> </td>
                                    <td> <h8> {{ $detailAlat->alat_total }} unit</h8> </td>
                                </tr>
                                <tr>
                                    <td> <h8> Harga Sewa </h8> </td>
                                    <td> <h8> : </h8> </td>
                                    <td> <h8> Rp. {{ $detailAlat->jenis_alat->jenis_alat_harga }} / Hari</h8> </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-9" style="display: flex; justify-content: flex-end">
                         <a wire:click="clearForm()"  class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


