@extends('layout.index')
@section('title', 'Cập nhật thông tin đơn hàng')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Cập nhật đơn hàng </li>
                    </ol>
                </div>
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-9">
                    <form action="{{ route('updateorder', ['id' => $orderdetail->id]) }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="inputname" class="col-sm-2 col-form-label">Tên khách hàng</label>
                            <div class="col-sm-10">
                                <select name="id_user" class="form-control">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->username }}" selected>{{ $customer->full_name }}</option>
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
                                <input type="text" name="id_product" class="form-control" value="{{ old("id_product") ?? $orderdetail->id_product }}" id="inputusername">
                                @error('id_product')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputusername" class="col-sm-2 col-form-label">Tổng tiền</label>
                            <div class="col-sm-10">
                                <input type="number" name="total_price" class="form-control" value="{{ old("total_price") ?? $orderdetail->total_price }}" id="inputusername">
                                @error('total_price')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputemail" class="col-sm-2 col-form-label">Email*</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="{{ old("email") ?? $orderdetail->email }}" id="inputemail">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputphone" class="col-sm-2 col-form-label">Số điện thoại*</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" value="{{ old("phone") ?? $orderdetail->phone }}" id="inputphone">
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputage" class="col-sm-2 col-form-label">Ngày đặt</label>
                            <div class="col-sm-10">
                                <input type="date" name="orderdate" class="form-control" value="{{ old("orderdate") ?? $orderdetail->orderdate }}" id="inputage">
                                @error('orderdate')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-2 col-form-label">Địa chỉ*</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="inputaddress" aria-label="With textarea">{{ old("address") ?? $orderdetail->address }}</textarea>
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputjob" class="col-sm-2 col-form-label">Hình thức thanh toán</label>
                            <div class="col-sm-10">
                                <select name="payment" class="form-control">
                                    <option value="1" {{ $orderdetail->payment == 1 ? 'selected' : '' }}>Tiền mặt</option>
                                    <option value="2" {{ $orderdetail->payment == 2 ? 'selected' : '' }}>Zalo Pay</option>
                                    <option value="3" {{ $orderdetail->payment == 3 ? 'selected' : '' }}>Credit Card</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputjob" class="col-sm-2 col-form-label">Trạng thái đặt hàng</label>
                            <div class="col-sm-10">
                                <select name="order_status" class="form-control">
                                    <option value="1" {{ $orderdetail->status == 1 ? 'selected' : '' }}>Mới</option>
                                    <option value="2" {{ $orderdetail->status == 2 ? 'selected' : '' }}>Đang giao</option>
                                    <option value="3" {{ $orderdetail->status == 3 ? 'selected' : '' }}>Đã giao</option>
                                    <option value="4" {{ $orderdetail->status == 4 ? 'selected' : '' }}>Hủy đơn hàng</option>
                                </select>
                            </div>
                        </div>

                        <a class="btn btn-primary" href="{{ route("order") }}">Quay lại</a>
                        <button type="submit" class="btn btn-warning">Cập nhật</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
