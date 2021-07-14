<div>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
               
            </div>
            <div class="card-toolbar">
                <button 
                    wire:click="{{ $method }}"
                    wire:loading.class="spinner spinner-white spinner-right" 
                    wire:loading.attr="disabled" 
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
                                <label class="col-3">Nombre <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="serviceType.name" 
                                            type="text" 
                                            class="form-control form-control-solid @error('serviceType.name') is-invalid @enderror"  
                                            placeholder="Ej: Gestión de redes sociales" /> 
                                    </div>
                                    @error('serviceType.name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label class="col-3">Precio <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <input 
                                            wire:model.defer="serviceType.price" 
                                            type="number" 
                                            class="form-control form-control-solid @error('serviceType.price') is-invalid @enderror"  
                                            placeholder="Ej: 8000" /> 
                                    </div>
                                    @error('serviceType.price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>