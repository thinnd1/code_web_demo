@extends('layout.index')
@section('title', 'Trang danh sách đơn hàng')
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

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <h2 class="col-lg-6 float-left">Danh sách đơn hàng</h2>
                    <div class="col-lg-6 text-right h2">
                        <a href="{{ route('viewcreateorder') }}" class="btn btn-info">Tạo đơn hàng mới</a>
                    </div>
                </div>
                <form action="">
                    @csrf
                    <div class="row">
                        <form action="">
                            <div class="col-lg-6">
                                <input type="text" name="search_order" class="form-control" placeholder="Tìm theo tên, email, số điện thoại ..." value="{{ request()->input('search_order', old('search_order')) }}" id="inputname">
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <span data-href="{{ route('exportcsvorder') }}" id="exportorder" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Xuất file csv</span>
                    </div>
                    <p></p>

                    <div class="table-responsive">
                        <h3>Tổng số đơn hàng: {{ $orders->total() }}</h3>

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
                                    <button type="button" class="btn btn-danger deleteOrder" data-id="{{ $order->id }}">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                </div>
                </form>
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection
@section('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(".deleteOrder").click(function () {
                var id = $(this).data("id");
                var del = confirm("Bạn chắc chắn muốn xóa ?");
                if (del == true) {
                    $.ajax(
                        {
                            url: 'deleteorder/' + id,
                            data: {_token: CSRF_TOKEN, id: id},
                            type: 'post',
                            success: function (response) {
                                location.reload();
                            },
                            error: function (xhr) {
                                console.log(xhr.responseText); // this line will save you tons of hours while debugging
                            }
                        });
                }
            });
        });
    function exportTasks(_this) {
        confirm('Bạn muốn xuất thành file csv không?');
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
    </script>
@endsection
