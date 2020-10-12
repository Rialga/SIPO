    <div class="table-responsive">
        <table class="table table-nowrap">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Item</th>
                    <th style="text-align: center" colspan="2" >Stok</th>
                    <th style="text-align: center" >Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dataSewa->detail_sewa as $item)
            <tr>
                <td>-</td>
                <td>
                    <input disabled class="form-control" value="[{{ $item->alat->alat_kode }}] {{ $item->alat->jenis_alat->jenis_alat_nama }} - {{ $item->alat->merk->merk_nama }}"/>
                </td>
                <td>
                    <input type="number" class="form-control col-sm-3 mb-2 pt-2 float-right" wire:model.lazy="stokNow.{{ $item->alat->alat_kode }}" >
                </td>
                <td width="20%">

                        @if($editConfirm === $item->alat->alat_kode )
                            Anda Yakin ? <br>
                            <a wire:click="editStok('{{ $item->alat->alat_kode }}')" class="btn btn-success btn-default waves-effect waves-light pt-2"" title="Ya"><i class="mdi mdi-check-bold" style="color: white"></i></a>
                            <a wire:click="confirm('edit','{{ $item->alat->alat_kode }}')"class="btn btn-danger btn-default waves-effect waves-light pt-2"" title="Tidak"><i class="dripicons-cross" style="color: white"></i></a>
                        @else
                            <a wire:click="confirm('edit','{{ $item->alat->alat_kode }}')" class="action-icon text-warning mb-2 pt-2"> <i class="far fa-edit font-size-18 mb-2 pt-2"" style="cursor: pointer;"></i></a>
                        @endif

                </td>
                <td style="text-align: center">
                        @if($deleteConfirm === $item->alat->alat_kode )
                            Anda Yakin ? <br>
                            <a wire:click="removeAlat('{{ $item->alat->alat_kode }}')" class="btn btn-success btn-default waves-effect waves-light pt-2"" title="Ya"><i class="mdi mdi-check-bold" style="color: white"></i></a>
                            <a wire:click="confirm('delete','{{ $item->alat->alat_kode }}')"class="btn btn-danger btn-default waves-effect waves-light pt-2"" title="Tidak"><i class="dripicons-cross" style="color: white"></i></a>
                        @else
                            <a wire:click="confirm('delete','{{ $item->alat->alat_kode }}')" class="btn btn-danger waves-effect waves-light pt-3"> <i class="fas fa-trash-alt font-size-18" style="color: white"></i></a>
                        @endif
                </td>
            </tr>
            @endforeach
            @foreach($inputs as $key => $value)
                <tr>
                    <td>-</td>
                    <td>
                        <select class="form-control select2" wire:model.lazy ="alat.{{ $key }}">
                            @if ($dataAlat->count() == 0)
                                <option value=""> >> Data Kosong << </option>
                            @else
                                <option value=""> >> Pilih << </option>
                                @foreach ($dataAlat as $row)
                                    <option value="{{ $row->alat_kode }}"> [{{$row->alat_kode}}] {{$row->jenis_alat->jenis_alat_nama}} - {{$row->merk->merk_nama}}</option>
                                @endforeach
                            @endif
                        </select> <br>
                        @error('alat.'.$key) <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                    </td>

                    <td style="text-align: center" >

                            <input type="number" class="form-control col-sm-3 float-md-right" wire:model.lazy="stok.{{ $key }}">

                         <br><br>
                         @error('stok.'.$key) <span class="pt-2 float-md-right" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
                    </td>

                    <td style="text-align: center" colspan="2" >
                        <button wire:click.prevent="remove({{$key}})" class="btn btn-danger float-md-right mr-3" onclick="return false"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right">
                    <button  wire:click.prevent="add({{$num}})" type="button" class="btn btn-success  waves-effect waves-light mb-2 pt-2 float-right">+ Alat</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="d-print-none">
        <div class="float-right">
            <button class="btn btn-secondary" onclick="return false" wire:click="edit('{{ false }}')" >Kembali</button>&nbsp; &nbsp;&nbsp;

            @if($inputs == null)
            <button class="btn btn-warning" onclick="return false" wire:click="update" disabled>Tambah Alat</button>
            @else
            <button class="btn btn-warning" onclick="return false" wire:click="update">Tambah Alat</button>
            @endif
        </div>
    </div>
