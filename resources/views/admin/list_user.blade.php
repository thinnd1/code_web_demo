@extends('layout.index')
@section('title', 'Trang danh sách tài khoản')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Danh sách tài khoản</li>
                    </ol>
                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="coL-lg-6 h2">
                            Danh sách tài khoản
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div class="row">
                            <form action="" >
                                <div class="col-lg-6">
                                    <input type="text" name="search_account" class="form-control" placeholder="Tìm theo tên, email, số điện thoại ..." value="{{ request()->input('search_user', old('search_user')) }}" id="inputname">
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </form>
                        </div>

                        <h3>Tổng số tài khoản: {{ $users->total() }} </h3>
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
                                    <td colspan="11" class="text-center">Không có dữ liệu</td>
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
                                                    <button type="button" class="btn btn-danger deleteuser" data-id="{{ $user->id }}">Xóa</button>
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
@section('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $(".deleteuser").click(function(){
                var id = $(this).data("id");
                $.ajax(
                    {
                        url: 'deleteuser/'+id,
                        data: {_token: CSRF_TOKEN,id: id},
                        type: 'post',
                        success: function(response){
                            location.reload();
                        },
                        error: function(xhr) {
                            console.log("2323");
                            console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        }
                    });
            });
        });
    </script>
@endsection
