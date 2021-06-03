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
                                            @elseif($client->image)
                                                style="background-image: url('{{ Storage::url($client->image->url) }}')"
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
                                        @if ($imageTmp)
                                        <span 
                                            wire:click="removeImage()"
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
                                            wire:model.defer="client.name" 
                                            type="text" 
                                            class="form-control form-control-solid @error('client.name') is-invalid @enderror"  
                                            placeholder="Nombre del cliente" />
                                    </div>
                                    @error('client.name') <span class="text-danger">{{ $message }}</span> @enderror
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
                                            wire:model.defer="client.email" 
                                            type="email" 
                                            class="form-control form-control-solid @error('client.email') is-invalid @enderror" 
                                            placeholder="Correo electronico" />
                                    </div>
                                    @error('client.email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Teléfono</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-phone"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="client.phone" 
                                            type="text" class="form-control form-control-solid @error('client.phone') is-invalid @enderror" 
                                            placeholder="Teléfono o celular" />
                                    </div>
                                    @error('client.phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Origen</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="client.origin" 
                                        class="form-control form-control-solid @error('client.origin') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Ej: Contactado por facebook"/>
                                    @error('client.origin') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Empresa</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="client.company" 
                                        class="form-control form-control-solid @error('client.company') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Nombre de la empresa"/>
                                    <span class="form-text text-muted">En caso de que el cliente sea una empresa</span>
                                    @error('client.company') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Información extra</h3>
                            
                            <div class="form-group row">
                                <label class="col-3">Dirección</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="client.address" 
                                        class="form-control form-control-solid @error('client.address') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Dirección fisica" />
                                    @error('client.address') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Razón social</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="client.social_reason" 
                                        class="form-control form-control-solid @error('client.social_reason') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Razón social" />
                                    @error('client.social_reason') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Dirección fiscal</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="client.fiscal_address" 
                                        class="form-control form-control-solid @error('client.fiscal_address') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Dirección fiscal" />
                                    @error('client.fiscal_address') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">RFC</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="client.rfc" 
                                        class="form-control form-control-solid @error('client.rfc') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="RFC" />
                                    @error('client.rfc') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">¿Premium?</label>
                                <div class="col-3">
                                    <span class="switch switch-outline switch-icon switch-primary">
                                        <label>
                                            <input 
                                                wire:model.defer="client.premium"
                                                class="@error('client.premium') is-invalid @enderror"
                                                type="checkbox" />
                                            <span></span>
                                        </label>
                                    </span>
                                    @error('client.premium') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Pertenece al usuario</h3>
                            <div class="form-group row">
                                <label class="col-3">Usuario</label>
                                <div class="col-9">
                                    <div wire:ignore>
                                        <select 
                                            wire:model.defer="client.user_id" 
                                            class="form-control selectpicker form-control-solid @error('client.user_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true">
                                            <option value="">Ninguno</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Este es el usuario responsable del cliente</span>
                                    @error('client.user_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
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
