<div class="container">
    
    <!--begin::Card-->
    <div class="card card-custom card-sticky" id="kt_page_sticky_card" >
        <div class="card-header" wire:ignore>
            <div class="card-title">
                <h3 class="card-label">@yield('title')</h3>
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
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                          
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
                            @else 
                                <span class="badge badge-secondary">No existe ningun permiso</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Card-->
        
</div>
