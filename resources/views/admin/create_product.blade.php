@extends('layout.index')
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Tạo sản phẩm mới </li>
                </ol>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg-9">
                <form action="{{ route('createproduct') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputname" class="col-sm-2 col-form-label">Tên Sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="" id="inputname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputquantity" class="col-sm-2 col-form-label">Số Lượng </label>
                        <div class="col-sm-10">
                            <input type="number" name="quantity" class="form-control" value="" id="inputquantity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputdescription" class="col-sm-2 col-form-label">Miêu tả</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control" value="" id="inputdescription">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Giá</label>
                        <div class="col-sm-10">
                            <input type="number" name="price" class="form-control" value="" id="inputPrice">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Loại sản phẩm</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option value="1">Điện thoại</option>
                                <option value="2">Máy tính</option>
                                <option value="3">Phụ kiện</option>
                                <option value="4">Điện tử</option>
                            </select>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{ URL::previous() }}">Go Back</a>
                    <button type="submit" class="btn btn-warning">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
