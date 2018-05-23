@extends('Ripple::layouts.beta-app')

@if(Auth::user()->role == 'admin')
@section('page-title') Edit user @stop
@section('page-description') Edit your User Profile @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::users.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List users</a>
</div>
@stop
@endif

@if(Auth::user()->role == 'dealer')
@section('page-title') Edit Profile @stop
@section('page-description') Edit your User Profile @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::dealerDashboard') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> Dashboard</a>
</div>
@stop
@endif

@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
            <div class="card-body">
             @if(Auth::user()->role == 'dealer')
                <form class="needs-validation" enctype="multipart/form-data"  novalidate="" method="post" action="{!! route('Ripple::updateProfile') !!}">
            @else
                <form class="needs-validation" enctype="multipart/form-data"  novalidate="" method="post" action="{!! route('Ripple::users.update', ['id'=>$user->id]) !!}">  
            @endif
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="userName">First Name</label>
                                    <input class="form-control" id="firstName" placeholder="" name="user[name]" value="{{$user->name}}" required="" type="text">
                                    <div class="invalid-feedback">
                                    Valid user Name is required.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userName">Last Name</label>
                                    <input class="form-control" id="lastName" placeholder="" name="user[last_name]" value="{{$user->last_name}}" required="" type="text">
                                    <div class="invalid-feedback">
                                    Valid Last Name is required.
                                    </div>
                                </div>
                                <label for="firstName">User Avatar</label>
                                <div class="card rounded-0">
                                    <div class="card-body p-3">
                                        <div class="row">
                                                <div class="col-5">
                                                    <div class="clearfix" id="preview-image"> 
                                                        <img width="auto" height="150" class="img-responsive" src="{!! url(Storage::url( $user->avatar)) !!}" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div id="product_image_file_details_info" class="detail_info w-100 px-2">
                                                        <p><strong>Title:</strong>&nbsp;&nbsp;<code>______.___</code></p>
                                                        <p><strong>Size:</strong>&nbsp;&nbsp;<code>___.__ KB/MB</code></p>
                                                        <p><strong>Type:</strong>&nbsp;&nbsp;<code>_____/____</code></p>
                                                    </div>
                                                </div>
                                                <div class="col-6 mt-3">
                                                    <label for="">Upload Directory <sup class="text-danger">Optional</sup></label>
                                                    <div class="input-group  mb-2 mr-sm-2">
                                                        <div class="input-group-prepend" data-toggle="tooltip" title="Specify your path under public directory.">
                                                            <div class="input-group-text"><i class="far fa-folder-open "></i></div>
                                                        </div>
                                                        <input class="form-control" placeholder="public/" type="text" name="user_image_upload_path">
                                                    </div>
                                                </div>
                                                <div class="col-6 mt-3">
                                                    <label for="">Choose Image File</label>
                                                    <div class="custom-file">
                                                        <input class="image-preview custom-file-input-bread" name="user_avatar" id="product_image_custom_input_file" data-preview="preview-image" data-details="#product_image_file_details_info" data-width="auto" data-height="150" type="file">
                                                        <label class="custom-file-label rounded-right" for="product_image_custom_input_file">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                                @if( Auth::user()->role == 'admin')
                                <div class="form-group">
                                    <label for="">Role</label> 
                                    <select id="user_role" name="user[role]"  class="custom-select syncRef" >
                                            <option value="">Select Role</option>
                                            @forelse($roles as $role)
                                            <option value="{{ $role->name}}" {{ $role->name == $user->role ? 'selected': ''  }}>{{ $role->display_name}}</option>
                                            @empty
                                            @endforelse                            
                                    </select>
                                </div>
                                @else
                                <div class="form-group">
                                        <label for="">Role</label> 
                                        <input class="form-control" id="role"   value="{{$user->role}}" type="text" disabled>
                                    </div>

                                @endif
                                <div class="form-group">
                                    <label for="">Email</label> 
                                    <input class="form-control" id="email" placeholder="" name="user[email]" value="{{$user->email}}" required="" type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Password</label> 
                                    <input class="form-control" id="Password" placeholder="" name="new-password"  type="password">
                                    <input name="user[password]" value="{{$user->password}}" type="hidden">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Website</label> 
                                    <input class="form-control" id="Website" placeholder="" name="user[website]" value="{{$user->website}}"  type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Birthday</label> 
                                    <input class="form-control" id="Birthday" placeholder="" name="user[birthday]" value="{{$user->birthday}}"  type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Phone</label> 
                                    <input class="form-control" id="Phone" placeholder="" name="user[phone]" value="{{$user->phone}}"  type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">About</label> 
                                    <textarea class="form-control" id="About" placeholder="" name="user[about]">
                                            {{$user->about}}
                                    </textarea>
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Facebook</label> 
                                    <input class="form-control" id="Facebook" placeholder="" name="user[facebook]" value="{{$user->facebook}}"  type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Twitter</label> 
                                    <input class="form-control" id="Twitter" placeholder="" name="user[twitter]" value="{{$user->twitter}}"  type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Instagram</label> 
                                    <input class="form-control" id="Instagram" placeholder="" name="user[instagram]" value="{{$user->instagram}}"  type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Linkedin</label> 
                                    <input class="form-control" id="Linkedin" placeholder="" name="user[linkedin]" value="{{$user->linkedin}}"  type="text">
                                    <div class="invalid-feedback">
                                    Valid Email is required.
                                    </div>
                                </div>
                                </div>
                                <!--- User Meta-->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="userName">Company Name</label>
                                        <input class="form-control" id="companyName" placeholder="" name="meta[company_name]" value="{{ !empty($meta['company_name']) ? $meta['company_name'] : '' }}" required="" type="text">
                                        <div class="invalid-feedback">
                                        Valid user Name is required.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="userName">Company Profile</label>
                                        <input class="form-control" id="lastName" placeholder="" name="meta[company_profile]" value="{{ !empty($meta['company_profile']) ? $meta['company_profile'] : '' }}" required="" type="text">
                                        <div class="invalid-feedback">
                                        Valid Last Name is required.
                                        </div>
                                    </div>
                                    <label for="firstName">Logo</label>
                                    <div class="card rounded-0">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                    <div class="col-5">
                                                        <div class="clearfix" id="preview-image-avatar"> 
                                                            <img width="auto" height="150" class="img-responsive" src="{!!  !empty($meta['logo']) ? url(Storage::url($meta['logo'])) : ripple_asset('/img/default/default.png') !!}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div id="avatar_image_file_details_info" class="detail_info w-100 px-2">
                                                            <p><strong>Title:</strong>&nbsp;&nbsp;<code>______.___</code></p>
                                                            <p><strong>Size:</strong>&nbsp;&nbsp;<code>___.__ KB/MB</code></p>
                                                            <p><strong>Type:</strong>&nbsp;&nbsp;<code>_____/____</code></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mt-3">
                                                        <label for="">Upload Directory <sup class="text-danger">Optional</sup></label>
                                                        <div class="input-group  mb-2 mr-sm-2">
                                                            <div class="input-group-prepend" data-toggle="tooltip" title="Specify your path under public directory.">
                                                                <div class="input-group-text"><i class="far fa-folder-open "></i></div>
                                                            </div>
                                                            <input class="form-control" placeholder="public/" type="text" name="user_image_upload_path">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mt-3">
                                                        <label for="">Choose Image File</label>
                                                        <div class="custom-file">
                                                            <input class="image-preview custom-file-input-bread" name="meta_logo" id="avatar_image_custom_input_file" data-preview="preview-image-avatar" data-details="#avatar_image_file_details_info" data-width="auto" data-height="150" type="file">
                                                            <label class="custom-file-label rounded-right" for="avatar_image_custom_input_file">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Family Name</label> 
                                        <input class="form-control" id="email" placeholder="" name="meta[family_name]" value="{{ !empty($meta['family_name']) ? $meta['family_name'] : '' }}" required="" type="text">
                                        <div class="invalid-feedback">
                                        Valid Email is required.
                                        </div>
                                    </div>
 
                                    <div class="form-group">
                                        <label for="">Address</label> 
                                        <textarea class="form-control" id="Address" placeholder="" name="meta[address]">
                                            {{ !empty($meta['address']) ? $meta['address'] : '' }}
                                        </textarea>
                                        <div class="invalid-feedback">
                                        Valid Address is required.
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                            <label class="col-md-12" for="">Makers</label> 
                                            @php
                                             if(!empty($meta['maker'])) {
                                                $userMakers = explode(",", $meta['maker']);
                                              }else{
                                                $userMakers = array();
                                              }
                                            @endphp
                                            @forelse($makers as $maker)
                                            
                                            <div class="form-check col-md-6">
                                                    <input class="form-check-input" name="meta[maker][{{$maker->id}}]" type="checkbox" value="{{$maker->id}}" {{in_array($maker->id, $userMakers )? 'checked' : ''}} id="defaultCheck-{{$maker->id}}">
                                                    <label class="form-check-label" for="defaultCheck-{{$maker->id}}">
                                                      {{$maker->maker}}
                                                    </label>
                                            </div>
                                            @empty
                                                  No Maker found
                                            @endforelse

                                        </div>

                                </div>
                           
                        
                        
                        <div class="col-md-12 text-center p-0">
                            <hr>
                            <button type="submit" class="btn w-50 btn-primary"><i class="fa fa-save"></i> Update user</button>
                        </div>
                    </div>
                        
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@stop