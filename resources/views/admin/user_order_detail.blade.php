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
                            <p>Tổng đơn hàng : {{count($listCustomers)}}</p>
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
                                        <td>{{ $listCustomer->payment }}</td>
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
                        <div class="d-flex justify-content-center">
                            {{ $listCustomers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
