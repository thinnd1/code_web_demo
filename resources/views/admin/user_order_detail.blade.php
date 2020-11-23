@extends('layout.index')
@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12sdf">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Danh sách order theo cá nhân</li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($listCustomers as $listCustomer)
                        <h2>{{ $listCustomer->username }}</h2>
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
                                    <th>Phone</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($listCustomer['order']) == 0)
                                    <tr class="borderless">
                                        <td colspan="10" class="text-center">Not data</td>
                                    </tr>
                                @else
                                    @foreach ($listCustomer->order as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>Thin Nguyen</td>
                                            <td>Iphone X</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->payment }}</td>
                                            <td>
                                                @if ($order->status == 1)
                                                    Mới
                                                @elseif ($order->status == 2)
                                                    Đang giao
                                                @elseif ($order->status == 3)
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
