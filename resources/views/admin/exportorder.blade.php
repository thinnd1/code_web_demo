<table>
    <thead>
    <tr>
        <th>Họ và tên</th>
        <th>Sản phẩm</th>
        <th>Tổng giá</th>
        <th>Địa chỉ</th>
        <th>Ngày đặt</th>
        <th>Số điện thoại</th>
        <th>Email</th>
        <th>Hình thức thanh toán</th>
        <th>Ngày đăng ký</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id_user }}</td>
            <td>{{ $order->id_product }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->orderdate }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->email }}</td>
            <td>
                @if($order->payment == 1)
                    Tiền mặt
                @elseif($order->payment == 2)
                    Zalo pay
                @else
                    Khác
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y')  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
