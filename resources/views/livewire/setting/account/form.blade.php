<div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
               
            </div>
            <div class="card-toolbar">
                <button 
                    wire:click="{{ $method }}"
                    wire:loading.class="spinner spinner-white spinner-right" 
                    wire:target="{{ $method }}" 
                    class="btn btn-primary font-weight-bolder mr-2">
                    <i class="fa fa-save"></i>
                    Guardar cambios
                </button>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Form-->
            <form class="form" wire:submit.prevent="{{ $method }}">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="my-5">
                            <div class="form-group row" >
                                <label class="col-3">Nombre de la cuenta <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-credit-card"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="account.name" 
                                            type="text" 
                                            class="form-control form-control-solid @error('account.name') is-invalid @enderror"  
                                            placeholder="Ej: Tarjeta {{ config('app.name') }}" /> 
                                    </div>
                                    @error('account.name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label class="col-3">Tipo <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="account.type" 
                                        type="text" 
                                        class="form-control form-control-solid @error('account.type') is-invalid @enderror"  
                                        placeholder="Ej: Tarjeta de débito" /> 
                                    @error('account.type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>