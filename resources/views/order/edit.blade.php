@extends('Ripple::layouts.beta-app')
@section('page-title') Edit Order @stop
@section('page-description') Edit an Order@stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::order.index') !!}" class="btn btn-primary btn-sm"><i class="fa fa-list-alt"></i> List All Order</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p-3">
    <div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
                <div class="card-body">
                    <form method="POST" id="AddBreadForm" enctype="multipart/form-data" action="{!! route('Ripple::order.update', ['id'=>$order->id]) !!}">
                        @csrf
                        @method('PUT')
                        @php
                        $personal_info = json_decode($order->personal_info, true);
                        @endphp

                        @php
                        $product_data = json_decode($order->product_data, true);
                     @endphp
                     <div class="form-group">
                             <table class="table table-hover table-bordered">
                                 <tr>
                                     <th>Product Id</th>
                                     <th>Product Name</th>
                                     <th>Variation</th>
                                     <th>QTY</th>
                                     <th>SKU</th>
                                     <th>Price</th>
                                 </tr>
                                 @foreach($product_data as $product)
                                 <tr>
                                     <td>{{ $product['id'] }}</td>
                                     <td>{{ $product['name']}}</td>
                                     <td>{{ $product['variation']}}</td>
                                     <td>{{ $product['qty']}}</td>
                                     <td>{{ $product['sku']}}</td>
                                     <td>{{ $product['price']}}</td>
                                 </tr>
                                 @endforeach
                             </table>
                     </div>

                            <div class="form-group">
                                <label for=""> Order Id</label> 
                                <input type="text"  value="{!! $order->order_no !!}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                    <label for=""> User Email</label> 
                                    <input type="text"  value="{!! $order->getUser->email !!}" class="form-control" disabled>
                            </div> 

                            <div class="form-group">
                                    <label for=""> Order Total</label> 
                                    <input type="text"  value="{!! $order->total !!}" class="form-control" disabled>
                            </div> 
                            <div class="form-group">
                                    <label for=""> Order Status</label> 
                                    <select id="" class="custom-select" name="order[status]">
                                        <option value="inProgress" @if($order->status == 'inProgress') selected @endif>In Progress</option>
                                        <option value="paid"  @if($order->status == 'paid') selected @endif>Paid</option>
                                        <option value="confirmed"  @if($order->status == 'confirmed') selected @endif>Confirmed</option>
                                        <option value="dispatched"  @if($order->status == 'dispatched') selected @endif>Dispatched</option>
                                        <option value="completed"  @if($order->status == 'completed') selected @endif>Completed</option>
                                        <option value="cancelled"  @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                                    </select>
                            </div> 

                            <div class="form-group">
                                    <label for=""> Payment Status</label> 
                                    <select id="" class="custom-select" name="order[payment]">
                                        <option value="P" @if($order->payment == 'P') selected @endif>Paid</option>
                                        <option value="N/P" @if($order->payment == 'N/P') selected @endif>Not Paid</option>
                                    </select>
                            </div> 
                            <div class="form-group">
                                    <label for=""> Transaction Id</label> 
                                    <input type="text"  value="{!! $order->transaction_id !!}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Shipping Address</th>
                                            <th>City</th>
                                            <th>Zip</th>
                                        </tr>
                                       
                                        <tr>
                                            <td>{{ $personal_info['name'] }}</td>
                                            <td>{{ $order->getUser->email }}</td>
                                            <td>{{ $personal_info['address'] }}</td>
                                            <td>{{ $personal_info['city'] }}</td>
                                            <td>{{ $personal_info['zip'] }}</td>
                                            
                                        </tr>
                                       
                                    </table>
                            </div>

                               
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button onclick="document.getElementById('AddBreadForm').submit();" class="btn btn-sm btn-success">
                                <i class="fa fa-save"></i>  Update Order
                            </button> 
                            <a href="{!! route('Ripple::dealer.index') !!}" class="btn btn-primary btn-sm">
                                <i class="fa fa-list"></i>  Manage all Orders
                            </a>
                        </div>
        </div>
        </div>
    </div>
</div>
@stop
