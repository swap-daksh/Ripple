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
            <h3 class="block-title">Users</h3>
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
                        <form method="post" action="" id="add_new_setting">
                            {!! csrf_field() !!}
                            <input type="hidden" name="setting-create" value="zzz">
                            <input type="submit" value="&nbsp;" hidden id="create-setting">
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>Setting Key</label>
                                    <input class="form-control setting-key" id="setting-key" required name="setting-key" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>Setting Name</label>
                                    <input class="form-control setting-name" id="setting-name" required name="setting-name" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-sm btn-default btn-rounded" type="button" data-dismiss="modal" onclick="document.getElementById('add_new_setting').reset();">Close</button>
                <button class="btn btn-sm btn-primary btn-rounded" type="button" onclick="document.getElementById('create-setting').click();"><i class="fa fa-check"></i> Save Setting</button>
            </div>
        </div>
    </div>
</div>
@stop