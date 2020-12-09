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
                <h3>Tổng số bản ghi là : {{ count($totalListExcel) }}</h3>

                <table class="table table-bordered table-hover tablesorter">
                    <thead>
                    <tr>
                        <th width="5%"></th>
                        <th width="30%">Trạng thái</th>
                        <th>Email</th>
                        <th width="15%">Số điện thoại</th>
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
                                @if($list->email == '' && $list->phone == '')
                                    <p class="text-danger">Trường email trống và Trường số điện thoại trống</p>
                                @elseif($list->phone == '' && $list->status == 1)
                                    <p class="text-danger">Trường số điện thoại trống và Trùng mail</p>
                                @elseif($list->statusphone == 1 && $list->email == '')
                                    <p class="text-danger">Trùng số điện thoại và Trường mail trống</p>
                                @elseif($list->phone == '')
                                    <p class="text-danger">Trường số điện thoại trống</p>
                                @elseif($list->email == '')
                                    <p class="text-danger">Trường mail trống</p>
                                @elseif($list->status == 1 && $list->statusphone == 1)
                                    <p class="text-danger">Trùng số điện thoại và Trùng mail</p>
                                @elseif($list->status == 1)
                                    <p class="text-danger">Trùng mail</p>
                                @elseif($list->statusphone == 1)
                                    <p class="text-danger">Trùng số điện thoại</p>
                                @else
                                    <p class="text-primary">Mới</p>
                                @endif
                            </td>

                            <td>{{ $list->email }}</td>
                            <td>{{ $list->phone }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <a href="{{ route("importexcelcustomer") }}" class="btn btn-primary" >Thực hiện Import</a>
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

