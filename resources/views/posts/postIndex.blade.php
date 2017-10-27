@extends('Ripple::layouts.app')
@section('page-content')
<div class="page-header" style="margin: 0px;border-bottom: 1px solid gray;">
    <h1  style="margin: 0px;">Posts<small>...</small> <a  href="{!! route('Ripple::adminPostAdd') !!}" class="btn btn-success btn-sm">Create Setting</a></h1>
</div>
<div class="content">
    <div class="panel">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter table-header-bg option-wrappers">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 120px;"><i class="si si-user"></i></th>
                            <th>Title</th>
                            <th style="width: 30%;">Description</th>
                            <th style="width: 120px;" class="text-center">Publisher</th>
                            <th style="width: 15%;">Status</th>
                            <th class="text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Ripple::posts() as $post)
                        <tr>
                            <td class="text-center">
                                @if(is_null($post->image))
                                <img class="img-avatar img-avatar48" width="115" height="115" src="assets/img/avatars/avatar6.jpg" alt="">
                                @else
                                <img class="img-avatar img-avatar48" width="115" height="115" src="{!! url(Storage::url($post->image)) !!}" alt="">
                                @endif
                            </td>
                            <td class="font-w600">{!! $post->title !!}</td>
                            <td>{!! $post->excerpt !!}</td>
                            <td class="text-center">
                                <a href="javascript:void({!! $post->author !!});">
                                    @if(is_null($post->image))
                                    <img width="115" height="115" class="img-avatar img-avatar48" src="assets/img/avatars/avatar6.jpg" alt="">
                                    @else
                                    <img width="115" height="115" class="img-avatar img-avatar48" src="{!! url(Storage::url($post->image)) !!}" alt="">
                                    @endif
                                </a>
                            </td>
                            <td>
                                <span class="label label-info">{!! $post->status !!}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-default" href="{!! route('Ripple::adminPostEdit',['post'=>$post->id]) !!}" data-toggle="tooltip" title="" data-original-title="Edit Client"><i class="fa fa-pencil"></i> Edit</a>
                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Remove Client"><i class="fa fa-trash"></i> Trash</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
@push('page-script')
<script>
    console.log(route('Ripple::adminPostEdit', {'post': '11'}));
</script>
@endpush