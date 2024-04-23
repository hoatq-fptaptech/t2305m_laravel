@extends('admin.layout.layout')
@section("main")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order Listing</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Responsive Hover Table</h3>
                                <div class="card-tools">
                                    <form action="{{url()->current()}}" method="get">
                                        <div class="row">
                                            <div class="input-group input-group-sm col" style="width: 150px;">
                                                <select name="status" class="form-control">
                                                    <option value="-1">All Status</option>
                                                    <option @if(app("request")->input("status") == \App\Models\Order::STATUS_PENDING) selected @endif value="{{\App\Models\Order::STATUS_PENDING}}">Pending</option>
                                                    <option @if(app("request")->input("status") == \App\Models\Order::STATUS_CONFIRMED) selected @endif value="{{\App\Models\Order::STATUS_CONFIRMED}}">Confirmed</option>
                                                    <option @if(app("request")->input("status") == \App\Models\Order::STATUS_SHIPPING) selected @endif value="{{\App\Models\Order::STATUS_SHIPPING}}">Shipping</option>
                                                    <option @if(app("request")->input("status") == \App\Models\Order::STATUS_SHIPPED) selected @endif value="{{\App\Models\Order::STATUS_SHIPPED}}">Shipped</option>
                                                    <option @if(app("request")->input("status") == \App\Models\Order::STATUS_COMPLETE) selected @endif value="{{\App\Models\Order::STATUS_COMPLETE}}">Complete</option>
                                                    <option @if(app("request")->input("status") == \App\Models\Order::STATUS_CANCEL) selected @endif value="{{\App\Models\Order::STATUS_CANCEL}}">Cancel</option>
                                                </select>
                                            </div>
                                            <div class="input-group input-group-sm col" style="width: 200px;">
                                                <input value="{{app("request")->input("search")}}" type="text" name="search" class="form-control float-right" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Telephone</th>
                                        <th>Date</th>
                                        <th>Grand Total</th>
                                        <th>Payment Method</th>
                                        <th>Paid</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $item)
                                            <tr>
                                                <td>#{{$item->id}}</td>
                                                <td>{{$item->first_name." ".$item->last_name}}</td>
                                                <td>{{$item->telephone}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>{{$item->grand_total}}</td>
                                                <td>{{$item->payment_method}}</td>
                                                <td>
                                                    @if($item->paid)
                                                        <span class="badge bg-success">Đã thanh toán</span>
                                                    @else
                                                        <span class="badge bg-dark">Chưa thanh toán</span>
                                                    @endif
                                                </td>
                                                <td>{!! $item->statusLabel() !!}</td>
                                                <td><a href="{{url("/admin/orders",['order'=>$item->id])}}">Detail</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$orders->links("pagination::bootstrap-4")}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
