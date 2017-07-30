{{-- Settings Notifications --}}
<script>
    toastr.options = {
        "closeButton": false,
        "debug": true,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "6000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
@if(session()->has('setting-success'))
<script id="toast-notify">
    toastr.success('{!! session("setting-success") !!}', "SUCCESS!");
</script>
@endif
@if(session()->has('setting-warning'))
<script id="toast-notify">
    toastr.error('{!! session("setting-warning") !!}', 'ERROR!');
</script>
@endif