<div class="container">

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
                                <label class="col-3">Cliente <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div wire:ignore wire:key="client_id">
                                        <select 
                                            wire:change="clientChange($event.target.value)"
                                            wire:model="invoice.client_id" 
                                            class="form-control selectpicker form-control-solid @error('invoice.client_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            data-show-subtext="true"
                                        >
                                            <option value="">Ninguno</option>
                                            @foreach ($clients as $c)
                                                <option data-subtext="{{ $c->company }}" value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('invoice.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Total <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="invoice.total" 
                                            class="form-control form-control-solid @error('invoice.total') is-invalid @enderror" 
                                            type="number" 
                                            placeholder="Ej: 8000" />
                                    </div>
                                    @error('invoice.total') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Factura <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    
                                    <div class="d-flex jutify-content-start mb-3" >
                                        @if ($invoiceTmp || $invoice->url)
                                            <img 
                                                width="65" 
                                                src="{{ asset('assets') }}/media/svg/files/pdf.svg" alt=""
                                                >
                                        @endif
                                    </div>
                                   
                                    <div
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                        <div wire:ignore wire:key="invoicefile">
                                            <input 
                                                wire:model.defer="invoiceTmp" 
                                                class="bfi form-control form-control-solid @error('invoiceTmp') is-invalid @enderror" 
                                                type="file" 
                                                accept=".pdf"
                                                id="invoiceTmp"
                                                required
                                            />
                                        </div>
                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                    
                                    
                                    @error('invoiceTmp') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Concepto </label>
                                <div class="col-9">
                                    <input 
                                        wire:model.defer="invoice.concept" 
                                        type="text" 
                                        required
                                        class="form-control form-control-solid @error('invoice.concept') is-invalid @enderror"  
                                        placeholder="Ej: Número de referencia o de factura" 
                                    />
                                    @error('invoice.concept') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Seleccionar servicios correspondientes a la factura</h3>
                            <div class="form-group m-0">
                                <div class="spinner" wire:loading wire:target="clientChange"></div>
                                <div class="row" wire:loading.remove wire:target="clientChange">
                                    @forelse ($client->services as $service)
                                    <div class="col-lg-6">
                                        <label class="option">
                                            <span class="option-control">
                                                <span class="checkbox">
                                                    <input 
                                                        wire:model.defer="serviceArray"
                                                        type="checkbox" 
                                                        name="serviceArray[]" 
                                                        value="{{ $service->id }}" 
                                                    />
                                                    <span></span>
                                                </span>
                                            </span>
                                            <span class="option-label">
                                                <span class="option-head">
                                                    <span class="option-title">{{ $service->name }}</span>
                                                    <span class="option-focus">{{ $service->priceToString() }}</span>
                                                </span>
                                                <span class="option-body">{{ $service->note }}</span>
                                            </span>
                                        </label>
                                    </div>
                                    @empty
                                        <span class="badge badge-secondary">No se encontró ningun servicio ligado a este usuario</span>
                                    @endforelse
                                </div>
                            </div>
                            
                        </div>
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
    @endsection
        
</div>
