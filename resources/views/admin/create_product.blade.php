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
                            <input type="text" name="name" class="form-control" value="{{ old("name") }}" id="inputname">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputquantity" class="col-sm-2 col-form-label">Số Lượng </label>
                        <div class="col-sm-10">
                            <input type="number" name="quantity" class="form-control" value="{{ old("quantity") }}" id="inputquantity">
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputdescription" class="col-sm-2 col-form-label">Miêu tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="inputdescription" aria-label="With textarea">{{ old("description") }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Giá</label>
                        <div class="col-sm-10">
                            <input type="number" name="price" class="form-control" value="{{ old("price") }}" id="inputPrice">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Loại sản phẩm</label>
                        <div class="col-sm-10">
                            <select name="type" class="form-control">
                                <option value="1">Điện thoại</option>
                                <option value="2">Máy tính</option>
                                <option value="3">Phụ kiện</option>
                                <option value="4">Điện tử</option>
                            </select>
                            @error('type')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{ URL::previous() }}">Quay lại</a>
                    <button type="submit" class="btn btn-warning">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
