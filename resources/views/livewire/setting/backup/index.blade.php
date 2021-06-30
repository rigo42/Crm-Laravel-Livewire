<div class="col-xl-9">
    @if ($count)

         <!--begin::Advance Table Widget 3-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Copias de seguridad</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">({{ count($backups) }}) copias(s)</span>
                </h3>
                <div class="card-toolbar">
                    <button 
                        wire:click.prevent="generate" 
                        wire:loading.class="spinner spinner-white spinner-right"
                        wire:loading.attr="disabled"
                        wire:target="generate"
                        class="btn btn-primary btn-shadow font-weight-bold mr-2 "
                    >
                        <i class="fa fa-plus"></i> Nueva
                    </button>
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
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                            <tr class="text-uppercase">
                                <th>Ruta</th>
                                <th>Archivo</th>
                                <th>Peso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($backups as $backup)
                                <tr>
                                    <td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $backup }}</span></td>
                                    <td>
                                            <img 
                                                width="65" 
                                                src="{{ asset('assets') }}/media/svg/files/zip.svg" alt=""
                                            >
                                    </td>
                                    <td>{{ formatBytes(Storage::size($backup)) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left"  style="position: initial!important;">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="position: inherit;">
                                                    <!--begin::Navigation-->
                                                    <ul class="navi navi-hover py-5">
                                                        <li class="navi-item" wire:click="download('{{ $backup }}')">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="fas fa-download"></i>
                                                                </span>
                                                                <span class="navi-text">Descargar</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item" wire:click="destroy('{{ $backup }}')">
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
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->

            </div>
            <!--end::Body-->
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-5">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ninguna copia de seguridad.
                    <br> Es recomendable que realices copias de seguirdad una vez por semana</p>
                    <button 
                        wire:click.prevent="generate" 
                        wire:loading.class="spinner spinner-white spinner-right"
                        wire:loading.attr="disabled"
                        wire:target="generate"
                        class="btn btn-primary"
                    >
                        Generar copia de segurida
                    </button>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="https://cdn4.iconfinder.com/data/icons/jetflat-2-devices-vol-2/60/009_089_refresh_reload_data_base_database_rack_server_backup-512.png">
                </div>
            </div>
        </div>
    @endif

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
        </script>
    @endsection
</div>