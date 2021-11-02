<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ setting('site_name') }} | {{ setting('site_title') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- Toastr  -->
    <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
    <!-- Date Time Picker  -->
    <link href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"
          rel="stylesheet"/>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Custom CSS -->
    @stack('styles')
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini text-sm {{ setting('sidebar_collapse') ? 'sidebar-collapse' : '' }}">

<div class="wrapper">

    <!-- Navbar -->
@include('layouts.partial.navbar')

<!-- Main Sidebar Container -->
@include('layouts.partial.aside')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{ $slot }}
    </div>

    <!-- Control Sidebar -->
@include('layouts.partial.sidebar')

<!-- Main Footer -->
    @include('layouts.partial.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- Sweet Alert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Date Time Picker  -->
<script src="https://unpkg.com/moment"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- AlpineJS -->
@stack('apline-plugins')]
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- Custom JS -->
<script>
    $(document).ready(function () {
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }

        window.addEventListener('hide-form', event => {
            $('#show-form').modal('hide')
            toastr.success(event.detail.message, 'Success!')
        })
    })
</script>

<script>
    window.addEventListener('show-form', event => {
        $('#show-form').modal('show')
    })

    window.addEventListener('updated', event => {
        toastr.success(event.detail.message, 'Success!')
    })

    window.addEventListener('alert', event => {
        toastr.success(event.detail.message, 'Success!')
    })
</script>

@stack('js')
@livewireScripts

</body>
</html>
