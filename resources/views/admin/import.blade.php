@extends('layout.index')
@section('title', 'Trang danh sách khách hàng')

@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Nhập dữ liệu vào hệ thống</li>
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

            <form action="" method="post" id="import_csv" enctype="multipart/form-data">
                @csrf
                <label for="">Nhập dữ liệu từ file excel vào hệ thống</label>
                <input type="file" accept=".csv,.xls,.xlsx" name="file" id="file_csv">
                @error('file')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <p></p>
                <a href="{{ asset('uploads/customers-format.xlsx') }}" class="btn btn-primary">Form mẫu</a>
                <button type="submit" class="btn btn-primary">Nhập</button>
                <a href="{{ route("listcustomer") }}" class="btn btn-warning">Quay lại</a>
            </form>

            <form action="" method="post">
                @csrf
                @if(isset($data))
                    {{--                @dd($data)--}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover tablesorter">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th width="10%">Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Nghề nghiệp</th>
                                <th>Công ty</th>
                                <th>Ngày đăng ký</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $dt)
                                <tr>
                                    <td> {{ $index + 1 }} </td>
                                    <td> {{ $dt['full_name'] }} </td>
                                    <td> {{ $dt['email'] }} </td>
                                    <td> {{ $dt['phone'] }} </td>
                                    <td> {{ $dt['address'] }} </td>
                                    <td> {{ $dt['job'] }} </td>
                                    <td> {{ $dt['company'] }} </td>
                                    <td> {{ $dt['created_at'] }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route("viewcheck") }}" type="submit" class="btn btn-primary">Check Trùng</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
