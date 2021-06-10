<div class="container" x-data="app()">

    @section('head')
        <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bfi/bfi.css') }}">
    @endsection
    
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
                            @include('component.error-list')
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Imagen </label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="image-input image-input-outline" >
                                        <div 
                                            class="image-input-wrapper"
                                            @if ($imageTmp)
                                                style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                            @elseif($prospect->image)
                                                style="background-image: url('{{ Storage::url($prospect->image->url) }}')"
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
                                        @if ($imageTmp || $prospect->image)
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
                                            wire:model.defer="prospect.name" 
                                            type="text" 
                                            required
                                            class="form-control form-control-solid @error('prospect.name') is-invalid @enderror"  
                                            placeholder="Nombre del cliente" />
                                    </div>
                                    @error('prospect.name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Interes <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="prospect.interest" 
                                        class="form-control form-control-solid @error('prospect.interest') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Ej: Gestión de Redes Sociales" />
                                    @error('prospect.interest') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Información extra</h3>
                            
                            <div class="form-group row">
                                <label class="col-3">Correo</label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-at"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="prospect.email" 
                                            type="email" 
                                            class="form-control form-control-solid @error('prospect.email') is-invalid @enderror" 
                                            placeholder="Correo electronico" />
                                    </div>
                                    @error('prospect.email') <span class="text-danger">{{ $message }}</span> @enderror
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
                                            wire:model.defer="prospect.phone" 
                                            type="text" class="form-control form-control-solid @error('prospect.phone') is-invalid @enderror" 
                                            placeholder="Teléfono o celular" />
                                    </div>
                                    @error('prospect.phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Origen</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="prospect.origin" 
                                        class="form-control form-control-solid @error('prospect.origin') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Ej: Contactado por facebook"/>
                                    @error('prospect.origin') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Empresa</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="prospect.company" 
                                        class="form-control form-control-solid @error('prospect.company') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Nombre de la empresa"/>
                                    <span class="form-text text-muted">En caso de que el cliente sea una empresa</span>
                                    @error('prospect.company') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Status</label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="prospect.status" 
                                        class="form-control form-control-solid @error('prospect.status') is-invalid @enderror" 
                                        type="text" 
                                        placeholder="Ej: Cotización enviada" />
                                    @error('prospect.status') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Cotización</label>
                                <div class="col-9">
                                    
                                    <div class="d-flex jutify-content-start mb-3" >
                                        @if ($quotationTmp || $prospect->quotation)
                                            <img 
                                                width="65" 
                                                src="{{ asset('assets') }}/media/svg/files/pdf.svg" alt=""
                                                >
                                            <span 
                                                x-on:click="removeFile('removeQuotation', 'quotationTmp')"
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-remove" 
                                                style="position: inherit;"
                                                title="Remover cotización">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                <span 
                                                    wire:loading.class="spinner spinner-primary spinner-sm"
                                                    wire:target="removeQuotation"
                                                    style="position: absolute; left: 81px;">
                                                </span>
                                            </span>
                                        @endif
                                    </div>
                                   
                                    <div
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                        <div wire:ignore wire:key="quotationfile">
                                            <input 
                                                wire:model.defer="quotationTmp" 
                                                class="bfi form-control form-control-solid @error('quotationTmp') is-invalid @enderror" 
                                                type="file" 
                                                accept=".pdf"
                                                id="quotationTmp"
                                            />
                                        </div>
                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                    
                                    
                                    @error('quotationTmp') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                        </div>

                        @role('Administrador')

                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Pertenece al usuario</h3>
                            <div class="form-group row">
                                <label class="col-3">Usuario</label>
                                <div class="col-9">
                                    <div wire:ignore>
                                        <select 
                                            wire:model.defer="userId" 
                                            class="form-control selectpicker form-control-solid @error('userId') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true">
                                            <option value="">Ninguno</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Este es el usuario responsable del cliente</span>
                                    @error('userId') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                        </div>

                        @endrole
                    </div>
                    <div class="col-xl-2"></div>
                </div>
                <button class="d-none" type="submit"></button>
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Card-->

    @section('footer')
        <script src="{{ asset('assets/plugins/custom/bfi/bfi.js') }}"></script>
        <script>
            function app() {
                return {
                    removeFile(functionRemove, fileId) { 
                        @this.call(functionRemove);
                        bfi_clear('#'+fileId);
                    },
                }
            }
        </script>
    @endsection
        
</div>
