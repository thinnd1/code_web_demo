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

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div cl   ass="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
         @endif

            <div class="table-responsive">
                <h3>Tổng số bản ghi là : {{ $listExcel->total() }}</h3>
                    <input type="hidden" name="id_file" class="js_id_file" value="{{ @$id_file }}">
                    <table class="table table-bordered table-hover tablesorter">
                        <thead>
                        <tr>
                            <th width="5%"></th>
                            <th width="5%">STT</th>
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
                        @dump($listExcels)
                        @foreach($listExcels as $index => $list)
                            <tr>
                                <td>
                                    <button data-id="{{ @$list['id'] }}" class="btn btn-danger deleteRecordExcel" >Xóa</button>
                                </td>
                                <td>{{ $index+1 }}</td>

                                <td> {{ @$list['full_name'] }} </td>
                                <td> {{ @$list['username'] }} </td>
                                <td> {{ @$list['email'] }} </td>
                                <td> {{ @$list['phone'] }} </td>
                                <td> {{ @$list['address'] }} </td>
                                <td> {{ @$list['job'] }} </td>
                                <td> {{ @$list['company'] }} </td>
                                <td> {{ @$list['created_at'] }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $listExcel->links() }}
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
                    <button data-id="{{ @$id_file }}" class="btn btn-warning import">Thực hiện import</button>
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
                            },
                            error: function(xhr) {
                                console.log("12345678");
                                console.log(xhr.responseText); // this line will save you tons of hours while debugging
                            }
                        });
                }
            });
            $(".import").click(function(){
                var id = $(this).data("id");
                console.log("CSRF_TOKEN :::", CSRF_TOKEN);
                console.log("id cua user", id);
                $.ajax(
                    {
                        url: 'importexcelcustomer/'+id,
                        data: {_token: CSRF_TOKEN, id: id},
                        type: 'post',
                        success: function(response){
                            // location.reload();
                            alert("Bạn đã import file thành công");
                            window.location = 'listcustomer';
                            // console.log((response));
                            // if (response.length == 1){
                            //     window.location =  'listcustomer';
                            // } else {
                            //     window.location = 'listcustomer';
                            // }
                        },
                        error: function(xhr) {
                            console.log("12345678");
                            console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        }
                    });
            });
        });

    </script>
@endsection

