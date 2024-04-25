@extends('admin.layout.layout')
@section("main")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product Listing</h1>
                        <a href="{{url("/admin/products/create")}}">Create new product</a>
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
                                        <th>Name</th>
                                        <th>Thumbnail</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $item)
                                            <tr>
                                                <td>#{{$item->id}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->thubnail}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->qty}}</td>
                                                <td>{{$item->category_id}}</td>
                                                <td>{{$item->brand_id}}</td>
                                                <td><a href="#">Detail</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$products->links("pagination::bootstrap-4")}}
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
