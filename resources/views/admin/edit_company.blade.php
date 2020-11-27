@extends('layout.index')
@section('title', 'Cập nhật thông tin sản phẩm')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Cập nhật công ty </li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-9">
                    <form action="{{ route('updatecompany', ['id' => $shopDetail->id]) }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="inputname" class="col-sm-2 col-form-label">Tên công ty*</label>
                            <div class="col-sm-10">
                                <input type="text" name="name_shop" class="form-control" value="{{ old("name_shop") ??  $shopDetail->name_shop }}" id="inputname">
                                @error('name_shop')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputemail" class="col-sm-2 col-form-label">Email*</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="{{ old("email") ?? $shopDetail->email }}" id="inputemail">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputphone" class="col-sm-2 col-form-label">Số điện thoại*</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" value="{{ old("phone") ?? $shopDetail->phone }}" id="inputphone">
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-2 col-form-label">Địa chỉ*</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="inputaddress" aria-label="With textarea">{{ old("address") ?? $shopDetail->address }}</textarea>
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputage" class="col-sm-2 col-form-label">Số hàng đã mua</label>
                            <div class="col-sm-10">
                                <input type="number" name="quantity_product" class="form-control" value="{{ old("quantity_product") ?? $shopDetail->quantity_product }}" id="inputage">
                                @error('quantity_product')
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
