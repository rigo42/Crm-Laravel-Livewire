<div>
    
    <a class="dropdown-item" href="#" onclick="event.preventDefault(); sendEmail({{ $payment->id }})">
        <i wire:loading.remove wire:loading.target="sendEmail" class="
        fas fa-mail-bulk mr-2"></i>  
        @if ($payment->send_email)
            Re-Enviar confirmación de pago
        @else       
            Enviar confirmación de pago
        @endif
    </a>

    @section('footer')
        @parent 
        <script>
            
            function sendEmail(id){
                swal.fire({
                    title: "Hola",
                    text: "¿Te gustaría enviar este comprobante de pago por correo?",
                    icon: "question",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fas fa-check-circle'></i> <span class='text-white'>Si, Enviar</span>",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i> <span class='text-dark'>No, Regresar</span>",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-secondary font-weight-bold",
                    confirmButtonClass: "btn btn-primary",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        KTApp.blockPage({
                            overlayColor: '#828383',
                            state: 'primary',
                            message: 'Enviando correo de confirmación de pago'
                        });
                        @this.call('sendEmail', id);
                    }
                });
            }

        </script>
    @endsection
</div>
