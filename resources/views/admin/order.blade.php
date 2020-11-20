@extends('layout.index')
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12sdf">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Quản lý đơn hàng </li>
                </ol>
            </div>
        </div><!-- /.row -->
        @if (session('key'))
            <div class="alert alert-success" role="alert">
                {{ session('key') }}
            </div>
        @endif
{{--        @dd($orders)--}}

        <div class="row">
            <div class="col-lg-12">
                <h2>Danh sách order</h2>
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
                        @foreach ($orders as $index => $order)
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection
