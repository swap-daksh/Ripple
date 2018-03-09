@extends('Ripple::layouts.beta-app')
@section('page-title') View Passport @stop
@section('page-content')
<div class="container-fluid p-3" id="ripple-passport"> 
    <div class="col-md-12 p-0">
        <div class="card rounded-0 border-0">
            <div class="card-body p-0">
                <div class="row">
                    <ripple-personal-access-token></ripple-personal-access-token>
                    <ripple-oauth-clients></ripple-oauth-clients>
                    <ripple-authorize-client></ripple-authorize-client>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-vue-components')
    @include('Ripple::passport.components.authorize-client')
    @include('Ripple::passport.components.personal-access-token')
    @include('Ripple::passport.components.oauth-clients')
    <script>
        new Vue({
            el: '#ripple-passport'
        });
    </script>
@endpush