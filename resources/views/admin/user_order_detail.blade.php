@extends('layout.index')
@section('title', 'Xem đơn hàng của khách hàng')
@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Danh sách đặt hàng theo cá nhân</li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="inputUser" class="col-sm-2 col-form-label">Tên Đăng Nhập</label>
                                <div class="col-sm-10">
                                    {{ $customerDetail->username }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputUser" class="col-sm-2 col-form-label">Họ và tên</label>
                                <div class="col-sm-10">
                                    {{ $customerDetail->full_name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputUser" class="col-sm-2 col-form-label">Ngày sinh</label>
                                <div class="col-sm-10">
                                    {{ \Carbon\Carbon::parse($customerDetail->date_of_birth)->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputUser" class="col-sm-2 col-form-label">Giới tính</label>
                                <div class="col-sm-10">
                                    @if($customerDetail->gender == 1)
                                        Nam
                                    @else
                                        Nữ
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputUser" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    {{ $customerDetail->email }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputUser" class="col-sm-2 col-form-label">Số điện thoại</label>
                                <div class="col-sm-10">
                                    {{ $customerDetail->phone }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputUser" class="col-sm-2 col-form-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    {{ $customerDetail->address }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover tablesorter">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Người đặt</th>
                                <th>Sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Địa chỉ</th>
                                <th>Ngày đặt hàng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Thanh Toán</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            <p>Tổng đơn hàng : {{ $listCustomers->total() }}</p>
                            @if(count($listCustomers) == 0)
                                <tr class="borderless">
                                    <td colspan="10" class="text-center">Không có dữ liệu</td>
                                </tr>
                            @else
                                @foreach ($listCustomers as $index => $listCustomer)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $listCustomer->id_user }}</td>
                                        <td>{{ $listCustomer->id_product }}</td>
                                        <td>{{ $listCustomer->total_price }}</td>
                                        <td>{{ $listCustomer->address }}</td>
                                        <td>{{ $listCustomer->created_at }}</td>
                                        <td>{{ $listCustomer->email }}</td>
                                        <td>{{ $listCustomer->phone }}</td>
                                        <td>
                                            @if($listCustomer->payment == 1)
                                                Tiền mặt
                                            @elseif($listCustomer->payment == 2)
                                                Zalo Pay
                                            @else
                                                Credit Card
                                            @endif</td>
                                        <td>
                                            @if ($listCustomer->status == 1)
                                                Mới
                                            @elseif ($listCustomer->status == 2)
                                                Đang giao
                                            @elseif ($listCustomer->status == 3)
                                                Đã giao
                                            @else
                                                Hủy đơn hàng
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <a class="btn btn-primary" href="{{ route("listcustomer") }}">Quay lại</a>
                        <div class="d-flex justify-content-center">
                            {{ $listCustomers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
