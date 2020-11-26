@extends('layout.index')
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Cập nhật thông tin tài khoản</li>
                </ol>
            </div>
        </div><!-- /.row -->
        @if (session('key'))
            <div class="alert alert-success" role="alert">
                {{ session('key') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-9">
                <form action="{{ route('editinfor') }}" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="inputUser" class="col-sm-2 col-form-label">Tên Đăng Nhập*</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" id="inputUser">
                            @error('username')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputFullName" class="col-sm-2 col-form-label">Họ Và Tên*</label>
                        <div class="col-sm-10">
                            <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" id="inputFullName">
                            @error('full_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputGender" class="col-sm-2 col-form-label">Giới tính*</label>
                        <div class="col-sm-10">
                            <select name="gender" class="form-control">
                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nam</option>
                                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Nữ</option>
                                <option value="3" {{ $user->gender == 3 ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('gender')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email*</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="inputEmail">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
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
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" id="inputPhone">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="inputaddress" aria-label="With textarea">{ $user->address }}</textarea>
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputJob" class="col-sm-2 col-form-label">Job</label>
                        <div class="col-sm-10">
                            <input type="text" name="job" class="form-control" value="{{ $user->job }}" id="inputJob">
                            @error('job')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputCompany" class="col-sm-2 col-form-label">Company</label>
                        <div class="col-sm-10">
                            <input type="text" name="company" class="form-control" value="{{ $user->company }}" id="inputCompany">
                            @error('company')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <a class="btn btn-primary" href="{{ URL::previous() }}">Quay lại</a>
                    <button type="submit" class="btn btn-warning">Cập nhật thông tin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
