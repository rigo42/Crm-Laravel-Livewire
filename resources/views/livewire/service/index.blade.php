<div class="container">

    @if ($count)
            
        <!--Filters-->
        <div class="card card-custom gutter-b">

            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $services->total() }}) pago(s)</span>
                </h3>
                <div class="card-toolbar">
                    @if ($type == 'Proyecto')
                        @if (isset($client))
                            <a 
                                href="{{ 
                                    route('project.create',[
                                        'client' => $client,
                                        'date' => date('Y-m-d'),
                                    ]) 
                                }}" 
                                class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                            >
                                <i class="fa fa-plus"></i> Nuevo proyecto
                            </a>
                        @endif
                    @else
                        @if (isset($client))
                            <a 
                                href="{{ 
                                    route('service.create',[
                                        'client' => $client,
                                        'date' => date('Y-m-d'),
                                    ]) 
                                }}" 
                                class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                            >
                                <i class="fa fa-plus"></i> Nuevo servicio
                            </a>
                        @endif
                    @endif                    
                </div>
            </div>
            <!--end::Header-->

            <div class="card-body pt-0 pb-3">
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
                                            placeholder="Buscar...">
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

            <div class="col-12 col-xl-6">
                <!--begin::Card-->
                <div class="card gutter-b card-stretch">
                    <div class="card-body ribbon ribbon-top">
                        @if ($service->finished)
                            <div class="ribbon-target bg-danger" style="top: -2px; right: 20px;">Finalizado</div>
                        @endif 
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-4 symbol symbol-60 symbol-circle">
                                <img 
                                    @if ($service->client->image)
                                        src="{{ Storage::url($service->client->image->url) }}" 
                                    @else
                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                    @endif
                                    alt="image" 
                                />
                            </div>
                            <!--end::Pic-->
                            <div class="d-flex flex-column mr-auto">
                                <!--begin: Title-->
                                @if ($service->type == 'Proyecto')
                                    <a href="{{ route('project.show', $service) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $service->categoryService->name }}  ({{ $service->priceToString() }})</a>
                                @else
                                    <a href="{{ route('service.show', $service) }}" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $service->categoryService->name }}  ({{ $service->priceToString() }})</a>
                                @endif
                                
                                <span class="text-primary font-weight-bold">{{ $service->client->name }}</span>
                                
                                @if ($service->categoryService)
                                    <span class="text-secondary" style="font-size: 10px;">{{ $service->categoryService->name }}</span>
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
                                        <a  href="{{ route('payment.create',[ 'client' => $service->client, 'date' => date('Y-m-d'), 'service' => $service]) }}" class="dropdown-item mr-2 ">
                                            <i class="fa fa-credit-card mr-2"></i> Generar pago
                                        </a>
                                        <a  href="{{ route('expense.create',[ 'client' => $service->client, 'date' => date('Y-m-d'), 'service' => $service]) }}" class="dropdown-item mr-2 ">
                                            <i class="fa fa-calculator mr-2"></i> Generar gasto
                                        </a>
                                        <a  href="{{ route('invoice.create',[ 'client' => $service->client, 'date' => date('Y-m-d'), 'service' => $service ]) }}" class="dropdown-item mr-2 ">
                                            <i class="fas fa-file-pdf mr-2"></i> Adjuntar factura
                                        </a>
                                        @if ($service->type == 'Proyecto')
                                            <a class="dropdown-item" href="{{ route('project.show', $service) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                            <a class="dropdown-item" href="{{ route('project.edit', $service) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('service.show', $service) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                            <a class="dropdown-item" href="{{ route('service.edit', $service) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        @endif
                                        
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroyService({{ $service->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Info-->
                        <div class="d-flex flex-wrap mt-14">
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Inicio</span>
                                <span class="btn btn-light-success btn-sm font-weight-bold btn-text">{{ $service->startDateToString() }}</span>
                            </div>
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="d-block font-weight-bold mb-4">Vencimiento</span>
                                <span class="btn btn-light-danger btn-sm font-weight-bold btn-text">{{ $service->dueDateToString() }}</span>
                            </div>
                            @if ($service->type == 'Proyecto')
                                <!--begin::Progress-->
                                <div class="flex-row-fluid mb-7">
                                    <span class="d-block font-weight-bold mb-4">Progreso</span>
                                    <div class="d-flex align-items-center pt-2">
                                        <div class="progress progress-xs mt-2 mb-2 w-100">
                                            @if ($service->progressByProject() >= 60)
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            @elseif($service->progressByProject() >= 30)
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            @else
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            @endif
                                        </div>
                                        <span class="ml-3 font-weight-bolder">{{ $service->progressByProject() }}%</span>
                                    </div>
                                </div>
                                <!--end::Progress-->
                            @endif
                        </div>

                        <!--begin::Description-->
                        <div class="mb-10 mt-5 ">{{ $service->note }}</div>
                        <!--end::Description-->

                        <!--end::Body-->
                        <div class="d-flex flex-wrap">
                            <!--begin: Item-->
                            <div class="mr-12 d-flex flex-column mb-7 text-dark">
                                <span class="font-weight-bolder mb-4">Ingresos por factura</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
                                <span class="font-weight-bold">{{ $service->incomeByInvoiceTotal() }}</span>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mr-12 d-flex flex-column mb-7 text-success">
                                <span class="font-weight-bolder mb-4">Pagos</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
                                <span class="font-weight-bold">{{ $service->paymentTotal() }}</span>
                            </div>
                             <!--begin::Item-->
                             <div class="mr-12 d-flex flex-column mb-7 text-danger">
                                <span class="font-weight-bolder mb-4">Gastos</span>
                                <span class="font-weight-bolder font-size-h5 pt-1">
                                <span class="font-weight-bold">{{ $service->expenseTotal() }}</span>
                            </div>
                            <!--end::Item-->
                            <div class="mr-12 d-flex flex-column mb-7">
                                <span class="font-weight-bolder mb-4">Colaboradores</span>
                                <!--begin::Item-->
                                @if ($service->users->count())
                                <!--begin::Item-->
                                    <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                        <div class="symbol-group symbol-hover">
                                            @foreach ($service->users as $user)
                                                <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="{{ $user->name }}">
                                                    <img 
                                                        alt="{{ $user->name }}" 
                                                        @if ($user->image)
                                                            src="{{ Storage::url($user->image->url) }}" 
                                                        @else
                                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                                        @endif
                                                        >
                                                </div>
                                                @if ($loop->index == (8))
                                                    <div class="symbol symbol-30 symbol-circle symbol-light">
                                                        <span class="symbol-label font-weight-bold">{{ $service->users->count() - ($loop->index + 1) }}+</span>
                                                    </div>
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>                                        
                                @else 
                                    <span class="font-size-lg m-1 badge badge-secondary">Ninguno usuario</span>
                                @endif
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--begin::Footer-->
                        
                    </div>

                    <div class="card-footer d-flex align-items-center">
                        <div class="d-flex">
                            {{-- <div class="d-flex align-items-center mr-7">
                                <span class="font-weight-bolder text-success ml-2"></span>
                            </div> --}}
                            @if ($service->has_invoice && !$service->invoices->count())
                            <div class="d-flex align-items-center mr-7">
                                <span class="badge badge-info ml-2">Se require factura</span>
                            </div>
                            @endif
                        </div>
                        @if ($service->client->user)
                            <div class="d-flex align-items-center mt-5 mt-sm-0  mr-sm-0 ml-sm-auto"">
                                <div class="symbol symbol-circle symbol-50 mr-3">
                                    <img 
                                        alt="{{ $service->client->user->name }}" 
                                        @if ($service->client->user->image)
                                            src="{{ Storage::url($service->client->user->image->url) }}" 
                                        @else
                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                        @endif
                                        >
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $service->client->user->name }}</span>
                                    <span class="text-muted font-weight-bold font-size-sm">{{ $service->client->user->position }}</span>
                                </div>
                            </div>
                        @else    
                            <span class="badge badge-secondary">Usuario asignado eliminado</span>
                        @endif
                        
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end:: Card-->
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

    @if ($type == 'Proyecto')
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun proyecto.
                    <br> Ponga en marcha su CRM añadiendo su primer proyecto</p>
                    @if (isset($client))
                        <a 
                            href="{{ 
                                route('project.create',[
                                    'client' => $client,
                                    'date' => date('Y-m-d'),
                                ]) 
                            }}"  
                            class="btn btn-primary">Agregar proyecto
                        </a>
                    @else
                        <a href="{{ route('project.create') }}" class="btn btn-primary">Agregar proyecto</a>
                    @endif
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun servicio.
                    <br> Ponga en marcha su CRM añadiendo su primer servicio</p>
                    @if (isset($client))
                        <a 
                            href="{{ 
                                route('service.create',[
                                    'client' => $client,
                                    'date' => date('Y-m-d'),
                                ]) 
                            }}"  
                            class="btn btn-primary">Agregar servicio
                        </a>
                    @else
                        <a href="{{ route('service.create') }}" class="btn btn-primary">Agregar servicio</a>
                    @endif
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
    @endif
        
        
    @endif

    @push('footer')
    
        <script>
            function confirmDestroyService(id){
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
    @endpush
</div>
