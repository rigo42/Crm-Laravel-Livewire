<div class="container">
    @if ($count)

        <div class="card card-custom gutter-b">

            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Usuario(s) <span class="text-muted font-weight-bold font-size-sm">({{ $count }})</span> </span> 
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('service.edit', $service) }}#users" class="btn btn-primary btn-shadow font-weight-bold mr-2 "><i class="fa fa-plus"></i> Nuevos colaboradores</a>
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

        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-uppercase">
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-50 mr-3">
                                        <img 
                                            alt="{{ $user->name }}" 
                                            @if ($user->image)
                                                src="{{ Storage::url($user->image->url) }}" 
                                            @else
                                                src="{{ asset('assets/media/users/blank.png') }}" 
                                            @endif
                                            >
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('user.show', $user) }}" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{ $user->name }}</a>
                                        <span class="text-muted font-weight-bold font-size-sm">
                                            @foreach ($user->roles as $role)
                                                {{ $role->name.', ' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
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
                                                <li class="navi-item" onclick="event.preventDefault(); confirmRemoveUser({{ $user->id }});">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                        <span class="navi-text">Remover de este servicio</span>
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

        {{ $users->links() }}

    @else
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-5">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">No cuentas con ningun colaborador <br> 
                        agrega a un colaborador para llevar el control de quienes estan a cargo</p>
                        <a href="{{ route('service.edit', $service) }}#users" class="btn btn-primary">Agregar colaboradores</a>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
    @endif
    @push('footer')
        <script>
            function confirmRemoveUser(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "Removerás este usuario del servicio.",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> Si, eliminar",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i> No, cancelar",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-primary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('removeUser', id);
                    }
                });
            }
        </script>
    @endpush
</div>