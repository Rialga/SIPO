
 <div class="form-group row" id="div_inputJenis">
     <label class="col-sm-4 control-label text-sm-right pt-2">Jenis Alat</label>
     <div class="col-sm-4">
         <div class="input-group">
             <input type="text" name="inputJenis" id="inputJenis" class="form-control" placeholder=" Nama Jenis " wire:model.lazy="inputJenisAlat" />
             <span class="input-group-prepend">
                 <button wire:click="cancelAddJenis()" class="btn btn-danger" id="cancelAddJenis" onclick="return false"><i class="fas fa-window-close"></i> Cancel </button>
             </span>
         </div>
     </div>
     @error('inputJenisAlat') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
 </div>

 <div class="form-group row" id="div_inputHarga">
     <label class="col-sm-4 control-label text-sm-right pt-2">Harga Sewa</label>
     <div class="col-sm-2">
         <div class="input-group">
             <label class="pt-2">Rp</label> &nbsp;&nbsp;
             <input type="number" name="inputHarga" id="inputHarga" class="form-control" placeholder=" harga " wire:model.lazy = "inputJenisHarga" />
         </div>
     </div>
     @error('inputJenisHarga') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
 </div>


