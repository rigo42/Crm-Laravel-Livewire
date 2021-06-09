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
            <form class="form" wire:submit.prevent="{{ $method }}" >
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Información general</h3>
                            @include('component.error-list')

                            <div class="form-group row">
                                <label class="col-3">Cliente <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div wire:ignore wire:key="client_id">
                                        <select 
                                            wire:model.defer="quotation.client_id" 
                                            class="form-control selectpicker form-control-solid @error('quotation.client_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona un cliente</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije el cliente correspondiente a la factura</span>
                                    @error('quotation.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>

                           
                            <div class="form-group row">
                                <label class="col-3">Concepto <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-user"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="quotation.concept" 
                                            type="text" 
                                            required
                                            class="form-control form-control-solid @error('quotation.concept') is-invalid @enderror"  
                                            placeholder="Ej: Servicio de redes y página web" />
                                    </div>
                                    @error('quotation.concept') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3">Cotización <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    
                                    <div class="d-flex jutify-content-start mb-3" >
                                        @if ($quotationTmp || $quotation->url)
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
                                                required
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
                            <h3 class="text-dark font-weight-bold mb-10">Factura creada por el usuario</h3>
                            <div class="form-group row">
                                <label class="col-3">Usuario <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div wire:ignore>
                                        <select 
                                            wire:model.defer="userId" 
                                            class="form-control selectpicker form-control-solid @error('userId') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Ninguno</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Este es el usuario responsable de la factura</span>
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
