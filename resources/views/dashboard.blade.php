@extends('Ripple::layouts.beta-app')
@section('page-title') Dashboard @stop
@section('page-content')
<div class="container-fluid p-3"> 
    <div class="row">
        <div class="col"> 
            <div class="card rounded-0 border-0">
                <div class="card-body clearfix">
                    <div class="card-deck">
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">BREAD</h4>
                            </div>
                            <div class="card-body">
                                <p>BREAD stands for Browse Read Edit Add & Delete. By enabling BREAD to database table we can easily Browse, Read, Edit, Add & Delete the data of that particular tabel. This module will list out all enabled BREADs and provide access to the whole BREAD system of a database table.</p>
                                <a href="{!! route('Ripple::breadModule') !!}" class="btn btn-block btn-outline-primary">Get Started</a>
                            </div>
                        </div>
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Database</h4>
                            </div>
                            <div class="card-body">
                                <p>A set of 3 sub-modules has combined to Database module which helps to manage all major operations on database like Creating BREAD System for a database table, Creating and Listing of database tables, Creating database table relations for BREAD tool.</p>
                                <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-block btn-outline-primary">Get Started</a>
                            </div>
                        </div>
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Settings</h4>
                            </div>
                            <div class="card-body ">
                                <p>Setting refer to the all global settings of our website like Website Title, Logo, Description etc. Settings Module is further divided into three categories which are General, SEO and Social. In future settings groups can be extend with more groups as per requirements.</p>
                                <a href="{!! route('Ripple::settingModule') !!}" class="btn btn-block btn-outline-primary">Get Started</a>
                            </div>
                        </div>
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">News &amp; Blog</h4>
                            </div>
                            <div class="card-body ">
                                <p>News &amp; Blog will help us to create posts for our blog page and news page. A post can be a blog post or a News each post can be categorised with tags or categories.</p>
                                <a href="{!! route('Ripple::adminPostIndex') !!}" class="btn btn-block btn-outline-primary">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop