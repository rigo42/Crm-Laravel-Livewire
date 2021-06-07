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
                            <h3 class="text-dark font-weight-bold mb-10">Información general</h3>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Imagen </label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="image-input image-input-outline" >
                                        <div 
                                            class="image-input-wrapper"
                                            @if ($imageTmp)
                                                style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                            @elseif($user->image)
                                                style="background-image: url('{{ Storage::url($user->image->url) }}')"
                                            @else    
                                                style="background-image: url('{{ asset('assets/media/users/blank.png') }}')"
                                            @endif
                                            >
                                        </div>
                                        <div
                                            x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-edit" >
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input wire:model.defer="imageTmp" type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" class="d-none"/>
                                            </label>

                                            <!-- Progress Bar -->
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                        @if ($imageTmp || $user->image)
                                        <span 
                                            wire:click="removeImage()"
                                            wire:loading.class="spinner spinner-primary spinner-sm" wire:target="removeImage"
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-remove" 
                                            title="Remover imagen">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                        @endif
                                    </div>
                                    @error('imageTmp') 
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Nombre <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-user"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="user.name" 
                                            type="text" 
                                            class="form-control form-control-solid @error('user.name') is-invalid @enderror"  
                                            placeholder="Nombre del usuario" />
                                    </div>
                                    @error('user.name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Correo <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-at"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="user.email" 
                                            type="email" 
                                            class="form-control form-control-solid @error('user.email') is-invalid @enderror" 
                                            placeholder="Correo electronico" />
                                    </div>
                                    @error('user.email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Puesto <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-cog"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="user.position" 
                                            type="text" 
                                            class="form-control form-control-solid @error('user.position') is-invalid @enderror" 
                                            placeholder="Puesto del usuario" />
                                    </div>
                                    @error('user.position') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        @can('usuarios')

                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Roles a asignar</h3>
                            @if ($roles)
                                <div class="form-group row">
                                    @foreach ($roles as $role)
                                    <label class="col-6 col-form-label">{{ $role->name }}
                                        <div class="col-6">
                                            <span class="switch switch-outline switch-icon switch-warning">
                                                <label>
                                                    <input 
                                                        wire:model.defer="rolesArray"
                                                        type="checkbox" 
                                                        value="{{ $role->name }}"
                                                        name="roleArray"
                                                    >
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                                @error('rolesArray') 
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            @endif
                        </div>

                        @endcan
                    </div>
                    <div class="col-xl-2"></div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Card-->
        
</div>
