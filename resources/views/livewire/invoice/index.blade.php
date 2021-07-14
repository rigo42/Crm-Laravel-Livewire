<div class="container" >
    @if ($count)
            
        <!--Filters-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $invoices->total() }}) Facturas(s)</span>
                </h3>
                @if (isset($service))
                    <div class="card-toolbar">
                        <a 
                            href="{{ 
                                route('invoice.create',[
                                    'client' => $service->client,
                                    'date' => date('Y-m-d'),
                                    'service_id' =>$service->id
                                ]) 
                            }}" 
                            class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                        >
                            <i class="fa fa-plus"></i> Nueva factura
                        </a>
                    </div>
                @elseif (isset($client))
                    <div class="card-toolbar">
                        <a 
                            href="{{ 
                                route('invoice.create',[
                                    'client' => $client,
                                    'date' => date('Y-m-d'),
                                ]) 
                            }}" 
                            class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                        >
                            <i class="fa fa-plus"></i> Nueva factura
                        </a>
                    </div>
                @endif
            </div>
            <!--end::Header-->
            <div class="card-body  pt-0 pb-3">
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
                                            placeholder="Buscar concepto, cliente ...">
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
            @forelse ($invoices as $invoice)
                <!--begin::Col-->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                        <div class="card-header border-0">
                            <h3 class="card-title"></h3>
                            <div class="card-toolbar">
                                <!--start::Toolbar-->
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('invoice.show', $invoice) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                            <a class="dropdown-item" href="{{ route('invoice.edit', $invoice) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroyInvoice({{ $invoice->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                <!--begin: Icon-->
                                <img alt="{{ $invoice->concept }}" class="max-h-65px" src="{{ asset('assets') }}/media/svg/files/pdf.svg">
                                <!--begin: Tite-->
                                <p class="text-dark-75 font-weight-bold my-4 font-size-lg">{{ $invoice->concept }}</p>
                                <p>{{ $invoice->totalToString() }}</p>
                                @if ($invoice->isPendingTotal())
                                    <span class="badge badge-danger">Pendiente: {{ $invoice->pendingTotalToString() }}</span>
                                @endif
                                <div class="symbol symbol-circle symbol-lg-75 my-4">
                                    <img 
                                        @if ($invoice->client->image)
                                            src="{{ Storage::url($invoice->client->image->url) }}" 
                                        @else
                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                        @endif
                                        
                                        alt="{{ $invoice->client->name }}" 
                                    />
                                </div>
                                <a class="text-dark-75 font-weight-bold mt-1 font-size-lg">{{ $invoice->client->name }}</a>
                                <!--end: Tite-->
                            </div>
                        </div>
                    </div>
                    <!--end:: Card-->
                </div>
                <!--end::Col-->
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

        {{ $invoices->links() }}

    @else

        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-5">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ninguna factura.
                    <br> Ponga en marcha su CRM añadiendo su primera factura</p>
                    @if (isset($service))
                        <a 
                            href="{{ 
                                route('invoice.create',[
                                    'client' => $service->client,
                                    'date' => date('Y-m-d'),
                                    'service_id' =>$service->id
                                ]) 
                            }}"  
                            class="btn btn-primary">Agregar factura
                        </a>
                    @elseif(isset($client))
                        <a 
                            href="{{ 
                                route('invoice.create',[
                                    'client' => $client,
                                    'date' => date('Y-m-d'),
                                ]) 
                            }}"  
                            class="btn btn-primary">Agregar factura
                        </a>
                    @else
                        <a href="{{ route('invoice.create') }}" class="btn btn-primary">Agregar factura</a>
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
            function confirmDestroyInvoice(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrás recuperar esta factura",
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
        </script>
    @endpush
</div>
