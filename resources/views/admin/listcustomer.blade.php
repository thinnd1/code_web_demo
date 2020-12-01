@extends('layout.index')
@section('title', 'Trang danh sách khách hàng')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
            @if (session('key'))
                <div class="alert alert-success" role="alert">
                    {{ session('key') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="coL-lg-6 h2">
                            Danh sách khách hàng
                        </div>
                        <div class="coL-lg-6 text-right h2">
                            <a class="btn btn-info" href="{{ route('createcustomer') }}">Thêm khách hàng</a>
                        </div>
                    </div>

                <form action="" method="" enctype="multipart/form-data">
                    @csrf

                    <div class="table-responsive">
                        <div class="row">
                            <form action="">
                                <div class="col-lg-6">
                                    <input type="text" name="search_user" class="form-control" placeholder="Tìm kiếm ..." value="{{ old("search_user") }}" id="inputname">
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </form>
                        </div>

                        <div>
                            <span data-href="{{ route('exportcsvcustomer') }}" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Xuất file csv</span>
                            <form action="{{ route('importcsv') }}" method="post" id="import_csv" enctype="multipart/form-data">
                                @csrf
                                <label for="">Nhập dữ liệu từ file csv vào hệ thống</label>
                                <input type="file" accept=".csv,.xls,.xlsx" name="file" id="file_csv">
                                @error('file')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <button type="submit" class="btn btn-primary">Nhập</button>
                            </form>

                        </div>
                        <h3>Tổng số khách hàng: {{ count($totalcustomer) }}</h3>
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
                                @if(Auth::user()->role == 1)
                                    <th width="10%">Hành động</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($listCustomers) == 0)
                                <tr class="borderless">
                                    <td colspan="10" class="text-center">Không có dữ liệu</td>
                                </tr>
                            @else
                                @foreach ($listCustomers as $index => $listCustomer)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $listCustomer->full_name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $listCustomer->username }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $listCustomer->email }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $listCustomer->phone }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column-15">
                                                {{ $listCustomer->address }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $listCustomer->job }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ $listCustomer->company }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column">
                                                {{ \Carbon\Carbon::parse($listCustomer->created_at)->format('d-m-Y') }}
                                            </div>
                                        </td>
                                        @if(Auth::user()->role == 1)
                                            <div class="divide-column">
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('viewuserorder', ['id' => $listCustomer->id ]) }}">Xem</a>
                                                <a class="btn btn-warning" href="{{ route('vieweditcustomer', ['id' => $listCustomer->id ]) }}">Sửa</a>
                                                <a class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa khách hàng này không?')" href="{{ route('removecustomer', ['id' => $listCustomer->id ]) }}">Xóa</a>
                                            </td>
                                            </div>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $listCustomers->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection

<script>
    $(document).ready(function(){
        $('#import_csv').validate({
            rules: {
                file: {
                    required: true,
                    extension:'csv',
                }
            },
            messages: { file: "Nhập file csv" }
        });
    });

    function exportTasks(_this) {
        confirm('Bạn muốn xuất thành file csv không?');
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
</script>
