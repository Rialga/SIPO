<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-left font-size-20">{{ $invoice }}</h4> <br><br>
                        <h4 class="float-left font-size-15">( {{ $sewaStatus }} )</h4>
                        <a class="btn btn-secondary waves-effect waves-light float-right" title="edit"><i class="fas fa-edit" style="color: white"></i></a> <br><br>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <strong>Data Penyewa:</strong><br>
                                Member ID : {{ $dataSewa->user->user_id }}<br>
                                Nama : {{ $dataSewa->user->user_nama }}<br>
                                HP : {{ $dataSewa->user->user_phone}}<br>
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <address>
                                <strong>Tanggal Pemesanan:</strong><br>
                                {{ $sewaTglCreate }}<br><br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Rentang Peminjaman :</strong><br>
                                {{  \Carbon\Carbon::parse($tglPinjam)->format('d, M Y') }} - {{ \Carbon\Carbon::parse($tglKembali)->format('d, M Y') }} <br>
                                ({{ $totalHari }} Hari) <br>
                                Tujuan : {{ $sewaTujuan }} <br>
                            </address>
                        </div>

                        <div class="col-sm-6 mt-3 text-sm-right">
                            <address>
                                <strong>Tanggal Pembayaran:</strong><br>
                                {{ \Carbon\Carbon::parse($tglBayar)->format('d, M Y') }} | {{ \Carbon\Carbon::parse($tglBayar)->format('H:i') }} WIB<br>
                            </address>
                        </div>
                    </div>

                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Detail Sewa</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No.</th>
                                    <th>Item</th>
                                    <th style="width: 20px;">Jumlah</th>
                                    <th class="text-right">Harga Sewa</th>
                                    <th class="text-right"></th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataSewa->detail_sewa as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        ({{ $item->alat->alat_kode }}) <br>
                                        {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }} <br>
                                        Tipe : {{ $item->alat->alat_tipe }}
                                    </td>
                                    <td class="text-center"> {{ $item->detail_sewa_total }} Unit</td>
                                    <td class="text-right"> Rp. {{ $item->alat->jenis_alat->jenis_alat_harga }} </td>
                                    <td class="text-right"> = </td>
                                    <td class="text-right"> Rp. {{ number_format($item->detail_sewa_total * $item->alat->jenis_alat->jenis_alat_harga) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">Total Alat</td>
                                    <td class="text-right">Rp. {{ $hargaTotal }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Durasi Peminjaman</td>
                                    <td class="text-right">{{ $totalHari }} Hari</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="border-0 text-right">
                                        <strong>Total Sewa</strong></td>
                                    <td class="border-0 text-right"><h4 class="m-0"> Rp. {{ $fullPrice }}  </h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none">
                        <div class="float-right">
                            <button wire:click="clearForm()"  onclick="return false"  class="btn btn-default">Kembali</button>&nbsp; &nbsp;&nbsp;
                            <button class="btn btn-primary" onclick="return false" wire:click="create">Buat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



