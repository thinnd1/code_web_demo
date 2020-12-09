<table>
    <thead>
    <tr>
        <th>Tên đăng nhập</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Nghề nghiệp</th>
        <th>Công ty</th>
        <th>Ngày đăng ký</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->username }}</td>
            <td>{{ $customer->full_name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->job }}</td>
            <td>{{ $customer->company }}</td>
            <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('d-m-Y')  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
