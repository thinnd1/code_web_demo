@extends('layout.index')
@section('title', 'Trang danh sách khách hàng')

@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Nhập dữ liệu vào hệ thống </li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <div class="table-responsive">
                <h3>Tổng số bản ghi là : {{ count($listExcel) }}</h3>

                <form action="{{ route("importexcelcustomer", ['id' => $id_file]) }}" method="post">
                    @csrf
                    <input type="hidden" name="id_file" value="{{ $id_file }}">
                    <table class="table table-bordered table-hover tablesorter">
                        <thead>
                        <tr>
                            <th width="5%"></th>
                            <th width="15%">Trạng thái</th>
                            <th>Họ và tên</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th width="10%">Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Nghề nghiệp</th>
                            <th>Công ty</th>
                            <th>Ngày đăng ký</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listExcels as $index => $list)
                            {{--                        @dump($list)--}}
                            <tr>
                                <td>
                                    <button data-id="{{ $list->id }}" class="btn btn-danger deleteRecordExcel">Xóa</button>
                                </td>
                                <td>
                                    @if($list->statusemail == 1 && $list->statusphone == 1 && $list->statususers == 1)
                                        <p class="text-danger">Trường users, email, số điện thoại trùng</p>
                                    @elseif($list->statususers == 1 && $list->statusemail == '' && $list->statusphone == '')
                                        <p class="text-danger">Trường username trùng, số điện thoại, mail trống</p>
                                    @elseif($list->statususers == 1 && $list->statusemail == 1 && $list->statusphone == '')
                                        <p class="text-danger">Trường username trùng, email trùng, số điện thoại trống</p>
                                    @elseif($list->statususers == '' && $list->statusemail == 1 && $list->statusphone == 1)
                                        <p class="text-danger">Trường username trống, email trùng, số điện thoại trùng</p>
                                    @elseif($list->statususers == '' && $list->statusemail == '' && $list->statusphone == 1)
                                        <p class="text-danger">Trường username trống, email trống, số điện thoại trùng</p>
                                    @else
                                        <p class="text-primary">Mới</p>
                                    @endif
                                </td>

                                <td> {{ $list['full_name'] }} </td>
                                <td> {{ $list['username'] }} </td>
                                <td> {{ $list['email'] }} </td>
                                <td> {{ $list['phone'] }} </td>
                                <td> {{ $list['address'] }} </td>
                                <td> {{ $list['job'] }} </td>
                                <td> {{ $list['company'] }} </td>
                                <td> {{ $list['created_at'] }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
{{--                    <a href="{{ route("importexcelcustomer") }}" class="btn btn-warning" >Thực hiện Import</a>--}}
                    <button type="submit" class="btn btn-warning">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $(".deleteRecordExcel").click(function(){
                var id = $(this).data("id");
                console.log("id cua user", id);
                console.log("cua CSRF_TOKEN", CSRF_TOKEN);
                var del = confirm("Bạn chắc chắn muốn xóa ?");
                if (del == true){
                    $.ajax(
                        {
                            url: 'deleterecordexcel/'+id,
                            data: {_token: CSRF_TOKEN, id: id},
                            type: 'post',
                            success: function(response){
                                location.reload();
                                console.log("123");
                            },
                            error: function(xhr) {
                                console.log("12345678");
                                console.log(xhr.responseText); // this line will save you tons of hours while debugging
                            }
                        });
                }
            });
        });
    </script>
@endsection

