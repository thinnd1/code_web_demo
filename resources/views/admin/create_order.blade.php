@extends('layout.index')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Tạo đơn hàng </li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-9">
                    <form action="{{ route('createorder') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="inputname" class="col-sm-2 col-form-label">Tên khách hàng</label>
                            <div class="col-sm-10">
                                <select name="id_user" class="form-control">
                                    <option value="0">--Khách hàng--</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->username }}">{{ $customer->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputusername" class="col-sm-2 col-form-label">Sản phẩm*</label>
                            <div class="col-sm-10">
                                <input type="text" name="id_product" class="form-control" value="{{ old("id_product") }}" id="inputusername">
                                @error('id_product')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputusername" class="col-sm-2 col-form-label">Tổng tiền</label>
                            <div class="col-sm-10">
                                <input type="number" name="total_price" class="form-control" value="{{ old("total_price") }}" id="inputusername">
                                @error('total_price')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputemail" class="col-sm-2 col-form-label">Email*</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="{{ old("email") }}" id="inputemail">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputphone" class="col-sm-2 col-form-label">Số điện thoại*</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" value="{{ old("phone") }}" id="inputphone">
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputage" class="col-sm-2 col-form-label">Ngày đặt</label>
                            <div class="col-sm-10">
                                <input type="date" name="orderdate" class="form-control" value="{{ old("orderdate") }}" id="inputage">
                                @error('orderdate')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-2 col-form-label">Địa chỉ*</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="inputaddress" aria-label="With textarea">{{ old("address") }}</textarea>
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputjob" class="col-sm-2 col-form-label">Hình thức thanh toán</label>
                            <div class="col-sm-10">
                                <select name="payment" class="form-control">
                                    <option value="1">Tiền mặt</option>
                                    <option value="2">Zalo Pay</option>
                                    <option value="3">Khác</option>
                                </select>
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
