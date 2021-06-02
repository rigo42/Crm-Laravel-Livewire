@if (session()->has('alert'))
    <script>
        swal.fire({
            position: 'top-end',
            icon: '{!! session()->get("alert-type") !!}',
            title: '{!! session()->get("alert") !!}',
            toast: false,
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif