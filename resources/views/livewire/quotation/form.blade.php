<div class="container" x-data="app()">

    @section('head')
        <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bfi/bfi.css') }}">
    @endsection

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="clientFormModal" tabindex="-1" aria-labelledby="clientFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="clientFormModalLabel">Nuevo cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @livewire('client.form', ['method' => 'storeCustom'])
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
            </div>
        </div>
        </div>
    </div>
    
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
                                    <div >
                                        <select 
                                            wire:model.defer="quotation.client_id" 
                                            class="form-control selectpicker form-control-solid @error('quotation.client_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            data-show-subtext="true"
                                            required>
                                            <option value="">Selecciona un cliente</option>
                                            @foreach ($clients as $client)
                                                <option data-subtext="{{ $client->company }}" value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije el cliente correspondiente al servicio</span>
                                    <a href="#"  data-toggle="modal" data-target="#clientFormModal" class="text-primary" >Crear nuevo cliente</a>
                                    @error('quotation.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
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
                                            wire:model.defer="quotation.total" 
                                            class="form-control form-control-solid @error('quotation.total') is-invalid @enderror" 
                                            type="number" 
                                            placeholder="Ej: 8000" 
                                        />
                                    </div>
                                    @error('quotation.total') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>     
                            <div class="form-group row">
                                <label class="col-3">Fecha de inicio<span class="text-danger">*</span></label>
                                <div class="col-9" wire:ignore wire:key="start_date">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                        <input
                                            wire:model.defer="quotation.start_date"
                                            value="{{ $quotation->start_date }}"
                                            type="text" 
                                            class="start_date form-control form-control-solid @error('quotation.start_date') is-invalid @enderror"  
                                            placeholder="Seleccione la fecha de inicio"
                                        />
                                    </div>
                                    @error('quotation.start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Fecha de vencimiento <span class="text-danger">*</span></label>
                                <div class="col-9" wire:ignore wire:key="due_date">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                        <input
                                            wire:model.defer="quotation.due_date"
                                            value="{{ $quotation->due_date }}"
                                            type="text" 
                                            class="due_date form-control form-control-solid @error('quotation.due_date') is-invalid @enderror"  
                                            readonly="readonly" 
                                            placeholder="Seleccione la fecha de vencimiento"
                                            />
                                    </div>
                                    @error('quotation.due_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>                      
                            <div class="form-group row">
                                <label class="col-3">Concepto <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
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
        <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
        <script>
            function app() {
                return {
                    removeFile(functionRemove, fileId) { 
                        @this.call(functionRemove);
                        bfi_clear('#'+fileId);
                    },
                }
            }

            // Init date
            $('.start_date').datepicker({
                format: "yyyy/mm/dd",
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                autoclose: true,
                language: 'es',
                orientation: "bottom left",
            }).on('changeDate', function(e){
                @this.set('quotation.start_date', e.target.value);
            });

            // Init date
            $('.due_date').datepicker({
                format: "yyyy/mm/dd",
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                autoclose: true,
                language: 'es',
                orientation: "bottom left",
            }).on('changeDate', function(e){
                @this.set('quotation.due_date', e.target.value);
            });

            Livewire.on('renderJs', function(){
                $('.selectpicker').selectpicker({
                    liveSearch: true
                });
            });

            Livewire.on('render', function(){
                $("#clientFormModal").modal('hide');
            });
        </script>
    @endsection
        
</div>
