<div class="container">
    @if ($count)
         <!--begin::Advance Table Widget 3-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $payments->total() }}) pago(s)</span>
                </h3>
                @if (isset($service))
                    <div class="card-toolbar">
                        <a 
                            href="{{ 
                                route('payment.create',[
                                    'client' => $service->client,
                                    'date' => date('Y-m-d'),
                                    'cutoffDate' => $service->due(),
                                    'service' =>$service
                                ]) 
                            }}" 
                            class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                        >
                            <i class="fa fa-plus"></i> Nuevo pago
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
                                <th>Tipo</th>
                                <th>Cuenta</th>
                                <th>Fecha</th>
                                <th>Corte</th>
                                <th>Monto</th>
                                <th>Servicio</th>
                                <th>Comprobante</th>
                                <th>status</th>
                                <th>Correo de confirmación</th>
                                <th>Usuario que lo registró</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr >
                                    <td style=" padding-right: 100px; ">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50 mr-3">
                                                <img 
                                                    alt="{{ $payment->client->name }}" 
                                                    @if ($payment->client->image)
                                                        src="{{ Storage::url($payment->client->image->url) }}" 
                                                    @else
                                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                                    @endif
                                                    >
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $payment->client->name }}</span>
                                                <span class="text-muted font-weight-bold font-size-sm">{{ $payment->client->company }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$payment->paymentType->name}}</td>
                                    <td>{{ $payment->account->name }}</td>
                                    <td>{{ $payment->dateToString() }}</td>
                                    <td>{{ $payment->cutoffDateToString() }}</td>
                                    <td>{{ $payment->montoToString() }}</td>
                                    <td>{{ $payment->service->serviceType->name }} ({{ $payment->service->priceToString() }})</td>
                                    <td>
                                        @if ($payment->proof)
                                            <span class="badge badge-success">{{ $payment->proof }}</span>
                                        @else
                                            <span class="badge badge-pill badge-light">Ninguno</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->proof == 'Factura')
                                            @if ($payment->invoice)
                                                <span class="badge badge-success">Factura adjuntada</span>
                                            @else 
                                                <span class="badge badge-info">Falta factura</span>
                                            @endif

                                        @elseif($payment->proof == 'Voucher') 
                                            @if ($payment->image)
                                                <span class="badge badge-success">Voucher adjuntado</span>
                                            @else 
                                                <span class="badge badge-info">Falta voucher</span>
                                            @endif

                                        @else
                                            <span class="badge badge-secondary">Ninguno</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->send_email)
                                            <span class="badge badge-success">Correo enviado</span>
                                        @else
                                            <span class="badge badge-secondary">No enviado</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->user)
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50 mr-3">
                                                    <img 
                                                        alt="{{ $payment->user->name }}" 
                                                        @if ($payment->user->image)
                                                            src="{{ Storage::url($payment->user->image->url) }}" 
                                                        @else
                                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                                        @endif
                                                    >
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark-75 font-weight-bold font-size-lg">{{ $payment->user->name }}</span>
                                                    <span class="text-muted font-weight-bold font-size-sm">{{ $payment->user->position }}</span>
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
                                                        @if ($payment->invoice)
                                                            <li class="navi-item">
                                                                <a target="_blank" href="{{ Storage::url($payment->invoice->url) }}" class="navi-link">
                                                                    <span class="navi-icon">
                                                                        <i class="fas fa-download"></i>
                                                                    </span>
                                                                    <span class="navi-text">Descargar factura</span>
                                                                </a>
                                                            </li>                                                            
                                                        @endif
                                                        @if ($payment->image)
                                                            <li class="navi-item">
                                                                <a target="_blank" href="{{ Storage::url($payment->image->url) }}" class="navi-link">
                                                                    <span class="navi-icon">
                                                                        <i class="fas fa-download"></i>
                                                                    </span>
                                                                    <span class="navi-text">Descargar comprobante</span>
                                                                </a>
                                                            </li>                                                            
                                                        @endif

                                                        @livewire('payment.send-email', ['payment' => $payment], key($payment->id))

                                                        <li class="navi-item">
                                                            <a href="{{ route('payment.show', $payment) }}" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-eye"></i>
                                                                </span>
                                                                <span class="navi-text">Ver</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="{{ route('payment.edit', $payment) }}" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-pen"></i>
                                                                </span>
                                                                <span class="navi-text">Editar</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item" onclick="event.preventDefault(); confirmDestroyPayment({{ $payment->id }})">
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

                {{ $payments->links() }}

            </div>
            <!--end::Body-->
        </div>
    @else
        @if (isset($service))
            <div class="card">
                <div class="card-body">
                    <div class="card-px text-center py-5">
                        <h2 class="fs-2x fw-bolder mb-10">Hola! </h2>
                        <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun pago.
                        <br> Ponga en marcha su CRM añadiendo su primer pago</p>
                        
                            <a 
                                href="{{ 
                                    route('payment.create',[
                                        'client' => $service->client,
                                        'date' => date('Y-m-d'),
                                        'cutoffDate' => $service->due(),
                                        'service' =>$service
                                    ]) 
                                }}"  
                                class="btn btn-primary">Agregar un pago
                            </a>
                        
                    </div>
                    <div class="text-center px-4 ">
                        <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                    </div>
                </div>
            </div>
        @endif
        @if (isset($client))
            <div class="card">
                <div class="card-body">
                    <div class="card-px text-center py-5">
                        <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                        <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun pago.
                        <br> Registra un pago a traves de un servicio</p>
                        
                    </div>
                </div>
            </div>
        @endif
    @endif

    @push('footer')
        <script>

            function confirmDestroyPayment(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este pago",
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