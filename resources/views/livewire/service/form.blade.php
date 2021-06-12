<div class="container" x-data="{ type : '{{ $service->type }}'}">
  
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
            <form class="form" wire:submit.prevent="{{ $method }}">
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <h3 class="text-dark font-weight-bold mb-10">Información general</h3>

                            @include('component.error-list')

                            <div class="form-group row">
                                <label class="col-3">Tipo de servicio <span x-ref="type"></span> <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <select 
                                        x-on:change="type = $event.target.value"
                                        wire:model.defer="service.type" 
                                        class="form-control @error('service.type') is-invalid @enderror" 
                                        required>
                                        <option value="">Selecciona un tipo</option>
                                        <option value="Proyecto">Proyecto</option>
                                        <option value="Mensual">Servicio mensual</option>
                                    </select>
                                    <span class="form-text text-muted">Elije el tipo de servicio</span>
                                    @error('service.type') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Fecha de inicio <span class="text-danger">*</span></label>
                                <div class="col-9">
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
                                            class="start_date form-control form-control-solid @error('service.due_day') is-invalid @enderror" 
                                            placeholder="Día del mes donde se deberá hacer corte de este servicio: Ej: 25" />
                                    </div>
                                    @error('service.due_day') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row" x-show="type == 'Proyecto'">
                                <label class="col-3">Fecha de finalización <span class="text-danger">*</span></label>
                                <div class="col-9">
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
                                <label class="col-3">Cliente <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div >
                                        <select 
                                            wire:model.defer="service.client_id" 
                                            class="form-control selectpicker form-control-solid @error('service.client_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona un cliente</option>
                                            @foreach ($clients as $client)
                                                <option data-subtext="{{ $client->company }}" value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije el cliente correspondiente al servicio</span>
                                    <a href="#"  data-toggle="modal" data-target="#clientFormModal" class="text-primary" >Crear nuevo cliente</a>
                                    @error('service.client_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Categoría<span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div wire:ignore wire:key="category_service_id">
                                        <select 
                                            wire:model.defer="service.category_service_id" 
                                            class="form-control selectpicker form-control-solid @error('service.category_service_id') is-invalid @enderror" 
                                            data-size="7"
                                            data-live-search="true"
                                            required>
                                            <option value="">Selecciona una categoría</option>
                                            @foreach ($categoryServices as $categoryService)
                                                <option value="{{ $categoryService->id }}">{{ $categoryService->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Elije la categoría correspondiente de acuerdo al servicio</span>
                                    <a href="{{ route('setting.category-service.index') }}" class="text-primary" >Crear nueva categoría</a>
                                    @error('service.category_service_id') <div><span class="text-danger">{{ $message }}</span></div> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3">Nombre del servicio <span class="text-danger">*</span></label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-star"></i>
                                            </span>
                                        </div>
                                        <input 
                                            wire:model="service.name" 
                                            type="text" 
                                            required
                                            class="form-control form-control-solid @error('service.name') is-invalid @enderror"  
                                            placeholder="Ej: Gestión de facebook ads" />
                                    </div>
                                    @error('service.name') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <label class="col-3">Nota </label>
                                <div class="col-9">
                                    <div class="input-group input-group-solid">
                                        <textarea 
                                            wire:model.defer="service.note"
                                            id="" 
                                            cols="30" 
                                            rows="10"
                                            class="form-control form-control-solid @error('service.note') is-invalid @enderror" 
                                            placeholder="Ej: Alguna nota a resaltar para este servicio" 
                                            >
                                        </textarea>
                                    </div>
                                    @error('service.note') <span class="text-danger">{{ $message }}</span> @enderror
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
        <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
        <script>

            Livewire.on('renderJs', function(){
                $('.selectpicker').selectpicker({
                    liveSearch: true
                });
            });

            Livewire.on('render', function(){
                $("#clientFormModal").modal('hide');
            });

            // Init date
            $('.start_date').datepicker({
                format: "yyyy/mm/dd",
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                autoclose: true,
                language: 'es',
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
            }).on('changeDate', function(e){
                @this.set('service.due_date', e.target.value);
            });
        </script>
    @endsection
        
</div>
