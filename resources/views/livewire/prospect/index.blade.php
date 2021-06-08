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
            @forelse ($prospects as $prospect)
                <!--begin::Col-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
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
                                        <a class="dropdown-item" href="{{ route('prospect.show', $prospect) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                        <a class="dropdown-item" href="{{ route('prospect.edit', $prospect) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $prospect->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
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
                                                @if ($prospect->image)
                                                    src="{{ Storage::url($prospect->image->url) }}" 
                                                @else
                                                    src="{{ asset('assets/media/users/blank.png') }}" 
                                                @endif
                                                
                                                alt="{{ $prospect->name }}" />
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{ $prospect->name }}</a>
                                        <span class="text-muted font-weight-bold">{{ $prospect->company }}</span>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::User-->
                            <!--begin::Info-->
                            <div class="mb-7">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Interes:</span>
                                    <span class="text-muted font-weight-bold">{{ $prospect->interest }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Recordatorio:</span>
                                    <span class="text-muted font-weight-bold">{{ $prospect->reminder }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Status:</span>
                                    <span class="text-muted font-weight-bold">{{ $prospect->status }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Correo:</span>
                                    <a href="mailto:{{ $prospect->email }}" class="text-muted text-hover-primary">{{ $prospect->email }}</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-cente my-1">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Teléfono:</span>
                                    <a href="tel:+{{ $prospect->phone }}" class="text-muted text-hover-primary">{{ $prospect->phone }}
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Origen:</span>
                                    <span class="text-muted font-weight-bold">{{ $prospect->origin }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark-75 font-weight-bolder mr-2">Pertenece a:</span>
                                    <span class="text-muted font-weight-bold">
                                        @if ($prospect->user)
                                            <span class="badge badge-success">{{ $prospect->user->name }}</span>
                                        @else 
                                            <span class="badge badge-secondary">Ninguno usuario</span>
                                        @endif
                                    </span>
                                </div>
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

        {{ $prospects->links() }}

    @else

        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun prospecto.
                    <br> Ponga en marcha su CRM añadiendo su primer prospecto</p>
                    <a href="{{ route('prospect.create') }}" class="btn btn-primary">Agregar prospecto</a>
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
                    text: "No podrá recuperar este prospecto y sus archivos",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> Si, eliminar",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i> No, cancelar",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-primary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                    showLoaderOnConfirm: true,
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', id);
                    }
                });
            }
        </Script>
    @endsection
</div>
