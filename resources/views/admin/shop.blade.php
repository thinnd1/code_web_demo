@extends('layout.index')
@section('title', 'Trang danh sách công ty')
@section('content')

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Quản lý công ty</li>
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

                <div class="row">
                    <div class="col-lg-6 h2">
                        Danh sách công ty
                    </div>
                    <div class="col-lg-6 text-right h2">
                        <a class="btn btn-info" href="{{ route('viewcreatecompany') }}">Thêm công ty</a>
                    </div>
                </div>
                <div class="row">
                    <form action="">
                        <div class="col-lg-6">
                            <input type="text" name="search_company" class="form-control" placeholder="Tìm kiếm ..." value="{{ request()->input('search_company', old('search_company')) }}" id="inputname">
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
                <p></p>
                <div class="table-responsive">
                    <h3>Tổng số công ty: {{ count($totalshops) }}</h3>

                    <table class="table table-bordered table-hover tablesorter">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên công ty</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Số lượng mua</th>
                            <th width="10%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($shops) == 0)
                            <tr class="borderless">
                                <td colspan="7" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @else
                            @foreach ($shops as $index => $shop)
                                <tr>
                                    <td>{{ $index+ 1 }}</td>
                                    <td>{{ $shop->name_shop }}</td>
                                    <td>{{ $shop->email }}</td>
                                    <td>{{ $shop->phone }}</td>
                                    <td>{{ $shop->address }}</td>
                                    <td>{{ $shop->quantity_product }}</td>
                                    <td>
                                        <a href="{{ route('editcompany', ['id' => $shop->id ]) }}" class="btn btn-warning">Sửa</a>
                                        <button type="button" class="btn btn-danger delete-company" data-id="{{ $shop->id }}">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $shops->links() }}
                </div>
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection

@section('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $(".delete-company").click(function(){
                var id = $(this).data("id");
                var del = confirm("Bạn chắc chắn muốn xóa ?");
                if (del == true) {
                    $.ajax(
                        {
                            url: 'deletecompany/'+id,
                            data: {_token: CSRF_TOKEN,id: id},
                            type: 'post',
                            success: function(response){
                                location.reload();
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText); // this line will save you tons of hours while debugging
                            }
                        });
                }
            });
        });
    </script>
@endsection
