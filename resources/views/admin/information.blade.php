@extends('layout.index')
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i>Thông tin tài khoản</li>
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
                <div class="form-group row">
                    <label for="inputUser" class="col-sm-2 col-form-label">Tên Đăng Nhập</label>
                    <div class="col-sm-10">
                        {{ $user->username }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputUser" class="col-sm-2 col-form-label">Họ và tên</label>
                    <div class="col-sm-10">
                        {{ $user->full_name }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputUser" class="col-sm-2 col-form-label">Ngày sinh</label>
                    <div class="col-sm-10">
                        {{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputUser" class="col-sm-2 col-form-label">Giới tính</label>
                    <div class="col-sm-10">
                        @if($user->gender == 1)
                            Nam
                        @else
                           Nữ
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputUser" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputUser" class="col-sm-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-10">
                        {{ $user->phone }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputUser" class="col-sm-2 col-form-label">Địa chỉ</label>
                    <div class="col-sm-10">
                        {{ $user->address }}
                    </div>
                </div>

                <a class="btn btn-warning" href="{{ route('geteditinfor') }}">Sửa</a>
            </div>
        </div>
    </div>
</div>
@endsection
