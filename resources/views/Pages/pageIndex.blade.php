@extends('Ripple::layouts.app')
@section('page-content')
<div class="content">
    <div class="block block-themed">
        <div class="block-header bg-gray-darker">
            <ul class="block-options">
                <li>
                    <button data-toggle="modal" data-target="#modal-large" type="button"><i class="fa fa-circle text-success" style="font-size: 18px"></i> New Page</button>
                </li>
            </ul>
            <h3 class="block-title">Pages</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter table-header-bg option-wrappers">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 120px;"><i class="si si-user"></i></th>
                            <th>Name</th>
                            <th style="width: 30%;">Email</th>
                            <th style="width: 15%;">Access</th>
                            <th style="width: 15%;">Publishes</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i<5;$i++)
                        <tr>
                            <td class="text-center">
                                <img class="img-avatar img-avatar48" src="assets/img/avatars/avatar6.jpg" alt="">
                            </td>
                            <td class="font-w600">Julia Cole</td>
                            <td>client1@example.com</td>
                            <td>
                                <span class="label label-info">Business</span>
                            </td>
                            <td>
                                <span class="badge badge-info">25</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Edit Client"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Remove Client"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endfor

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-popout">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Add New User</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <form method="post" action="" id="add_new_user">
                            {!! csrf_field() !!}
                            <input type="hidden" name="user-create" value="zzz">
                            <input type="submit" value="&nbsp;" hidden id="create-user">
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>Full Name</label>
                                    <input class="form-control setting-key" id="setting-key" required name="setting-key" type="text">
                                </div>
                                <div class="form-group clearfix">
                                    <label>Email</label>
                                    <input class="form-control setting-key" id="setting-key" required name="setting-key" type="text">
                                </div>
                                <div class="form-group clearfix">
                                    <label>Password</label>
                                    <input class="form-control setting-key" id="setting-key" required name="setting-key" type="text">
                                </div>
                                <div class="form-group clearfix">
                                    <label>Mobile No</label>
                                    <input class="form-control setting-key" id="setting-key" required name="setting-key" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="animated fadeIn col-sm-11 pull-right no-padding">
                                    <div class="img-container">
                                        <div id="data-preview-dp">
                                            <img class="img-responsive" src="{!! ripple_asset('/img/default/default.png') !!}" alt="" width="150" height="100">
                                        </div>
                                        <div class="img-options">
                                            <div class="img-options-content">
                                                <h3 class="font-w400 text-white push-5">dfsdfgsdfg</h3>
                                                <h4 class="h6 font-w400 text-white-op push-15"></h4>
                                                <label class="btn btn-sm btn-default" for="1-input"><i class="fa fa-pencil"></i> Change</label>
                                                <input type="file" class="image-preview file-input" id="1-input" data-preview='data-preview-dp' name="" style="display: none">
                                                <a class="btn btn-sm btn-default" href="javascript:void(0)"><i class="fa fa-times"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-sm btn-default btn-rounded" type="button" data-dismiss="modal" onclick="document.getElementById('add_new_user').reset();">Close</button>
                <button class="btn btn-sm btn-primary btn-rounded" type="button" onclick="document.getElementById('create-setting').click();"><i class="fa fa-check"></i> Save User</button>
            </div>
        </div>
    </div>
</div>
@stop