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
                                <label class="col-3">Nombre de la categoría <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="categoryClient.name" 
                                            type="text" 
                                            class="form-control form-control-solid @error('categoryClient.name') is-invalid @enderror"  
                                            placeholder="Ej: AAA" /> 
                                    </div>
                                    @error('categoryClient.name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label class="col-3">Descripción de la categoría <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <input 
                                            wire:model.defer="categoryClient.description" 
                                            type="text" 
                                            class="form-control form-control-solid @error('categoryClient.description') is-invalid @enderror"  
                                            placeholder="Ej: Ingresos mayores a $20,000" /> 
                                    </div>
                                    @error('categoryClient.description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>