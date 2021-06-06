<!-- Modal form-->
<div wire:ignore.self class="modal fade" id="modalShowFormRole" tabindex="-1" role="dialog" aria-labelledby="modalShowFormRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowFormRoleLabel">
                    @if ($method == 'store')
                        Nuevo rol
                    @else
                        {{ $role->name }}
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
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="my-5">
                                <div class="form-group row" >
                                    <label class="col-3">Nombre del rol <span class="text-danger">*</span></label>
                                    <div class="col-9">
                                        <div class="input-group input-group-solid">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-cog"></i>
                                                </span>
                                            </div>
                                            <input 
                                                wire:loading.attr="disabled"
                                                wire:model.defer="role.name" 
                                                type="text" 
                                                class=" form-control form-control-solid @error('role.name') is-invalid @enderror"  
                                                placeholder="Nombre del rol" /> 
                                        </div>
                                        @error('role.name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @if ($permissions)
                                <div class="form-group row">
                                    @foreach ($permissions as $permission)
                                    <label class="col-6 col-form-label">{{ $permission->name }}
                                        <div class="col-6">
                                            <span class="switch switch-outline switch-icon switch-warning">
                                                <label>
                                                    <input 
                                                        wire:model.defer="permissionsArray"
                                                        type="checkbox" 
                                                        value="{{ $permission->name }}"
                                                        name="permissionArray"
                                                    >
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                                @endif
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