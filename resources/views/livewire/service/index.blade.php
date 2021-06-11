<div class="container">

    @if ($count)
            
        <!--Filters-->
        <div class="card mb-7">
            <div class="card-body">
                <div class="mb-5 ">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input 
                                            wire:model="search"
                                            type="search" 
                                            class="form-control"
                                            placeholder="Buscar servicio, servicee...">
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Mostrar:</label>
                                        <select class="form-control" wire:model="perPage">
                                            <option value="10">10 Entradas</option>
                                            <option value="20">20 Entradas</option>
                                            <option value="50">50 Entradas</option>
                                            <option value="100">100 Entradas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--begin::Row-->
        <div class="row">
            @forelse ($services as $service)
            <div class="col-xl-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                                <img 
                                    @if ($service->client->image)
                                        src="{{ Storage::url($service->client->image->url) }}" 
                                    @else
                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                    @endif
                                    alt="image" />
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column mr-auto">
                                
                                <!--begin: Title-->
                                <a href="#" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $service->client->name }}</a>
                                <span class="text-muted font-weight-bold">{{ $service->name }}</span>
                                @if ($service->categoryService)
                                    <span class="text-primary font-weight-bold">{{ $service->categoryService->name }}</span>
                                @else
                                    <span class="text-secondary font-weight-bold">Ninguno</span>
                                @endif
                            </div>
                            
                            <!--start::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('service.show', $service) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                        <a class="dropdown-item" href="{{ route('service.edit', $service) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $service->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Section-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap mt-14">
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Fecha de inicio</span>
                                <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ $service->startDateFormat() }}</span>
                            </div>
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Fecha de vencimiento</span>
                                <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{ $service->dueDay() }}</span>
                            </div>
                            <!--begin::Progress-->
                            <div class="flex-row-fluid mb-7">
                                <span class="d-block font-weight-bold mb-4">Progress</span>
                                <div class="d-flex align-items-center pt-2">
                                    <div class="progress progress-xs mt-2 mb-2 w-100">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="ml-3 font-weight-bolder">78%</span>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Text-->
                        <p class="mb-7 mt-3">I distinguish three main text objectives.First, your objective could be merely to inform people.A second be to persuade people.</p>
                        
                        
                        <!--end::Text-->
                        <!--begin::Blog-->
                        <div class="d-flex flex-wrap">
                            <!--begin: Item-->
                            <div class="mr-12 d-flex flex-column mb-7 text-success">
                                <span class="font-weight-bolder mb-4">Pagos</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
                                <span class="font-weight-bold">$</span>249,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mr-12 d-flex flex-column mb-7 text-danger">
                                <span class="font-weight-bolder mb-4">Gastos</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
                                <span class="font-weight-bold">$</span>439,500</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                <span class="font-weight-bolder mb-4">Members</span>
                                <div class="symbol-group symbol-hover">
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Mark Stone">
                                        <img alt="Pic" src="{{ asset('assets') }}/media/users/300_25.jpg" />
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Charlie Stone">
                                        <img alt="Pic" src="{{ asset('assets') }}/media/users/300_19.jpg" />
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Luca Doncic">
                                        <img alt="Pic" src="{{ asset('assets') }}/media/users/300_22.jpg" />
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Nick Mana">
                                        <img alt="Pic" src="{{ asset('assets') }}/media/users/300_23.jpg" />
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Teresa Fox">
                                        <img alt="Pic" src="{{ asset('assets') }}/media/users/300_18.jpg" />
                                    </div>
                                    <div class="symbol symbol-30 symbol-circle symbol-light">
                                        <span class="symbol-label font-weight-bold">5+</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Blog-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer d-flex align-items-center">
                        <div class="d-flex">
                            <div class="d-flex align-items-center mr-7">
                                <span class="svg-icon svg-icon-gray-500">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                                <a href="#" class="font-weight-bolder text-secondary ml-2">Precio de servicio: $9,000.00</a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex align-items-center mr-7">
                                <a href="#" class="font-weight-bolder text-secondary ml-2">Antiguedad: {{ $service->longDayService() }}</a>
                            </div>
                        </div>
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
            @empty 
             <!--begin::Col-->
             <div class="col-12">
                <div class="alert alert-custom alert-notice alert-light-dark fade show mb-5" role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-questions-circular-button"></i>
                    </div>
                    <div class="alert-text">Sin resultados "{{ $search }}"</div>
                </div>
             </div>
            @endforelse
        </div>
        <!--end::Row-->

        {{ $services->links() }}

    @else

        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun servicio.
                    <br> Ponga en marcha su CRM añadiendo su primer servicio</p>
                    <a href="{{ route('service.create') }}" class="btn btn-primary">Agregar servicio</a>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
        
    @endif

    @section('footer')
        <script>
            function confirmDestroy(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este servicio y todas las facturas relacionadas, pagos y gastos.",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> <span class='font-weight-bold'>Si, eliminar</span>",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i>  <span class='text-dark font-weight-bold'>No, cancelar",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-secondary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', id);
                    }
                });
            }
        </Script>
    @endsection
</div>
