@extends('Ripple::layouts.beta-app')
@section('page-title') Products @stop
@section('page-description') List all products. @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::products.create') !!}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Product</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-12">
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
            </table>
    </div>
    </div>
</div>
@stop