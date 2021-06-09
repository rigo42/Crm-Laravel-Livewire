<div>
    <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmBecomeToClient({{ $prospect->id }}, '{{ $prospect->name }}')">
        <i wire:loading.remove wire:loading.target="becomeToClient" class="fa fa-user mr-2"></i>  Convertir a cliente
    </a>

    @section('footer')
        @parent 
        <script>
            function confirmBecomeToClient(id, name){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: name + " será convertido a cliente",
                    icon: "question",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fas fa-check-circle'></i> <span class='text-white'>Si, Convertir</span>",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i> <span class='text-dark'>No, Regresar</span>",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-secondary font-weight-bold",
                    confirmButtonClass: "btn btn-primary",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        KTApp.blockPage({
                            overlayColor: '#828383',
                            state: 'primary',
                            message: 'Convirtiendo a cliente'
                        });
                        @this.call('becomeToClient', id);
                    }
                });
            }
        </script>
    @endsection
</div>
