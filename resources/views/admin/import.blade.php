@extends('layout.index')
@section('title', 'Trang danh sách khách hàng')

@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Danh sách khách hàng</li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <form action="" method="post" id="import_csv" enctype="multipart/form-data">
                @csrf
                <label for="">Nhập dữ liệu từ file excel vào hệ thống</label>
                <input type="file" accept=".csv,.xls,.xlsx" name="file" id="file_csv">

                <button type="submit" class="btn btn-primary">Nhập</button>
            </form>
            @if(isset($data))
{{--                @dd($data)--}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tablesorter">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Họ và tên</th>
                            <th>Tên đăng nhập</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Nghề nghiệp</th>
                            <th>Công ty</th>
                            <th>Ngày đăng ký</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $index => $dt)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><input type="text" value="{{ $dt['username'] }}"> </td>
                                <td><input type="text" value="{{ $dt['full_name'] }}"> </td>
                                <td><input type="text" value="{{ $dt['email'] }}"> </td>
                                <td><input type="text" value="{{ $dt['phone'] }}"> </td>
                                <td><input type="text" value="{{ $dt['address'] }}"> </td>
                                <td><input type="text" value="{{ $dt['job'] }}"> </td>
                                <td><input type="text" value="{{ $dt['company'] }}"> </td>
                                <td><input type="text" value="{{ $dt['created_at'] }}"> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
