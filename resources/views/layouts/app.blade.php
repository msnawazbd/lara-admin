<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ setting('site_name') }} | {{ setting('site_title') }}</title>
    <link rel="stylesheet" href="/css/app.css">
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

<script src="/js/app.js"></script>
<script src="/js/backend.js"></script>

<!-- Sweet Alert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('js')
@stack('before-livewire-scripts')
@livewireScripts
@stack('after-livewire-scripts')

<!-- AlpineJS -->
@stack('apline-plugins')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
