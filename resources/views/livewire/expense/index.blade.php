<div class="container">
    @if ($count)
         <!--begin::Advance Table Widget 3-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $expenses->total() }}) pago(s)</span>
                </h3>
                @if (isset($service))
                    <div class="card-toolbar">
                        <a 
                            href="{{ 
                                route('expense.create',[
                                    'client' => $service->client,
                                    'date' => date('Y-m-d'),
                                    'service' =>$service
                                ]) 
                            }}" 
                            class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                        >
                            <i class="fa fa-plus"></i> Nuevo gasto
                        </a>
                    </div>
                @endif
                @if (isset($client))
                    <div class="card-toolbar">
                        <a 
                            href="{{ 
                                route('expense.create',[
                                    'client' => $client,
                                    'date' => date('Y-m-d'),
                                ]) 
                            }}" 
                            class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                        >
                            <i class="fa fa-plus"></i> Nuevo gasto
                        </a>
                    </div>
                @endif
            </div>
            <!--end::Header-->
            <!--begin::Body-->
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


                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                            <tr class="text-uppercase">
                                <th>Cliente</th>
                                <th>Proveedor</th>
                                <th>Categoría</th>
                                <th>Cuenta</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Servicio</th>
                                <th>Usuario que registró el gasto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense)
                                <tr>
                                    @if ($expense->client)
                                        <td style=" padding-right: 100px; ">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50 mr-3">
                                                    <img 
                                                        alt="{{ $expense->client->name }}" 
                                                        @if ($expense->client->image)
                                                            src="{{ Storage::url($expense->client->image->url) }}" 
                                                        @else
                                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                                        @endif
                                                        >
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $expense->client->name }}</span>
                                                    <span class="text-muted font-weight-bold font-size-sm">{{ $expense->client->company }}</span>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td> 
                                            <span class="badge badge-secondary"> Ningun cliente</span>
                                        </td>   
                                    @endif
                                    @if ($expense->provider)
                                        <td style=" padding-right: 100px; ">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50 mr-3">
                                                    <img 
                                                        alt="{{ $expense->provider->name }}" 
                                                        @if ($expense->provider->image)
                                                            src="{{ Storage::url($expense->provider->image->url) }}" 
                                                        @else
                                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                                        @endif
                                                        >
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $expense->provider->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td> 
                                            <span class="badge badge-light"> Ningun proveedor</span>
                                        </td>   
                                    @endif
                                    <td>
                                        @if ($expense->categoryExpense)
                                            {{$expense->categoryExpense->name}}
                                        @else
                                            <span class="badge badge-light">Sin categoría</span>
                                        @endif
                                    </td>
                                    <td>{{ $expense->account->name }}</td>                                   
                                    <td>{{ $expense->dateToString() }}</td>
                                    <td>{{ $expense->montoToString() }}</td>
                                    <td>
                                        @if ($expense->service)
                                            {{ $expense->service->serviceType->name }}
                                        @else
                                            <span class="badge badge-light"> Ningun servicio</span>
                                        @endif
                                    </td>
                                    <td style=" padding-right: 100px; "> 
                                        @if ($expense->user)
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50 mr-3">
                                                    <img 
                                                        alt="{{ $expense->user->name }}" 
                                                        @if ($expense->user->image)
                                                            src="{{ Storage::url($expense->user->image->url) }}" 
                                                        @else
                                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                                        @endif
                                                    >
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $expense->user->name }}</span>
                                                    <span class="text-muted font-weight-bold font-size-sm">{{ $expense->user->position }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge badge-secondary">Usuario eliminado</span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left"  style="position: initial!important;">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="position: inherit;">
                                                    <!--begin::Navigation-->
                                                    <ul class="navi navi-hover py-5">
                                                        @if ($expense->invoice)
                                                            <li class="navi-item">
                                                                <a target="_blank" href="{{ Storage::url($expense->invoice->url) }}" class="navi-link">
                                                                    <span class="navi-icon">
                                                                        <i class="fas fa-download"></i>
                                                                    </span>
                                                                    <span class="navi-text">Descargar factura</span>
                                                                </a>
                                                            </li>                                                            
                                                        @endif
                                                        @if ($expense->image)
                                                            <li class="navi-item">
                                                                <a target="_blank" href="{{ Storage::url($expense->image->url) }}" class="navi-link">
                                                                    <span class="navi-icon">
                                                                        <i class="fas fa-download"></i>
                                                                    </span>
                                                                    <span class="navi-text">Descargar comprobante</span>
                                                                </a>
                                                            </li>                                                            
                                                        @endif

                                                        <li class="navi-item">
                                                            <a href="{{ route('expense.show', $expense) }}" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                                <span class="navi-text">Ver</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="{{ route('expense.edit', $expense) }}" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-pen"></i>
                                                                </span>
                                                                <span class="navi-text">Editar</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item" onclick="event.preventDefault(); confirmDestroyExpense({{ $expense->id }})">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                                <span class="navi-text">Eliminar</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!--end::Navigation-->
                                                </div>
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
                                        <div class="alert-text">Sin resultados "{{ $search }}"</div>
                                    </div>
                                </div>
                           @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->

                {{ $expenses->links() }}

            </div>
            <!--end::Body-->
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-5">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun gasto.
                    <br> Ponga en marcha su CRM añadiendo su primer gasto</p>
                    @if (isset($service))
                        <a 
                            href="{{ 
                                route('expense.create',[
                                    'client' => $service->client,
                                    'date' => date('Y-m-d'),
                                    'service' =>$service
                                ]) 
                            }}"  
                            class="btn btn-primary">Agregar un gasto
                        </a>
                    @elseif (isset($client))
                        <a 
                            href="{{ 
                                route('expense.create',[
                                    'client' => $client,
                                    'date' => date('Y-m-d'),
                                ]) 
                            }}"  
                            class="btn btn-primary">Agregar un gasto
                        </a>
                    @else
                        <a href="{{ route('expense.create') }}" class="btn btn-primary">Agregar un gasto</a>
                    @endif
                    
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
    @endif

    @push('footer')
        <script>

            function confirmDestroyExpense(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este gasto",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> Si, eliminar",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i> No, cancelar",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-dark font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                    showLoaderOnConfirm: true,
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', id);
                    }
                });
            }

        </script>
    @endpush
</div>