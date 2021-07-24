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
                                            <option value="100">100 Entradas</option>
                                            <option value="200">200 Entradas</option>
                                            <option value="500">500 Entradas</option>
                                            <option value="1000">1000 Entradas</option>
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
            <!--begin::Col-->
            <div class="col-5">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-header align-items-center border-0 mt-4">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="font-weight-bolder text-dark">Todas las actividades dentro del sistema</span>
                            <span class="text-muted mt-3 font-weight-bold font-size-sm"> {{ $count }} Actividad(es)</span>
                        </h3>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <div class="timeline timeline-1">
                            <div class="timeline-sep bg-primary-opacity-20"></div>
                            @forelse ($logs as $log)
                                <div class="timeline-item">
                                    <div class="timeline-label">{{ $log->created_at->format('d-m-Y H:i:s') }}</div>
                                    <div class="timeline-badge">
                                        @if ($log->subject_type == 'App\Models\Prospect')
                                            <i class="fas fa-users"></i> 
                                        @elseif($log->subject_type == 'App\Models\Client')
                                            <i class="fas fa-star"></i>
                                        @elseif($log->subject_type == 'App\Models\Provider')
                                            <i class="fas fa-star"></i>
                                        @elseif($log->subject_type == 'App\Models\ServiceType' || $log->subject_type == 'App\Models\Service' )
                                            <i class="fas fa-star"></i>
                                        @elseif($log->subject_type == 'App\Models\Quotation')
                                            <i class="fa fa-sticky-note"></i>
                                        @elseif($log->subject_type == 'App\Models\Invoice')
                                            <i class="fas fa-file-pdf"></i>
                                        @elseif($log->subject_type == 'App\Models\Payment')
                                            <i class="fa fa-credit-card"></i>
                                        @elseif($log->subject_type == 'App\Models\Expense')
                                            <i class="fa fa-calculator"></i>
                                        @elseif($log->subject_type == 'App\Models\Account')
                                            <i class="fa fa-credit-card"></i>
                                        @elseif($log->subject_type == 'App\Models\CategoryClient')
                                            <i class="fas fa-tag"></i>
                                        @elseif($log->subject_type == 'App\Models\CategoryExpense')
                                            <i class="fas fa-tag"></i>
                                        @else 
                                            <i class="far fa-circle"></i>
                                        @endif
                                    </div>
                                    <div class="timeline-content text-muted font-weight-normal">
                                        {{ $log->description }} 
                                    </div>
                                    <!--start::Toolbar-->
                                    <div class="d-flex justify-content-end">
                                        <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#log-{{ $log->id }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $log->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
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
                    </div>
                </div>
            </div>            
        </div>
        <!--end::Row-->

        @foreach ($logs as $log)

            <!-- Modal -->
            <div class="modal fade" id="log-{{ $log->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $log->log_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        @if ($log->causer)
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-success mr-2">
                                    <img 
                                        @if ($log->causer->image)
                                            src="{{ Storage::url($log->causer->image->url) }}" 
                                        @else
                                            src="{{ asset('assets/media/users/blank.png') }}" 
                                        @endif
                                    />
                                </div>
                                <div class="d-flex flex-column text-left">
                                    <span class="text-muted font-weight-bold">{{ $log->causer->name }}</span>
                                    <span class="text-dark-75 font-weight-bold">{{ $log->causer->position }}</span>
                                </div>
                            </div>
                            <hr>
                        @endif
                        
                        <pre>@json($log->properties, JSON_PRETTY_PRINT)</pre>
                            
                        

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                </div>
            </div>
        @endforeach

        {{ $logs->links() }}

    @else

        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun log.
                    <br> Los logs se irán mostrando conforme las acciones de los usuarios</p>
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
                    text: "No podrá recuperar este log.",
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
