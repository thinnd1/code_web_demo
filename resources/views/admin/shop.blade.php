@extends('layout.index')
@section('content')

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12sdf">
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-dashboard"></i> Quản lý shop</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tablesorter">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên công ty</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Số hàng đã mua</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($shops) == 0)
                            <tr class="borderless">
                                <td colspan="7" class="text-center">Not data</td>
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
{{--                                    <td>{{ $shop->id }}</td>--}}
                                    <td>
                                        <a href="{{ route('deleteshop', ['id' => $shop->id ]) }}" class="btn btn-danger">Sửa</a>
                                        <a href="{{ route('deleteshop', ['id' => $shop->id ]) }}" class="btn btn-danger">Xóa</a>
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
