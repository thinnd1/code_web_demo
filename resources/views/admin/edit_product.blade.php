@extends('layout.index')
@section('title', 'Cập nhật thông tin sản phẩm')
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Chỉnh sửa sản phẩm </li>
                </ol>
            </div>
        </div><!-- /.row -->
{{--        @dd($products)--}}
        <div class="row">
            <div class="col-lg-9">
                <form action="{{ route('editproduct', ['id' => $products->id]) }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputname" class="col-sm-2 col-form-label">Tên Sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ old("name") ?? $products->name }}" id="inputname">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputquantity" class="col-sm-2 col-form-label">Số Lượng </label>
                        <div class="col-sm-10">
                            <input type="number" name="quantity" class="form-control" value="{{ old("quantity") ?? $products->quantity }}" id="inputquantity">
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputdescription" class="col-sm-2 col-form-label">Miêu tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="inputdescription" aria-label="With textarea">{{ old("description") ?? $products->description }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Giá</label>
                        <div class="col-sm-10">
                            <input type="number" name="price" class="form-control" value="{{ old("price") ?? $products->price }}" id="inputPrice">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Loại sản phẩm</label>
                        <div class="col-sm-10">
                            <select name="type" class="form-control">
                                <option value="1" {{ $products->type == 1 ? 'selected' : '' }}>Điện thoại</option>
                                <option value="2" {{ $products->type == 2 ? 'selected' : '' }}>Máy tính</option>
                                <option value="3" {{ $products->type == 3 ? 'selected' : '' }}>Phụ kiện</option>
                                <option value="4" {{ $products->type == 4 ? 'selected' : '' }}>Điện tử</option>
                            </select>
                            @error('type')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{ route("shop") }}">Quay lại</a>
                    <button type="submit" class="btn btn-warning">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
