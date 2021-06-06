<div class="col-xl-9">
    @if ($count)
        <div class="card card-custom gutter-b">

            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Roles</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ $roles->total() }}) Roles(s)</span>
                </h3>
                <div class="card-toolbar">
                    <a href="#" wire:click.prevent="$emit('createFormRole')" class="btn btn-primary btn-shadow font-weight-bold mr-2 "><i class="fa fa-plus"></i> Nuevo</a>
                </div>
            </div>

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

            </div>
            <!--end::Body-->
        </div>

        <div class="row">
            @forelse ($roles as $role)
                <div class="col-xl-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 align-items-center">
                            <h3 class="card-title font-weight-bolder text-dark">{{ $role->name }}</h3>
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left"  style="position: initial!important;">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="position: inherit;">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover py-5">
                                            <li class="navi-item" wire:click.prevent="$emit('showRole', {{ $role->id }})">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                    <span class="navi-text">Ver</span>
                                                </a>
                                            </li>
                                            <li class="navi-item" wire:click.prevent="$emit('editFormRole', {{ $role->id }})">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="fa fa-pen"></i>
                                                    </span>
                                                    <span class="navi-text">Editar</span>
                                                </a>
                                            </li>
                                            <li class="navi-item" onclick="event.preventDefault(); confirmDestroy({{ $role->id }})">
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
                        </div>
                        <div class="card-body pt-2 d-block">
                            @forelse ($role->permissions as $permission)
                                <div class="d-flex align-items-center mb-10">
                                    <span class="bullet bullet-bar bg-success align-self-stretch mr-5"></span>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">{{ $permission->name }}</a>
                                        <span class="text-muted font-weight-bold">{{ $permission->created_at->diffforhumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="">
                                    <span class="font-size-lg m-1 badge badge-secondary">Ninguno permisos asignado</span>
                                </div>
                            @endforelse
                            @if ($role->users->count())
                                <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                    <div class="symbol-group symbol-hover">
                                        @foreach ($role->users as $user)
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
                                <p>
                                    <span class="font-size-lg m-1 badge badge-secondary">Ninguno usuario</span>
                                </p>
                            @endif
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
        {{ $roles->links() }}
    @else
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-5">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun rol.
                    <br> Ponga en marcha su CRM añadiendo su primer rol</p>
                    <a wire:click.prevent="$emit('createFormRole')" href="#" class="btn btn-primary">Agregar rol</a>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
    @endif

    @livewire('setting.role.form')

    @section('footer')
        <script>
            function confirmDestroy(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este rol, y todo usuario que tenga este rol se quedará sin permisos",
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

            Livewire.on('createFormRole', function(){
                $('#modalShowFormRole').modal('show');
            });
            Livewire.on('showRole', roleId => {
                $('#modalShowRole').modal('show');
            });
            Livewire.on('editFormRole', roleId => {
                $('#modalShowFormRole').modal('show');
            })
            Livewire.on('closeFormRole', function(){
                $('#modalShowFormRole').modal('hide');
            });
        </script>
    @endsection
</div>