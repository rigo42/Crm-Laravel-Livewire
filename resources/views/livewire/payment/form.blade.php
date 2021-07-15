<div class="container-fluid" >

    @section('head')
        <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bfi/bfi.css') }}">
    @endsection
    
    <!-- Payment type modal -->
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

    <!-- Invoice modal -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="invoiceFormModal" tabindex="-1" aria-labelledby="invoiceFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="invoiceFormModalLabel">Nueva factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    
                    @if ($client->services()->count())
                        @livewire('invoice.form', ['client' => $client, 'method' => 'storeCustom'], key('storeCustom'))

                    @else
                        @livewire('invoice.form', ['method' => 'storeCustom'], key('storeCustom'))

                    @endif
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-7">
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
                            <div class="col-xl-12">
                                <div class="my-5">
                                    <h3 class="text-dark font-weight-bold mb-10">Información general</h3>

                                    @include('component.error-list')

                                    
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <div  wire:ignore wire:key="date">
                                                <label class="col-form-label">Fecha de pago <span class="text-danger">*</span></label>
                                                <div class="input-group input-group-solid">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar"></i>
                                                        </span>
                                                    </div>
                                                    <input
                                                        wire:model.defer="payment.date"
                                                        value="{{ $payment->date }}"
                                                        type="text" 
                                                        class="date form-control form-control-solid @error('payment.date') is-invalid @enderror"  
                                                        placeholder="Seleccione la fecha de pago"
                                                        />
                                                </div>
                                            </div>
                                            @error('payment.date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="col-form-label">Concepto <span class="text-danger">*</span></label>
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
                                            <label class="col-form-label">Cuenta {{ $payment->account_id }} <span class="text-danger">*</span></label>
                                            <div >
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
                                            @error('payment.account_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="col-form-label">Tipo de pago <span class="text-danger">*</span></label>
                                            <div >
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
                                            <a href="#" data-toggle="modal" data-target="#paymentTypeFormModal" class="text-primary" >Crear nuevo tipo de pago</a>
                                            @error('payment.payment_type_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
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
                                            @error('payment.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label class="col-form-label">Nota </label>
                                            <div class="input-group input-group-solid">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-comments"></i>
                                                    </span>
                                                </div>
                                                <textarea 
                                                    wire:model.defer="payment.note"
                                                    name="" 
                                                    id="" 
                                                    cols="30" 
                                                    rows="10"
                                                    class="form-control form-control-solid @error('payment.note') is-invalid @enderror" 
                                                ></textarea>
                                            </div>
                                            @error('payment.note') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                </div>
                                           
                                
                                @if ($client->services->count()) 
                                    <div class="separator separator-dashed my-10"></div>
                                    <div class="my-5">
                                        <h3 class="text-dark font-weight-bold mb-10">Seleccionar servicio correspondiente al pago</h3>
                                        <div class="form-group m-0">
                                            <div class="row" wire:loading.remove wire:target="clientChange">
                                                @foreach ($client->services as $service)
                                                <div class="col-lg-6">
                                                    <label class="option">
                                                        <span class="option-control">
                                                            <span class="radio">
                                                                <input 
                                                                    wire:click="serviceChange({{ $service->id }})"
                                                                    wire:model.defer="payment.service_id"
                                                                    type="radio" 
                                                                    name="payment.service_id" 
                                                                    value="{{ $service->id }}"
                                                                />
                                                                <span></span>
                                                            </span>
                                                        </span>
                                                        <span class="option-label">
                                                            <span class="option-head">
                                                                <span class="option-title">{{ $service->serviceType->name }}</span>
                                                                <span class="option-focus">{{ $service->priceToString() }}</span>
                                                            </span>
                                                            <span class="option-body">{{ $service->note }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
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
                                @endif

                                <div class="separator separator-dashed my-10"></div>
                                <div 
                                    x-data="proofPayment()"
                                    class="my-5"
                                    >
                                    <h3 class="text-dark font-weight-bold mb-10" id="proof">Comprobante </h3>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="col-form-label">Comprobante de pago <span class="text-danger">*</span></label>
                                            <div >
                                                <select 
                                                    
                                                    wire:model.defer="payment.proof" 
                                                    x-model="proofPayment"
                                                    class="form-control form-control-solid @error('payment.proof') is-invalid @enderror" 
                                                    required
                                                >
                                                    <option value="">Ninguno</option>   
                                                    {{-- <option value="Nota simple">Nota simple</option> --}}
                                                    <option value="Voucher">Voucher</option>
                                                    <option value="Factura">Factura</option>
                                                </select>
                                            </div>
                                            @error('payment.proof') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                        </div>

                                        <div 
                                            class="col-lg-6" 
                                            x-show="isVoucher()"
                                            
                                            >
                                            <label class="col-form-label">Voucher </label>
                                            <div class="form-group row">
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
                                        </div>

                                        <div 
                                            class="col-lg-6" 
                                            x-show="isInvoice()"
                                            >
                                            <label class="col-form-label">Factura</label>
                                            <span wire:loading.class="spinner spinner-primary spinner-left" wire:target="clientChange"></span>
                                            <div>
                                                <select 
                                                    wire:model="payment.invoice_id" 
                                                    class="form-control selectpicker form-control-solid @error('payment.invoice_id') is-invalid @enderror" 
                                                    data-size="7"
                                                    data-live-search="true"
                                                    data-show-subtext="true"
                                                >
                                                    <option value="">Ninguna</option>
                                                    @foreach ($client->invoices as $invoice)
                                                        <option data-subtext="{{ $invoice->totalToString() }}" value="{{ $invoice->id }}">{{ $invoice->concept }}</option>
                                                    @endforeach
                                                </select>
                                                <a href="#" data-toggle="modal" data-target="#invoiceFormModal" class="text-primary" >Crear nueva factura</a>
                                            </div>
                                            
                                            @error('payment.invoice_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
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
                                                        wire:model.defer="userId" 
                                                        class="form-control selectpicker form-control-solid @error('userId') is-invalid @enderror" 
                                                        data-size="7"
                                                        data-live-search="true"
                                                        data-show-subtext="true"
                                                    >
                                                        <option value="">Ninguno</option>
                                                        @foreach ($users as $user)
                                                            <option data-subtext="{{ $user->position }}" value="{{ $user->id }}">{{ $user->name }}</option>
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
                        </div>
                        <button class="d-none" type="submit"></button>
                    </form>
                    <!--end::Form-->
                </div>

            </div>
            <!--end::Card-->
        </div>
        <div class="col-lg-5">
            <div class="card card-custom gutter-b">
                <div class="card-header h-auto py-4">
                    <div class="card-title">
                        <h3 class="card-label">Acuerdo de servicio</h3>
                    </div>
                    @if ($serviceAgreement)
                        @if (Storage::exists($serviceAgreement->service_agreement))
                        <div class="my-lg-0 my-1">
                            <!--start::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <a class="dropdown-item" target="_blank" href="{{ Storage::url($service->service_agreement) }}"><i class="fas fa-download mr-2"></i> Descargar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif                    
                </div>
                <div class="card-body">
                    @if ($serviceAgreement)
                        @if (Storage::exists($serviceAgreement->service_agreement))
                            <iframe  src="{{ Storage::url($serviceAgreement->service_agreement) }}" type="" width="100%" height="800px"></iframe>
                        @else
                            <span class="badge badge-secondary">Sin acuerdo de servicio</span>
                        @endif
                    @else   
                        <span class="badge badge-secondary">Seleccione un servicio del cliente para visualizar el acuerdo de algún servicio</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
        

    @push('footer')
        <script src="{{ asset('assets/plugins/custom/bfi/bfi.js') }}"></script>
        <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
        <script>


            function proofPayment(){
                return {

                    proofPayment : '{{ $payment->proof ? $payment->proof : "Ninguno" }}',

                    removeFile(functionRemove, fileId) { 
                        @this.call(functionRemove);
                        bfi_clear('#'+fileId);
                    },

                    toogleProofPayment(proofPayment){
                        this.proofPayment = proofPayment;
                        console.log(this.proofPayment);
                    },

                    isInvoice(){
                        return this.proofPayment === 'Factura';
                    },

                    isVoucher(){
                        return this.proofPayment === 'Voucher';
                    },
                }
            }


            Livewire.on('renderJs', function(){
                
                $('.selectpicker').selectpicker({
                    liveSearch: true,
                    showSubtext: true
                });

            });

            Livewire.on('render', function(){
                $('#paymentTypeFormModal').modal('hide');
                $('#invoiceFormModal').modal('hide');
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
    @endpush
        
</div>
