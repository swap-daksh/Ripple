<script src="{!! ripple_asset('/js/theme.js') !!}"></script>
<script src="{!! ripple_asset('/lib/js/tinymce/tinymce.min.js') !!}"></script>
<script src="{!! ripple_asset('/lib/js/toastr/toastr.min.js') !!}"></script>
<script src="{!! ripple_asset('/js/ripple.js') !!}"></script>
@include('Ripple::layouts.toast-notification')
@stack('page-script')