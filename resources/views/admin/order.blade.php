@extends('layout.index')
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
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
                <div class="row">
                    <h2 class="col-lg-6 float-left">Danh sách đơn hàng</h2>
                    <div class="col-lg-6 text-right h2">
                        <a href="{{ route('viewcreateorder') }}" class="btn btn-info">Tạo đơn hàng mới</a>
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
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th width="10%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders) == 0)
                            <tr class="borderless">
                                <td colspan="11" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @else
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->id_user }}</td>
                                <td>{{ $order->id_product }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>
                                    @if($order->payment == 1)
                                        Tiền mặt
                                    @elseif($order->payment == 2)
                                        Zalo Pay
                                    @else
                                        Credit Card
                                    @endif
                                </td>
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
                                <td>
                                    <a class="btn btn-warning" href="{{ route('editorder', ['id' => $order->id ]) }}">Sửa</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này không?')" href="{{ route('removeorder', ['id' => $order->id ]) }}">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection
