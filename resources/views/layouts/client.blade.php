<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Registrar Office') }}</title>
  <link rel="icon" href="{{ asset('dist/img/psu_logo.png') }}" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  @stack('css')
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  @yield('content')

</div>
<!-- ./wrapper -->
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    {{-- <a class="btn btn-primary" href="login.html">Logout</a> --}}
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </div>
        </div>
    </div>
</div>  
<!-- REQUIRED SCRIPTS -->

@livewireScripts
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Charting library -->
<script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,
        timerProgressBar:true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert',({detail:{type,message}})=>{
        Toast.fire({
            icon:type,
            title:message
        })
    })

    window.addEventListener('swal:updateReleased', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            html: `
                <input
                type="text"
                value=""
                class="form-control mb-2"
                placeholder="Appeal/s"
                id="appeals">
                <input
                type="text"
                value=""
                class="form-control"
                placeholder="Remarks"
                id="remarks">`,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
            if (result.isConfirmed) {
                const appeals = Swal.getHtmlContainer().querySelector('#appeals')
                const remarks = Swal.getHtmlContainer().querySelector('#remarks')
                // console.log(appeals.value, remarks.value)
                Livewire.emit('updateReleasedConfirmed', appeals.value, remarks.value)
            }
        })
    })
    window.addEventListener('swal:updatePending', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            html: `
                <label>Send SMS Notification?</label>
                <select class="form-control" id="sms">
                    <option value="no" selected>No</option>
                    <option value="yes">Yes</option>
                </select>`,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
            if (result.isConfirmed) {
                const sms = Swal.getHtmlContainer().querySelector('#sms')
                // const remarks = Swal.getHtmlContainer().querySelector('#remarks')
                // console.log(appeals.value, remarks.value)
                Livewire.emit('updatePendingConfirmed', sms.value)
            }
        })
    })
    window.addEventListener('swal:updateClaimable', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
            if (result.isConfirmed) {
                // const remarks = Swal.getHtmlContainer().querySelector('#remarks')
                // console.log(appeals.value, remarks.value)
                Livewire.emit('updateClaimableConfirmed')
            }
        })
    })
    window.addEventListener('swal:accountsConfirm', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            id: event.detail.id,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('destroyConfirmed', event.detail.id)
            }
        })
    })
</script>
<script>
    Livewire.on('gotoTop', () => {
        window.scrollTo({
            top: 15,
            left: 15,
            behaviour: 'smooth'
        })
    })
</script>

@stack('js')

</body>
</html>
