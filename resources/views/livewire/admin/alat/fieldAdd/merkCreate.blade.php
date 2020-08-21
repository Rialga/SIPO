<div class="form-group row" id="div_inputMerk">
    <label class="col-sm-4 control-label text-sm-right pt-2">Merk</label>
    <div class="col-sm-4">
        <div class="input-group">
            <input type="text" name="inputMerk" id="inputMerk" class="form-control" placeholder="merk" wire:model.lazy="inputMerk"/>
            <span class="input-group-prepend">
                <button wire:click="cancelAddMerk()" class="btn btn-danger" id="cancelAddMerk" onclick="return false"><i class="fas fa-window-close"></i> Cancel </button>
            </span>
        </div>
    </div>
    @error('inputMerk') <span class="pt-2" style="color: red">{{ $message }}</span> @enderror
</div>



