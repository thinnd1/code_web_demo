@extends('layout.index')
@section('title', 'Trang danh sách khách hàng')

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

{{--            @if(isset($errors) && $errors->any())--}}
{{--                <div class="alert alert-danger" role="alert">--}}
{{--                    @foreach($errors->all() as $error)--}}
{{--                        {{ $error }} <br>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 h2">
                            Danh sách khách hàng
                        </div>
                    </div>

                <form action="" method="" enctype="multipart/form-data">
                    @csrf

                    <div class="table-responsive">
                        <p></p>
                        <div class="row">
                            <div class="col-lg-5">
                                <span id="export" class="btn btn-success">Export danh sách khách hàng</span>
                                <a href="{{ route("readexcel") }}" class="btn btn-success">Import từ file excel</a>
                                <a class="btn btn-info" href="{{ route('createcustomer') }}">Thêm khách hàng</a>
                            </div>
                            <div class="col-lg-3 col-lg-offset-3">
                                <form action="">
                                    <div class="col-lg-10">
                                        <input type="text" name="search_user" class="form-control" placeholder="Tìm tên , email, số điện thoại ..." value="{{  request()->input('search_user', old('search_user')) }}" id="inputname">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="h2">

                        </div>
                        <h4>Tổng số khách hàng: {{ $listCustomers->total() }}</h4>
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
                                        <td><a href="{{ route('viewuserorder', ['id' => $listCustomer->id ]) }}"> {{ $index + 1 }}</a></td>
                                        <td>
                                            <div class="divide-column">
                                                <a href="{{ route('viewuserorder', ['id' => $listCustomer->id ]) }}"> {{ $listCustomer->full_name }} </a>
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
                                                <a class="btn btn-warning" href="{{ route('vieweditcustomer', ['id' => $listCustomer->id ]) }}">Sửa</a>
                                                <button type="button" class="btn btn-danger deleteRecord" data-id="{{ $listCustomer->id }}">Xóa</button>
                                            </td>
                                            </div>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            @if ($listCustomers->hasPages())

                                {{ $listCustomers->links() }}
                            @else
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item active">
                                            <a href="" class="page-link">1</a>
                                        </li>
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection
@section('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $(".deleteRecord").click(function(){
                var id = $(this).data("id");
                var del = confirm("Bạn chắc chắn muốn xóa ?");
                if (del == true){
                    $.ajax(
                        {
                            url: encodeURI('delete/'+id),
                            data: {_token: CSRF_TOKEN,id: id},
                            type: 'post',
                            success: function(response){
                                location.reload();
                            },
                            error: function(xhr) {
                                console.log("12345678");
                                console.log(xhr.responseText); // this line will save you tons of hours while debugging
                            }
                        });
                }
            });
        });
        $("#export").click(function(){
            var ep = confirm("Bạn muốn tải file về máy?");
            if (ep == true)
            {
                window.location.href = "{{ route('fileexport', ['search_user' => $search])}}";
            }
        });

    </script>
@endsection

