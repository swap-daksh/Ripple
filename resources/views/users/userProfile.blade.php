@extends('Ripple::layouts.app')
@section('page-content')
<div class="content">
    <div class="block block-themed">
        <div class="block-header bg-gray-darker">
            <ul class="block-options">
                <li>
                    <button data-toggle="modal" data-target="#modal-large" type="button"><i class="fa fa-circle text-success" style="font-size: 18px"></i></button>
                </li>
            </ul>
            <h3 class="block-title">User Profile</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <a class="block block-link-hover3" href="javascript:void(0)">
                        <div class="block-content block-content-full text-center">
                            <div>
                                <img class="img-avatar img-avatar96" src="{!! ripple_asset('/img/default/profile.png') !!}" alt="">
                            </div>
                            <div class="h5 push-15-t push-5">Rebecca Reid</div>
                        </div>
                        <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                            <div class="text-center text-muted">Web Designer</div>
                        </div>
                        <div class="block-content">
                            <div class="row items-push text-center">
                                <div class="col-xs-6">
                                    <div class="push-5"><i class="si si-badge fa-2x"></i></div>
                                    <div class="h5 font-w300 text-muted">9 Badges</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="push-5"><i class="si si-wallet fa-2x"></i></div>
                                    <div class="h5 font-w300 text-muted">$ 3.100</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-9">
                    <!-- Bootstrap Login -->
                    <div class="block block-themed">
                        <div class="block-header bg-primary">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                                </li>
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Profile Detail</h3>
                        </div>
                        <div class="block-content">
                            <form class="form-horizontal push-5-t" action="base_forms_premade.html" method="post" onsubmit="return false;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12" for="login1-username">Full Name</label>
                                        <div class="col-xs-12">
                                            <input class="form-control" id="login1-username" name="login1-username" placeholder="Enter your username.." type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12" for="login1-password">Phone No</label>
                                        <div class="col-xs-12">
                                            <input class="form-control" id="login1-password" name="login1-password" placeholder="Enter your password.." type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12" for="login1-password">Gender</label>
                                        <div class="col-xs-12">
                                            <input class="form-control" id="login1-password" name="login1-password" placeholder="Enter your password.." type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12" for="login1-password">Email</label>
                                        <div class="col-xs-12">
                                            <input class="form-control" id="login1-password" name="login1-password" placeholder="Enter your password.." type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12" for="login1-password">Password</label>
                                        <div class="col-xs-12">
                                            <input class="form-control" id="login1-password" name="login1-password" placeholder="Enter your password.." type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12" for="login1-password">Confirm Password</label>
                                        <div class="col-xs-12">
                                            <input class="form-control" id="login1-password" name="login1-password" placeholder="Enter your password.." type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 text-center">
                                        <button class="btn btn-rounded btn-primary" type="submit"><i class="fa fa-arrow-right push-5-r"></i> Update User</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Bootstrap Login -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop