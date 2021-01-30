            <div>
                <div class="table-responsive">
                    <table table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th class="text-sm-center" style="width: 50px"> No </th>
                                <th style="width: 200px"> Nama Alat </th>
                                <th class="text-sm-center" style="width: 100px"> Stok </th>
                                <th class="text-sm-center"> Kondisi Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSewa->detail_sewa as $item)
                            <tr>
                                <td class="text-sm-center">
                                     {{$loop->iteration}} <br>
                                     <div wire:loading class="spinner-border text-warning" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                                <td>
                                    ({{ $item->alat->alat_kode }}) <br>
                                    {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }} <br>
                                    Tipe : {{ $item->alat->alat_tipe }} <br>
                                    Kondisi (%) :
                                    <select class="form-control select2" id="{{ $item->alat->alat_kode }}" name="{{ $item->alat->alat_kode }}" wire:model="kTerbaru.{{ $item->alat->alat_kode }}">
                                            <option value="0% - 20%"> 0% - 20% </option>
                                            <option value="21% - 40%"> 21% - 40% </option>
                                            <option value="41% - 60%"> 41% - 60% </option>
                                            <option value="61% - 80%"> 61% - 80% </option>
                                            <option value="81% - 100%"> 81% - 100% </option>

                                    </select>
                                </td>
                                <td class="text-sm-center"> {{ $item->total_alat }} unit</td>
                                <td>
                                    <div class="row text-sm-center">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {{-- <label class="control-label">idfield:{{ $idField }} | num = {{ $num }}</label><br> --}}
                                                <label class="control-label">Pilih Kondisi</label>
                                                <select class="form-control select2" wire:model.lazy="pilihKondisi.{{$idField}}.0">
                                                    @if ($dataKondisi->count() == 0)
                                                        <option value=""> >> Data Kosong << </option>
                                                    @else
                                                        <option value=""> >> Pilih << </option>
                                                        @foreach ($dataKondisi as $item)
                                                            <option value="{{ $item->kondisi_id }}">{{$item->kondisi_keterangan}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label">Total Kerusakan </label>
                                                <input class="form-control"  type="number" wire:model.lazy="jumlahKondisi.{{ $idField }}.0"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label"> </label>
                                                <span class="input-group-prepend">
                                                    <button wire:click.prevent="addField({{$num}},{{ $idField }})" class="btn btn-success mt-1"  onclick="return false"><i class="fas fa-plus"></i> Tambah Kondisi</button>
                                                </span>
                                            </div>
                                        </div>

                                        <br>
                                        @error('pilihKondisi.'.$idField.'.0') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror &nbsp;&nbsp;&nbsp;&nbsp;
                                        @error('jumlahKondisi.'.$idField.'.0') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                    </div>

                                    @foreach($field[$idField] as $id => $value)
                                    <div class="row text-sm-center">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {{-- <label class="control-label">idfiled:{{ $idField }} | num = {{ $num }} | value = {{ $value }} | id {{ $id }}</label> <br> --}}
                                                <label class="control-label">Pilih Kondisi</label>
                                                <select class="form-control select2" wire:model.lazy="pilihKondisi.{{ $idField }}.{{ $value }}">
                                                    @if ($dataKondisi->count() == 0)
                                                        <option value=""> >> Data Kosong << </option>
                                                    @else
                                                        <option value=""> >> Pilih << </option>
                                                        @foreach ($dataKondisi as $item)
                                                            <option value="{{ $item->kondisi_id }}">{{$item->kondisi_keterangan}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label">Jumlah </label>
                                                <input class="form-control"  type="number" wire:model.lazy="jumlahKondisi.{{ $idField }}.{{ $value }}"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label"> </label>
                                                <span class="input-group-prepend">
                                                    <button wire:click.prevent="removeField({{$idField}},{{ $id }} , {{ $value }})" class="btn btn-danger mt-1"  onclick="return false"><i class="fas fa-minus"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <br>
                                        @error('pilihKondisi.'.$idField.'.'.$value) <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror &nbsp;&nbsp;&nbsp;&nbsp;
                                        @error('jumlahKondisi.'.$idField.'.'.$value) <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                                    </div>
                                    @endforeach
                                </td>
                            </tr>

                            <a type="hidden" value="{{ $idField++ }}"></a>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-print-none">
                    <div class="float-right">
                        <button class="btn btn-primary" onclick="return false" data-toggle="modal" data-target="#save">Simpan</button>
                    </div>
                </div>


                <div class="modal fade bs-example-modal-center" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="save">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body" style="text-align: center">
                                    <i class="mdi mdi-alert-circle-outline mb-4 mt-4" style="color: orange; font-size:100px" ></i>
                                    <h4 class="mb-4"> Simpan Kondisi? </h4>
                                    <button class="btn btn-success mb-2 mt-2 mr-2" onclick="return false" wire:click="createKondisi" data-dismiss="modal">Simpan</button>
                                    <button type="button" class="btn btn-danger waves-effect mb-2 mt-2 ml-2" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
