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

                            @include('component.error-list')

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Imagen </label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="image-input image-input-outline" >
                                        <div 
                                            class="image-input-wrapper"
                                            @if ($imageTmp)
                                                style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                            @elseif($provider->image)
                                                style="background-image: url('{{ Storage::url($provider->image->url) }}')"
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
                                        @if ($imageTmp || $provider->image)
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
                                            wire:model.defer="provider.name" 
                                            type="text" 
                                            class="form-control form-control-solid @error('provider.name') is-invalid @enderror"  
                                            placeholder="Ej: Gestión de redes sociales" /> 
                                    </div>
                                    @error('provider.name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label class="col-3">Descripción <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <input 
                                            wire:model.defer="provider.description" 
                                            type="text" 
                                            class="form-control form-control-solid @error('provider.description') is-invalid @enderror"  
                                            placeholder="Ej: 8000" /> 
                                    </div>
                                    @error('provider.description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>