
<div wire:ignore.self class="dropdown" id="kt_quick_search_toggle">
    <!--begin::Toggle-->
    <div wire:ignore.self class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
        <div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
            <i class="fa fa-search"></i>
        </div>
    </div> 
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div wire:ignore.self class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
        <div wire:ignore.self class="quick-search quick-search-dropdown">
            <!--begin:Form-->
            <form method="get" class="quick-search-form">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="svg-icon svg-icon-lg">
                                <i class="fa fa-search"></i>
                            </span>
                        </span>
                    </div>
                    <input 
                        wire:model="search"
                        type="search" 
                        class="form-control" 
                        placeholder="Buscar..." 
                    />
                    <div class="input-group-append">
                        <span wire:loading wire:target="search" class="input-group-text spinner">
                        </span>
                    </div>
                </div>
            </form>
            <!--end::Form-->
            <!--begin::Scroll-->
            <div wire:ignore.self class="scroll" data-scroll="true" data-height="325" data-mobile-height="200">
                <div class="quick-search-result">

                    @can('clientes')
                        {{-- Clients --}}
                        <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                            Clientes
                        </div>
                        <div class="mb-10">
                            @if ($search && $clients)
                                @foreach ($clients as $client)
                                    <div class="d-flex align-items-center flex-grow-1 mb-2">
                                        <div class="symbol symbol-30  flex-shrink-0">
                                            <div 
                                                class="symbol-label" 
                                                @if ($client->image)
                                                    style="background-image:url('{{ Storage::url($client->image->url) }}')"
                                                @else
                                                    style="background-image:url('{{ asset('assets/media/users/blank.png') }}')"
                                                @endif
                                            ></div>
                                        </div>
                                        <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                            <a href="{{ route('client.show', $client) }}" class="font-weight-bold text-dark text-hover-primary">
                                                {{ $client->name }}
                                            </a>
                                            <span class="font-size-sm font-weight-bold text-muted">
                                                {{ $client->company }}
                                            </span>
                                        </div>
                                    </div>   
                                @endforeach 
                            @endif
                            @if($search && count($clients) == 0)
                                <span class="badge badge-secondary">Sin resultados: {{ $search }}</span>
                            @endif
                            @if ($search && $clientCount > 5)
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('client.index') }}" class="text-center">
                                        Ver todos los clientes ({{ $clientCount }})
                                    </a>
                                </div> 
                            @endif                                                     
                        </div>
                    @endcan

                    @can('prospectos')
                        {{-- Prospects --}}
                        <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                            Prospectos
                        </div>
                        <div class="mb-10">
                            <div class="mb-10">
                                @if ($search && $prospects)
                                    @foreach ($prospects as $prospect)
                                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                                            <div class="symbol symbol-30  flex-shrink-0">
                                                <div 
                                                    class="symbol-label" 
                                                    @if ($prospect->image)
                                                        style="background-image:url('{{ Storage::url($prospect->image->url) }}')"
                                                    @else
                                                        style="background-image:url('{{ asset('assets/media/users/blank.png') }}')"
                                                    @endif
                                                ></div>
                                            </div>
                                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                                <a href="{{ route('prospect.show', $prospect) }}" class="font-weight-bold text-dark text-hover-primary">
                                                    {{ $prospect->name }}
                                                </a>
                                                <span class="font-size-sm font-weight-bold text-muted">
                                                    {{ $prospect->company }}
                                                </span>
                                            </div>
                                        </div>   
                                    @endforeach 
                                @endif
                                @if($search && count($prospects) == 0)
                                    <span class="badge badge-secondary">Sin resultados: {{ $search }}</span>
                                @endif
                                @if ($search && $prospectCount > 5)
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('prospect.index') }}" class="text-center">
                                            Ver todos los prospectes ({{ $prospectCount }})
                                        </a>
                                    </div> 
                                @endif                                                     
                            </div>                              
                        </div>
                    @endcan
                    
                    @can('servicios')
                        {{-- Services --}}
                        <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                            Servicios
                        </div>
                        <div class="mb-10">
                            <div class="mb-10">
                                @if ($search && $services)
                                    @foreach ($services as $service)
                                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                                <a href="{{ route('service.show', $service) }}" class="font-weight-bold text-dark text-hover-primary">
                                                    {{ $service->serviceType->name }}
                                                </a>
                                                <span class="font-size-sm font-weight-bold text-muted">
                                                    {{ $service->client->name }}
                                                </span>
                                            </div>
                                        </div>   
                                    @endforeach 
                                @endif
                                @if($search && count($services) == 0)
                                    <span class="badge badge-secondary">Sin resultados: {{ $search }}</span>
                                @endif
                                @if ($search && $serviceCount > 5)
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('service.index') }}" class="text-center">
                                            Ver todos los servicios ({{ $serviceCount }})
                                        </a>
                                    </div> 
                                @endif                                                     
                            </div>                              
                        </div>
                    @endcan

                    @can('facturas')
                        {{-- Invoices --}}
                        <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                            Facturas
                        </div>
                        <div class="mb-10">
                            <div class="mb-10">
                                @if ($search && $invoices)
                                    @foreach ($invoices as $invoice)
                                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                                <a href="{{ route('invoice.show', $invoice) }}" class="font-weight-bold text-dark text-hover-primary">
                                                    {{ $invoice->concept }} ({{ $invoice->totalToString() }})
                                                </a>
                                                <span class="font-size-sm font-weight-bold text-muted">
                                                    {{ $invoice->client->name }}
                                                </span>
                                            </div>
                                        </div>   
                                    @endforeach 
                                @endif
                                @if($search && count($invoices) == 0)
                                    <span class="badge badge-secondary">Sin resultados: {{ $search }}</span>
                                @endif
                                @if ($search && $invoiceCount > 5)
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('invoice.index') }}" class="text-center">
                                            Ver todos las facturas ({{ $invoiceCount }})
                                        </a>
                                    </div> 
                                @endif                                                     
                            </div>                              
                        </div>
                    @endcan

                    @can('pagos')
                        {{-- Invoices --}}
                        <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                            Pagos
                        </div>
                        <div class="mb-10">
                            <div class="mb-10">
                                @if ($search && $payments)
                                    @foreach ($payments as $payment)
                                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                                <a href="{{ route('payment.show', $payment) }}" class="font-weight-bold text-dark text-hover-primary">
                                                    {{ $payment->concept }} ({{ $payment->montoToString() }})
                                                </a>
                                                <span class="font-size-sm font-weight-bold text-muted">
                                                    {{ $payment->client->name }}
                                                </span>
                                            </div>
                                        </div> 
                                    @endforeach 
                                @endif
                                @if($search && count($payments) == 0)
                                    <span class="badge badge-secondary">Sin resultados: {{ $search }}</span>
                                @endif
                                @if ($search && $paymentCount > 5)
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('payment.index') }}" class="text-center">
                                            Ver todos los pagos ({{ $paymentCount }})
                                        </a>
                                    </div> 
                                @endif                                                     
                            </div>                              
                        </div>
                    @endcan

                    @can('gastos')
                        {{-- Invoices --}}
                        <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                            Gastos
                        </div>
                        <div class="mb-10">
                            <div class="mb-10">
                                @if ($search && $expenses)
                                    @foreach ($expenses as $expense)
                                        <div class="d-flex align-items-center flex-grow-1 mb-2">
                                            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                                <a href="{{ route('expense.show', $expense) }}" class="font-weight-bold text-dark text-hover-primary">
                                                    {{ $expense->concept }} ({{ $expense->montoToString() }})
                                                </a>
                                                <span class="font-size-sm font-weight-bold text-muted">
                                                    {{ $expense->client->name }}
                                                </span>
                                            </div>
                                        </div>   
                                    @endforeach 
                                @endif
                                @if($search && count($expenses) == 0)
                                    <span class="badge badge-secondary">Sin resultados: {{ $search }}</span>
                                @endif
                                @if ($search && $expenseCount > 5)
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('expense.index') }}" class="text-center">
                                            Ver todos las gastos ({{ $expenseCount }})
                                        </a>
                                    </div> 
                                @endif                                                     
                            </div>                              
                        </div>
                    @endcan
                </div>
            </div>
            <!--end::Scroll-->
        </div>
    </div>
    <!--end::Dropdown-->
</div>