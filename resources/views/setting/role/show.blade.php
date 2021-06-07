
<!-- Modal-->
<div wire:ignore.self class="modal fade" id="modalShowRole" tabindex="-1" role="dialog" aria-labelledby="modalShowRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowRoleLabel">
                    Rol: {{ $role->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body">
                        <h3 class="text-dark font-weight-bold mb-10">Permisos</h3>
                        <div>
                            @forelse($role->permissions as $permission)
                                <span class="badge badge-success m-1">{{ $permission->name }}</span>
                            @empty 
                                <span class="badge badge-secondary m-1">Ningun permiso</span>
                            @endforelse
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <h3 class="text-dark font-weight-bold mb-10">Usuarios</h3>
                        @if ($role->users->count())
                            <div class="flex-row-auto " >
                                <div class="mt-7" >
                                    @foreach ($role->users as $user)
                                        <div class="d-flex align-items-center justify-content-between mb-5">
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
                                                    <span class="text-muted font-weight-bold font-size-sm">{{ $user->position }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else 
                            <span class="badge badge-secondary">Ningun usuario</span>
                        @endif
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary text-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
