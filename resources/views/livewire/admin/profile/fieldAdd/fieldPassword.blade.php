{{-- User Pasword --}}
<div class="form-group row">
    <label class="col-sm-2 control-label text-sm-right pt-2">Password</label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="password" name="userPassword" class="form-control" wire:model="userPassword" required/>
                <button wire:click="addPassword('{{ false }}')" class="btn btn-danger" id="addPassword" onclick="return false"><i class="dripicons-cross"></i> Cancel </button>
        </div>
        <br> @error('userPassword') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
    </div>
</div>



{{-- reType Pasword --}}
<div class="form-group row">
    <label class="col-sm-2 control-label text-sm-right pt-2">Retype Password</label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="password" name="retypePassword" class="form-control" wire:model="retypePassword" required/>
        </div>
        <br> @error('retypePassword') <span class="pt-2" style="color: red">{{ $message }}</span>  {{$checkKode=false}} @enderror
    </div>
</div>
