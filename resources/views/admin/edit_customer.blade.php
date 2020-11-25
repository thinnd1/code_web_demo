@extends('layout.index')
@section('content')

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
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
                        <label for="inputname" class="col-sm-2 col-form-label">Họ và tên*</label>
                        <div class="col-sm-10">
                            <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" id="inputname">
                            @error('full_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputusername" class="col-sm-2 col-form-label">Tên đăng nhập*</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" id="inputusername">
                            @error('username')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputemail" class="col-sm-2 col-form-label">Email*</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" id="inputemail">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputphone" class="col-sm-2 col-form-label">Số điện thoại*</label>
                        <div class="col-sm-10">
                            <input type="number" name="phone" class="form-control" value="{{ $user->phone }}" id="inputphone">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputage" class="col-sm-2 col-form-label">Tuổi</label>
                        <div class="col-sm-10">
                            <input type="number" name="age" class="form-control" value="{{ $user->age }}" id="inputage">
                            @error('age')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giới tính</label>
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
                        <label for="inputaddress" class="col-sm-2 col-form-label">Địa chỉ*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="inputaddress" aria-label="With textarea">{{ $user->address }}"</textarea>
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputjob" class="col-sm-2 col-form-label">Nghề nghiệp</label>
                        <div class="col-sm-10">
                            <input type="text" name="job" class="form-control" value="{{ $user->job }}" id="inputjob">
                            @error('job')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputcompany" class="col-sm-2 col-form-label">Công ty</label>
                        <div class="col-sm-10">
                            <input type="text" name="company" class="form-control" value="" id="inputcompany">
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
