<div class="container">

    @if ($count)
            
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <form action="#" >
                    <div class="input-icon">
                        <input 
                            wire:model="search"
                            type="search" 
                            class="form-control"
                            placeholder="Buscar...">
                        <span>
                            <i class="flaticon2-search-1 icon-md"></i>
                        </span>
                    </div>
                </form>
                <!--end::Compact form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        
        <!--begin::Row-->
        <div class="row">
            @forelse ($clients as $client)
                <!--begin::Col-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">

                        @if ($client->premium)
                        <!-- Client stars -->
                        <div class="ribbon ribbon-top ribbon-ver">
                            <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
                                <i class="fa fa-star text-white"></i>
                            </div>
                        </div>
                        @endif
                        
                        <!--begin::Body-->
                        <div class="card-body pt-4">

                            <!--start::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
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
                                    <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                        <div class="symbol symbol-circle symbol-lg-75">
                                            <img 
                                                @if ($client->image)
                                                    src="{{ Storage::url($client->image->url) }}" 
                                                @else
                                                    src="{{ asset('assets/media/users/blank.png') }}" 
                                                @endif
                                                
                                                alt="{{ $client->name }}" />
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{ $client->name }}</a>
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
                                    <span class="text-dark-75 font-weight-bolder mr-2">Correo:</span>
                                    <a href="mailto:{{ $client->email }}" class="text-muted text-hover-primary">{{ $client->email }}</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-cente my-1">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Teléfono:</span>
                                    <a href="tel:+{{ $client->phone }}" class="text-muted text-hover-primary">{{ $client->phone }}
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Origen:</span>
                                    <span class="text-muted font-weight-bold">{{ $client->origin }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Pertenece a:</span>
                                    <span class="text-muted font-weight-bold">{{ $client->user->name }}</span>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center flex-wrap mb-4">
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1 text-success">
                                    <span class="mr-4">
                                        <i class="flaticon-piggy-bank icon-2x  font-weight-bold  text-success"></i>
                                    </span>
                                    <div class="d-flex flex-column ">
                                        <span class="font-weight-bolder font-size-sm ">Pagos</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="font-weight-bold ">$</span>249,500</span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1 text-danger">
                                    <span class="mr-4">
                                        <i class="flaticon-confetti icon-2x font-weight-bold text-danger"></i>
                                    </span>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bolder font-size-sm">Gastos</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="font-weight-bold">$</span>164,700</span>
                                    </div>
                                </div>
                                <!--end: Item-->
                            </div>
                            <a href="#" class="btn btn-block btn-sm btn-light-primary font-weight-bolder text-uppercase py-4">Redactar correo</a>
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
                    <img class="img-fluid col-6" alt="" src="https://preview.keenthemes.com/metronic8/demo1/assets/media/illustrations/work.png">
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
                    confirmButtonText: "<i class='fa fa-trash'></i> Si, eliminar",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i> No, cancelar",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-primary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                    showLoaderOnConfirm: true,
                    onPreconfim: function() {
                        swal.showLoading()
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', id);
                    }
                });
            }
        </Script>
    @endsection
</div>