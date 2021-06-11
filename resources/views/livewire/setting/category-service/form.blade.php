<div>
    <!-- Modal-->
    <div wire:ignore.self class="modal fade" id="modalShowFormCategoryService" tabindex="-1" role="dialog" aria-labelledby="modalShowFormCategoryServiceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalShowFormCategoryServiceLabel">
                        @if ($method == 'store')
                            Nueva categoría
                        @else
                            Editar categoría {{ $categoryService->name }}
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
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
                                                    wire:loading.attr="disabled"
                                                    wire:model.defer="categoryService.name" 
                                                    type="text" 
                                                    class=" form-control form-control-solid @error('categoryService.name') is-invalid @enderror"  
                                                    placeholder="Ej: Campaña y anuncios en Google ads" /> 
                                            </div>
                                            @error('categoryService.name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" wire:ignore.self wire:key="{{ $method }}">
                    <button type="button" class="btn btn-light-secondary text-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
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
        </div>
    </div>

</div>