@extends('layout.index')
@section('content')

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12sdf">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Cập nhật thông tin khách hàng </li>
                </ol>
            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-9">
                <form action="{{ route('editcustomer', ['id' => $user->id]) }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputUser" class="col-sm-2 col-form-label">Tên Đăng Nhập*</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" id="inputUser">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputFullName" class="col-sm-2 col-form-label">Họ Và Tên*</label>
                        <div class="col-sm-10">
                            <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" id="inputFullName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputGender" class="col-sm-2 col-form-label">Giới tính*</label>
                        <div class="col-sm-10">
                            <select name="gender" class="form-control">
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                                <option value="3">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email*</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="inputEmail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAge" class="col-sm-2 col-form-label">Age*</label>
                        <div class="col-sm-10">
                            <input type="number" name="age" value="{{ $user->age }}" class="form-control" id="inputAge">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Phone*</label>
                        <div class="col-sm-10">
                            <input type="number" name="phone" class="form-control" value="{{ $user->email }}" id="inputPhone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address*</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" value="{{ $user->address }}" id="inputAddress">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputJob" class="col-sm-2 col-form-label">Job*</label>
                        <div class="col-sm-10">
                            <input type="text" name="job" class="form-control" value="{{ $user->job }}" id="inputJob">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputCompany" class="col-sm-2 col-form-label">Company*</label>
                        <div class="col-sm-10">
                            <input type="text" name="company" class="form-control" value="{{ $user->company }}" id="inputCompany">
                        </div>
                    </div>

                    <a class="btn btn-primary" href="{{ URL::previous() }}">Go Back</a>
                    <button type="submit" class="btn btn-warning">Cập nhật thông tin</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
