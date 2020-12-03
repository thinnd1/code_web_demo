@extends('layout.index')
@section('title', 'Cập nhật thông tin người dùng')
@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Cập nhật thông tin người dùng </li>
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

            <div class="row">
                <div class="col-lg-9">
                    <form action="{{ route('updateuser', ['id' => $userDetail->id]) }}" method="post">
                        @csrf
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
                        <div class="form-group row">
                            <label for="inputname" class="col-sm-2 col-form-label">Họ và tên*</label>
                            <div class="col-sm-10">
                                <input type="text" name="full_name" class="form-control" value="{{ old("full_name") ?? $userDetail->full_name }}" id="inputname">
                                @error('full_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputusername" class="col-sm-2 col-form-label">Tên đăng nhập*</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" value="{{ old("username") ?? $userDetail->username }}" id="inputusername">
                                @error('username')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputemail" class="col-sm-2 col-form-label">Email*</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="{{ old("email") ?? $userDetail->email }}" id="inputemail">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputphone" class="col-sm-2 col-form-label">Số điện thoại*</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" value="{{ old("phone") ?? $userDetail->phone }}" id="inputphone">
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phân quyền</label>
                            <div class="col-sm-10">
                                <select name="role" class="form-control">
                                    <option value="1" {{ old("role") ?? $userDetail->role == 1 ? 'selected' : '' }}>Quản trị</option>
                                    <option value="2" {{ old("role") ?? $userDetail->role == 2 ? 'selected' : '' }}>Người dùng</option>
                                </select>
                                @error('gender')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputage" class="col-sm-2 col-form-label">Tuổi*</label>
                            <div class="col-sm-10">
                                <input type="number" name="age" class="form-control" value="{{ old("age") ?? $userDetail->age }}" id="inputage">
                                @error('age')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Giới tính</label>
                            <div class="col-sm-10">
                                <select name="gender" class="form-control">
                                    <option value="1" {{ old("gender") ?? $userDetail->gender == 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="2" {{ old("gender") ?? $userDetail->gender == 2 ? 'selected' : '' }}>Nữ</option>
                                    <option value="3" {{ old("gender") ?? $userDetail->gender == 3 ? 'selected' : '' }}>Khác</option>
                                </select>
                                @error('gender')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-2 col-form-label">Địa chỉ*</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address" id="inputaddress" aria-label="With textarea">{{ old("address") ?? $userDetail->address }}"</textarea>
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputjob" class="col-sm-2 col-form-label">Nghề nghiệp</label>
                            <div class="col-sm-10">
                                <input type="text" name="job" class="form-control" value="{{ old("job") ?? $userDetail->job }}" id="inputjob">
                                @error('job')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputcompany" class="col-sm-2 col-form-label">Công ty</label>
                            <div class="col-sm-10">
                                <input type="text" name="company" class="form-control" value="{{ old("company") ?? $userDetail->company }}" id="inputcompany">
                                @error('company')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <a class="btn btn-primary" href="{{ route("getlistuser") }}">Quay lại</a>
                        <button type="submit" class="btn btn-warning">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
