@extends('layout.index')
@section('title', 'Trang danh sách người dùng')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Danh sách người dùng</li>
                    </ol>
                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="coL-lg-6 h2">
                            Danh sách tài khoản
                        </div>
                        <div class="coL-lg-6 text-right h2">
                            <a class="btn btn-info" href="">Thêm người dùng</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <h3>Tổng số tài khoản: </h3>
                        <table class="table table-bordered table-hover tablesorter">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Họ và tên</th>
                                <th>Tên đăng nhập</th>
                                <th>Quyền</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Nghề nghiệp</th>
                                <th>Công ty</th>
                                <th>Ngày đăng ký</th>
                                @if(Auth::user()->role == 1)
                                    <th width="10%">Hành động</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) == 0)
                                <tr class="borderless">
                                    <td colspan="10" class="text-center">Không có dữ liệu</td>
                                </tr>
                            @else
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $user->full_name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $user->username }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                @if($user->role == 1)
                                                    Admin
                                                @else
                                                    Người dùng
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $user->email }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $user->phone }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column-15">
                                                {{ $user->address }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $user->job }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $user->company }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
                                            </div>
                                        </td>
                                        @if(Auth::user()->role == 1)
                                            <div class="divide-column">
                                                <td>
                                                    <a class="btn btn-warning"
                                                       href="{{ route('edituser', ['id' => $user->id ]) }}">Sửa</a>
                                                    <a class="btn btn-danger"
                                                       onclick="return confirm('Bạn chắc chắn muốn xóa khách hàng này không?')"
                                                       href="{{ route('deleteuser', ['id' => $user->id ]) }}">Xóa</a>
                                                </td>
                                            </div>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div>
    </div>
@endsection

<script>

</script>
