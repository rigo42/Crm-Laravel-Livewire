<div class="col-xl-9">
    @if ($count)
         <!--begin::Advance Table Widget 3-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Permisos</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $permissions->total() }}) Permisos(s)</span>
                </h3>
                <div class="card-toolbar">
                    <a href="#" wire:click.prevent="$emit('createFormPermission')" class="btn btn-primary btn-shadow font-weight-bold mr-2 "><i class="fa fa-plus"></i> Nuevo</a>
                </div>
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
                                <th>Nombre</th>
                                <th>Roles</th>
                                <th>Usuarios</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $permission)
                                <tr>
                                    <td>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $permission->name }}</span>
                                    </td>
                                    <td>
                                        @forelse ($permission->roles as $role)
                                            <span class="font-weight-bolder font-size-lg badge badge-success">{{$role->name}}</span>
                                        @empty
                                            <span class="font-size-lg badge badge-secondary">Ninguno</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        @if ($permission->users->count())
                                            <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                                <div class="symbol-group symbol-hover">
                                                    @foreach ($permission->users as $user)
                                                        <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="{{ $user->name }}">
                                                            <img 
                                                                alt="{{ $user->name }}" 
                                                                @if ($user->image)
                                                                    src="{{ Storage::url($user->image->url) }}" 
                                                                @else
                                                                    src="{{ asset('assets/media/users/blank.png') }}" 
                                                                @endif
                                                                >
                                                        </div>
                                                        @if ($loop->index == (8))
                                                            <div class="symbol symbol-30 symbol-circle symbol-light">
                                                                <span class="symbol-label font-weight-bold">{{ $role->users->count() - ($loop->index + 1) }}+</span>
                                                            </div>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else 
                                            <span class="font-size-lg m-1 badge badge-secondary">Ninguno usuario</span>
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
                                                        <li class="navi-item" wire:click.prevent="$emit('editFormPermission', {{ $permission->id }})">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fa fa-pen"></i>
                                                                </span>
                                                                <span class="navi-text">Editar</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item" onclick="event.preventDefault(); confirmDestroy({{ $permission->id }})">
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

                {{ $permissions->links() }}

            </div>
            <!--end::Body-->
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-5">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun permiso.
                    <br> Ponga en marcha su CRM añadiendo su primer permiso</p>
                    <a wire:click.prevent="$emit('createFormPermission')" href="#" class="btn btn-primary">Agregar permiso</a>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
    @endif

    @livewire('setting.permission.form', key('permissions'))

    @section('footer')
        <script>

            function confirmDestroy(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este permiso y muchas partes del sistema dejaran de tener permisos hasta que vuelvan hacer creados",
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

            Livewire.on('createFormPermission', function(){
                $('#modalShowFormPermission').modal('show');
            });
            Livewire.on('editFormPermission', permissionId => {
                $('#modalShowFormPermission').modal('show');
            })
            Livewire.on('closeFormPermission', function(){
                $('#modalShowFormPermission').modal('hide');
            });
        </script>
    @endsection
</div>