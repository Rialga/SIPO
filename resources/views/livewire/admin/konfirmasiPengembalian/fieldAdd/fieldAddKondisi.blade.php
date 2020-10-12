            <div>
                <div class="table-responsive">
                    <table table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th class="text-sm-center" style="width: 50px"> No </th>
                                <th style="width: 200px"> Nama Alat </th>
                                <th class="text-sm-center" style="width: 100px"> Stok </th>
                                <th class="text-sm-center"> Kondisi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSewa->detail_sewa as $item)
                            <tr>
                                <td class="text-sm-center"> {{$loop->iteration}}</td>
                                <td>
                                    ({{ $item->alat->alat_kode }}) <br>
                                    {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }} <br>
                                    Tipe : {{ $item->alat->alat_tipe }}
                                </td>
                                <td class="text-sm-center"> {{ $item->detail_sewa_total }} unit</td>
                                <td>
                                    <div class="row text-sm-center">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">idfield:{{ $idField }} | num = {{ $num }}</label><br>
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
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label">Jumlah </label>
                                                <input class="form-control"  type="number" wire:model.lazy="jumlahKondisi.{{ $idField }}.0"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
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
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">idfiled:{{ $idField }} | num = {{ $num }} | value = {{ $value }} | id {{ $id }}</label> <br>
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
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label">Jumlah </label>
                                                <input class="form-control"  type="number" wire:model.lazy="jumlahKondisi.{{ $idField }}.{{ $value }}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
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
                        <button class="btn btn-primary" onclick="return false" wire:click="createKondisi">Simpan</button>
                    </div>
                </div>
            </div>
