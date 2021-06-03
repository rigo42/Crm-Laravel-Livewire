@if (session()->has('alert'))
    <script>
        swal.fire({
            position: 'top-end',
            icon: '{!! session()->get("alert-type") !!}',
            title: '{!! session()->get("alert") !!}',
            toast: true,
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif