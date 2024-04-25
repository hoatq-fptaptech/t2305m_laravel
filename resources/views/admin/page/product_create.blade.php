@extends('admin.layout.layout')
@section("main")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product Create</h1>
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
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="#" method="Post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" class="form-control"  placeholder="Price">
                                    </div>
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="number" name="qty" class="form-control"  placeholder="Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <input type="number" name="category_id" class="form-control"  placeholder="Category">
                                    </div>
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input type="number" name="brand_id" class="form-control"  placeholder="Brand">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Thumbnail</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="thumbnail" type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
