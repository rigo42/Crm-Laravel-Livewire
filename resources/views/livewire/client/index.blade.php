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
            @forelse ($clients as $client)
                <!--begin::Col-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                        
                        <!--begin::Body-->
                        <div class="card-body pt-4">

                            <!--start::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        @can('cotizaciones')
                                            <a class="dropdown-item" href="{{ route('quotation.create', ['client' => $client]) }}"><i class="fa fa-sticky-note mr-2"></i> Adjuntar cotización</a>
                                        @endcan
                                        @can('facturas')
                                            <a class="dropdown-item" href="{{ route('invoice.create', ['client' => $client]) }}"><i class="fas fa-file-pdf mr-2"></i> Adjuntar factura</a>
                                        @endcan
                                        {{-- @can('pagos')
                                            <a class="dropdown-item" href="{{ route('payment.create', ['client' => $client->id]) }}"><i class="fa fa-credit-card mr-2"></i> Generar un pago</a>
                                        @endcan
                                        @can('gastos')
                                            <a class="dropdown-item" href="{{ route('expense.create', ['client' => $client->id]) }}"><i class="fa fa-calculator mr-2"></i> Generar un gasto</a>
                                        @endcan --}}
                                        <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                        <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $client->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!--begin::User-->
                            <div class="d-flex align-items-end mb-7">
                                <!--begin::Pic-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Pic-->
                                    <a href="{{ route('client.show', $client) }}">
                                        <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                            <div class="symbol symbol-circle symbol-lg-75">
                                                <img 
                                                    @if ($client->image)
                                                        src="{{ Storage::url($client->image->url) }}" 
                                                    @else
                                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                                    @endif
                                                    
                                                    alt="{{ $client->name }}" 
                                                />
                                            </div>
                                        </div>
                                    </a>
                                    <!--end::Pic-->
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('client.show', $client) }}" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{ $client->name }}</a>
                                        <span class="text-muted font-weight-bold">{{ $client->company }}</span>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::User-->
                            <!--begin::Info-->
                            <div class="mb-7">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Categoría:</span>
                                    @if ($client->categoryClient)
                                        <span class="badge badge-primary font-weight-bold">{{ $client->categoryClient->name }}</span>
                                    @else
                                        <span class="badge badge-secondary font-weight-bold">Ninguno</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-3">
                                    <div class="">
                                        <span class="text-dark-75 font-weight-bolder mr-2">Estrellas:</span>
                                    </div>
                                    
                                    <div class="">
                                        {!! $client->starsToHtml() !!}
                                    </div>
                                    
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Correo:</span>
                                    <a href="mailto:{{ $client->email }}" class="text-muted text-hover-primary">{{ $client->email }}</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-cente my-1">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Teléfono:</span>
                                    <a href="tel:{{ $client->phone }}" class="text-muted text-hover-primary">{{ $client->phone }}</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Origen:</span>
                                    <span class="text-muted font-weight-bold">{{ $client->origin }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Pertenece a:</span>
                                    <span class="text-muted font-weight-bold">
                                        @if ($client->user)
                                            <span class="badge badge-success">{{ $client->user->name }}</span>
                                        @else 
                                            <span class="badge badge-secondary">Ninguno usuario</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center flex-wrap mb-4">
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1 text-dark">
                                    <span class="mr-4">
                                        <i class="flaticon-price-tag icon-2x font-weight-bold text-dark"></i>
                                    </span>
                                    <div class="d-flex flex-column ">
                                        <span class="font-weight-bolder font-size-sm ">Ingreso bruto</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="font-weight-bold ">{{ $client->grossIncomeTotal() }}</span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1 text-danger">
                                    <span class="mr-4">
                                        <i class="flaticon-price-tag icon-2x font-weight-bold text-danger"></i>
                                    </span>
                                    <div class="d-flex flex-column ">
                                        <span class="font-weight-bolder font-size-sm ">Pendiente por factura</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="font-weight-bold ">{{ $client->pendingByInvoiceTotal() }}</span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1 text-success">
                                    <span class="mr-4">
                                        <i class="flaticon-piggy-bank icon-2x  font-weight-bold  text-success"></i>
                                    </span>
                                    <div class="d-flex flex-column ">
                                        <span class="font-weight-bolder font-size-sm ">Ingreso</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="font-weight-bold ">{{ $client->paymentTotal() }}</span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1 text-danger">
                                    <span class="mr-4">
                                        <i class="flaticon-confetti icon-2x font-weight-bold text-danger"></i>
                                    </span>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bolder font-size-sm">Gasto</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="font-weight-bold">{{ $client->expenseTotal() }}</span>
                                    </div>
                                </div>
                                <!--end: Item-->
                            </div>
                        </div>
                        <!--end::Body-->
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

        {{ $clients->links() }}

    @else

        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun cliente.
                    <br> Ponga en marcha su CRM añadiendo su primer cliente</p>
                    <a href="{{ route('client.create') }}" class="btn btn-primary">Agregar cliente</a>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/clients.png') }}">
                </div>
            </div>
        </div>
        
    @endif

    @section('footer')
        <script>
            function confirmDestroy(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este cliente y todas las facturas, estimaciones y pagos relacionados.",
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
