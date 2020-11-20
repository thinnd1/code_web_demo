@extends('layout.index')
@section('content')

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12sdf">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Danh sach khach hang</li>
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
                <h2>Danh sách tài khoản</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tablesorter">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Họ và tên</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Job</th>
                            <th>Company</th>
                            <th>Ngày đăng ký</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$listCustomers)
                            not data
                        @else
                            @foreach ($listCustomers as $index => $listCustomer)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $listCustomer->full_name }}</td>
                                    <td>{{ $listCustomer->username }}</td>
                                    <td>{{ $listCustomer->email }}</td>
                                    <td>{{ $listCustomer->phone }}</td>
                                    <td>{{ $listCustomer->address }}</td>
                                    <td>{{ $listCustomer->job }}</td>
                                    <td>{{ $listCustomer->company }}</td>
                                    <td>{{ \Carbon\Carbon::parse($listCustomer->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <a class="btn btn-danger"
                                           href="{{ route('removecustomer', ['id' => $listCustomer->id ]) }}">Xóa</a>
                                        <a class="btn btn-warning" href="">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa không ??
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{ route('removecustomer', ['id' => $listCustomer->id ]) }}"
                                       data-dismiss="modal" class="btn btn-primary">Xoa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection
