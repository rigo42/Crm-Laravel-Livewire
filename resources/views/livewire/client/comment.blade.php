<div>
    <div class="container">
        <form class="form" wire:submit.prevent="store">
            <div class="form-group">
                <textarea wire:model.defer="body" class="form-control form-control-lg form-control-solid" id="exampleTextarea" rows="3" placeholder="Ingresa algun comentario sobre este cliente"></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <button 
                        wire:loading.class="spinner spinner-white spinner-right" 
                        wire:loading.attr="disabled" 
                        wire:target="store" 
                        class="btn btn-primary font-weight-bolder mr-2"
                        type="submit"
                    >
                        <i class="fa fa-save"></i>
                        Guardar comentario
                    </button>
                </div>
            </div>
        </form>

        <div class="separator separator-dashed my-10"></div>

        <!--begin::Timeline-->
        <div class="timeline timeline-3">
            <div class="timeline-items">
                @foreach ($comments as $comment)
                    <div class="timeline-item">
                        <div class="timeline-media">
                            @if ($comment->user)
                                <img alt="{{ $comment->user->name }}" 
                                    @if ($comment->user->image)
                                        src="{{ Storage::url($comment->user->image->url) }}" 
                                    @else
                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                    @endif
                                />
                            @else   
                                <img alt="" src="{{ asset('assets/media/users/blank.png') }}"/>
                            @endif
                        </div>
                        <div class="timeline-content">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="mr-2">
                                    @if ($comment->user)
                                        <a class="text-dark-75 text-hover-primary font-weight-bold">{{ $comment->user->name }}</a>
                                    @else   
                                        <a class="text-dark-75 text-hover-primary font-weight-bold">Usuario eliminado</a>
                                    @endif
                                    <span class="text-muted ml-2">{{ $comment->created_at->toFormattedDateString() }}</span>
                                </div>


                                <div class="dropdown ml-2" data-toggle="tooltip" data-placement="left">
                                    <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-more-hor icon-md"></i>
                                    </a>
                                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover">
                                           
                                            <li class="navi-item">
                                                <a href="#" class="navi-link" onclick="event.preventDefault(); confirmDestroy({{ $comment->id }})">
                                                    <span class="navi-text">
                                                        <span class="label label-xl label-inline label-light-danger"><i class="text-danger fa fa-trash mr-2"></i> Eliminar</span>
                                                    </span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>

                            </div>
                            <p class="p-0">{{ $comment->body }}</p>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <!--end::Timeline-->
    </div>

    @push('footer')
        <script>
            function confirmDestroy(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este comentario.",
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
    @endpush
</div>
