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

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" data-backdrop="static" id="serviceTypeFormModal" tabindex="-1" aria-labelledby="serviceTypeFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="serviceTypeFormModalLabel">Nuevo tipo de servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @livewire('service-type.form', ['method' => 'storeCustom'])
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
                                    <div >
                                        <select 
                                            wire:model="service.client_id" 
                                            class="form-control selectpicker form-control-solid @error('service.client_id') is-invalid @enderror" 
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
                                    <a href="#"  data-toggle="modal" data-target="#clientFormModal" class="text-primary" >Crear nuevo cliente</a>
                                    @error('service.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Tipo de servicio <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div>
                                        <select 
                                            wire:model.defer="service.service_type_id" 
                                            class="form-control selectpicker form-control-solid @error('service.service_type_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona un tipo</option>
                                            @foreach ($serviceTypes as $serviceType)
                                                <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#serviceTypeFormModal" class="text-primary" >Crear nuevo tipo de servicio</a>
                                    @error('service.service_type_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
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
                                            wire:model.defer="service.start_date"
                                            value="{{ $service->start_date }}"
                                            type="text" 
                                            class="start_date form-control form-control-solid @error('service.start_date') is-invalid @enderror"  
                                            placeholder="Seleccione la fecha de inicio"
                                            />
                                    </div>
                                    @error('service.start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" x-show="type == 'Mensual'">
                                <label class="col-3">Día de corte <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="service.due_day" 
                                            type="number" 
                                            class="form-control form-control-solid @error('service.due_day') is-invalid @enderror" 
                                            placeholder="Día del mes donde se deberá hacer corte de este servicio: Ej: 25" />
                                    </div>
                                    @error('service.due_day') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" x-show="type == 'Proyecto'">
                                <label class="col-3">Fecha de finalización <span class="text-danger">*</span></label>
                                <div class="col-9" wire:ignore wire:key="due_date">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                        <input
                                            wire:model.defer="service.due_date"
                                            value="{{ $service->due_date }}"
                                            type="text" 
                                            class="due_date form-control form-control-solid @error('service.due_date') is-invalid @enderror"  
                                            readonly="readonly" 
                                            placeholder="Seleccione la fecha de finalizacion del proyecto"
                                            />
                                    </div>
                                    @error('service.due_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Precio <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model.defer="service.price" 
                                            type="number" 
                                            required
                                            class="form-control form-control-solid @error('service.price') is-invalid @enderror" 
                                            placeholder="Ej: 8000" />
                                    </div>
                                    @error('service.price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-3">Acuerdo de servicio <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    
                                    <div class="d-flex jutify-content-start mb-3" >
                                        @if ($serviceAgreementTmp || $service->service_agreement)
                                            <img 
                                                width="65" 
                                                src="{{ asset('assets') }}/media/svg/files/pdf.svg" alt=""
                                                >
                                            <span 
                                                x-on:click="removeFile('removeServiceAgreement', 'serviceAgreementTmp')"
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow image-remove" 
                                                style="position: inherit;"
                                                title="Remover cotización">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                <span 
                                                    wire:loading.class="spinner spinner-primary spinner-sm"
                                                    wire:target="removeServiceAgreement"
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
                                        <div wire:ignore wire:key="serviceAgreementTmp">
                                            <input 
                                                wire:model.defer="serviceAgreementTmp" 
                                                class="bfi form-control form-control-solid @error('serviceAgreementTmp') is-invalid @enderror" 
                                                type="file" 
                                                accept=".pdf"
                                                id="serviceAgreementTmp"
                                                required
                                            />
                                        </div>
                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                    
                                    
                                    @error('serviceAgreementTmp') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Nota </label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <textarea 
                                            wire:model.defer="service.note"
                                            id="" 
                                            cols="30" 
                                            rows="10"
                                            class="form-control form-control-solid @error('service.note') is-invalid @enderror" 
                                            placeholder="Ej: Alguna nota a resaltar" 
                                            >
                                        </textarea>
                                    </div>
                                    @error('service.note') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="my-5">
                                <div class="separator separator-dashed my-10"></div>

                                <h3 class="text-dark font-weight-bold mb-5">Status</h3>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">¿Finalizado?</label>
                                    <div class="col-3">
                                        <span class="switch switch-outline switch-icon switch-primary">
                                            <label>
                                                <input 
                                                    wire:model.defer="service.finished"
                                                    class="@error('service.finished') is-invalid @enderror"
                                                    type="checkbox" />
                                                <span></span>
                                            </label>
                                        </span>
                                        @error('service.finished') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="my-5" >
                                <div class="separator separator-dashed my-10"></div>

                                <h3 class="text-dark font-weight-bold mb-5" id="users">Colaboradores</h3>

                                <div class="row align-items-center">
                                    <div class="col-md-12 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input 
                                                wire:model="searchUser"
                                                type="search" 
                                                class="form-control"
                                                placeholder="Buscar usuario...">
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive pt-5">
                                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th class="">Selección</th>
                                                <th>Usuario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>
                                                        <label class="checkbox checkbox-lg checkbox-single">
															<input 
                                                                wire:model.defer="userArray" 
                                                                class="checkbox" 
                                                                type="checkbox" 
                                                                name="userArray[]"
                                                                value="{{ $user->id }}" 
                                                                />
															<span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-circle symbol-50 mr-3">
                                                                <img 
                                                                    alt="{{ $user->name }}" 
                                                                    @if ($user->image)
                                                                        src="{{ Storage::url($user->image->url) }}" 
                                                                    @else
                                                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                                                    @endif
                                                                    >
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <span class="text-dark-75 font-weight-bold font-size-lg">{{ $user->name }}</span>
                                                                <span class="text-muted font-weight-bold font-size-sm">{{ $user->company }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
            
                                            @empty 
                                                <!--begin::Col-->
                                                <div class="col-12">
                                                    <div class="alert alert-custom alert-notice alert-light-dark fade show mb-5" role="alert">
                                                        <div class="alert-icon">
                                                            <i class="flaticon-questions-circular-button"></i>
                                                        </div>
                                                        <div class="alert-text">Sin resultados "{{ $searchUser }}"</div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @error('userArray') 
                                    <div><span class="text-danger">{{ $message }}</span></div>
                                @enderror
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

    @push('footer')
        <script src="{{ asset('assets/plugins/custom/bfi/bfi.js') }}"></script>
        {{-- <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script> --}}
        <script>

            function app() {
                return {

                    type : '{{ $service->type }}',

                    removeFile(functionRemove, fileId) { 
                        @this.call(functionRemove);
                        bfi_clear('#'+fileId);
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
                $("#clientFormModal").modal('hide');
                $("#serviceTypeFormModal").modal('hide');
            });

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
                @this.set('service.start_date', e.target.value);
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
                @this.set('service.due_date', e.target.value);
            });
        </script>
    @endpush
        
</div>
