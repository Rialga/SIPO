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
                                        <input type="text" name="jenisAlat" class="form-control" placeholder="Jenis Alat" wire:model.debounce.600000ms="fieldJenisAlat" required/>
                                    </div>
                                    @error('fieldJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 text-left text-sm-right mb-0">Harga Sewa</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label class="pt-2">Rp:</label> &nbsp;&nbsp;&nbsp;
                                            <input type="number" name="jenisHarga" class="form-control" placeholder="Harga Sewa" wire:model.debounce.600000ms="fieldJenisHarga" required/>
                                        </div>
                                        @error('fieldJenisHarga') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" wire:click="create">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
