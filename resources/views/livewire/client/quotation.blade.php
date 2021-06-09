<div class="container">

    <div class="card card-custom gutter-b">

        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Cotizacion(es) <span class="text-muted font-weight-bold font-size-sm">({{ $count }})</span> </span> 
            </h3>
            <div class="card-toolbar">
                <a href="#" class="btn btn-primary btn-shadow font-weight-bold mr-2 "><i class="fa fa-plus"></i> Nuevo</a>
            </div>
        </div>

        <div class="card-body pt-0 pb-3">
            <div class="mb-5 ">
                <div class="d-flex justify-content-beetwen">
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
        <!--end::Body-->
    </div>

    <div class="row">
        @foreach ($quotations as $quotation)
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
                                        <a class="dropdown-item" href="{{ route('client.show', $client) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                        <a class="dropdown-item" href="{{ route('client.edit', $client) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $client->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <!--begin: Icon-->
                            <img alt="" class="max-h-65px" src="{{ asset('assets/media/svg/files/pdf.svg') }}">
                            <!--end: Icon-->
                            <!--begin: Tite-->
                            <a href="#" class="text-dark-75 font-weight-bold mt-15 font-size-lg">{{ $quotation->concept }}</a>
                            <!--end: Tite-->
                        </div>
                    </div>
                </div>
                <!--end:: Card-->
            </div>
        @endforeach
        
    </div>
</div>