<div class="container" x-data="app()">

    @section('head')
        <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bfi/bfi.css') }}">
    @endsection

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="paymentTypeFormModal" tabindex="-1" aria-labelledby="paymentTypeFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="paymentTypeFormModalLabel">Nuevo tipo de pago</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @livewire('setting.payment-type.form', ['method' => 'storeCustom'])
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
            </div>
        </div>
        </div>
    </div>
    
    <div class="card card-custom card-sticky"  id="kt_page_sticky_card">
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
                                <label class="col-xl-3 col-lg-3 col-form-label">Comprobante de pago </label>
                                <div class="image-input image-input-outline" >
                                    <div 
                                        class="image-input-wrapper"
                                        @if ($imageTmp)
                                            style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                        @elseif($payment->image)
                                            style="background-image: url('{{ Storage::url($payment->image->url) }}')"
                                        @else    
                                            style="background-image: url('{{ asset('assets/media/payment/blank.png') }}')"
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
                                    @if ($imageTmp || $payment->image)
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
                            <div class="form-group row">
                                <div class="col-lg-6" wire:ignore wire:key="date">
                                    <label class="col-form-label">Fecha de pago <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                        <input
                                            wire:model.defer="payment.date"
                                            value="{{ $payment->start_date }}"
                                            type="text" 
                                            class="date form-control form-control-solid @error('payment.date') is-invalid @enderror"  
                                            placeholder="Seleccione la fecha de inicio"
                                            />
                                    </div>
                                    @error('payment.date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label">concepto <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-solid" >
                                        <input 
                                            wire:model.defer="payment.concept" 
                                            type="text" 
                                            required
                                            class="form-control form-control-solid @error('payment.concept') is-invalid @enderror" 
                                            placeholder="Ej: Número de pago" />
                                    </div>
                                    @error('payment.concept') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label">Cliente <span class="text-danger">*</span></label>
                                    <div wire:ignore wire:key="client" >
                                        <select 
                                            wire:change="clientChange($event.target.value)"
                                            wire:model.defer="payment.client_id" 
                                            class="form-control selectpicker form-control-solid @error('payment.client_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            data-show-subtext="true"
                                            required>
                                            <option value="">Selecciona un cliente</option>
                                            @foreach ($clients as $c)
                                                <option data-subtext="{{ $c->company }}" value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije el cliente correspondiente al pago</span>
                                    @error('payment.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label">Factura</label>
                                    <span wire:loading.class="spinner spinner-primary spinner-left" wire:target="clientChange"></span>
                                    <div>
                                        <select 
                                            wire:model="payment.invoice_id" 
                                            class="form-control selectpicker form-control-solid @error('payment.invoice_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            data-show-subtext="true"
                                            required
                                        >
                                            <option value="">Ninguna</option>
                                            @foreach ($client->invoices as $invoice)
                                                <option data-subtext="{{ $invoice->totalToString() }}" value="{{ $invoice->id }}">{{ $invoice->concept }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">En caso de que el pago tenga relación con la factura favor de seleccionar</span>
                                    @error('payment.invoice_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label">Cuenta <span class="text-danger">*</span></label>
                                    <div wire:ignore wire:key="account">
                                        <select 
                                            wire:model.defer="payment.account_id" 
                                            class="form-control selectpicker form-control-solid @error('payment.account_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona una cuenta</option>
                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije la cuenta que se recibio el pago</span>
                                    @error('payment.account_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label">Tipo de pago </label>
                                    <div>
                                        <select 
                                            wire:model.defer="payment.payment_type_id" 
                                            class="form-control selectpicker form-control-solid @error('payment.payment_type_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona un tipo de pago</option>
                                            @foreach ($paymentTypes as $paymentType)
                                                <option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije el tipo de pago que se realizó</span>
                                    <a href="#"  data-toggle="modal" data-target="#paymentTypeFormModal" class="text-primary" >Crear nuevo tipo de pago</a>
                                    @error('payment.payment_type_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label">Monto <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="payment.monto" 
                                            type="number" 
                                            required
                                            class="form-control form-control-solid @error('payment.monto') is-invalid @enderror" 
                                            placeholder="Ej: 8000" />
                                    </div>
                                    @error('payment.monto') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <div wire:ignore wire:key="user">
                                        <select 
                                            wire:model="userId" 
                                            class="form-control selectpicker form-control-solid @error('userId') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true">
                                            <option value="">Ninguno</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Este es el usuario responsable del pago</span>
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

            Livewire.on('renderJs', function(){
                $('#paymentTypeFormModal').modal('hide');
                $('.selectpicker').selectpicker({
                    liveSearch: true,
                    showSubtext: true
                });
            });

            // Init date
            $('.date').datepicker({
                format: "yyyy/mm/dd",
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                autoclose: true,
                language: 'es',
                orientation: "bottom left",
            }).on('changeDate', function(e){
                @this.set('payment.date', e.target.value);
            });

        </script>
    @endsection
        
</div>
