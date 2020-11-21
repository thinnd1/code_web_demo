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
                <h2>Danh sách Công ty</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tablesorter">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Công ty</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Số hàng đã mua</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$shops)
                            not data
                        @else
                            @foreach ($shops as $index => $shop)
                                <tr>
                                    <td>{{ $index+ 1 }}</td>
                                    <td>{{ $shop->name_shop }}</td>
                                    <td>{{ $shop->mail }}</td>
                                    <td>{{ $shop->phone }}</td>
                                    <td>{{ $shop->address }}</td>
                                    <td>{{ $shop->quantity_product }}</td>
{{--                                    <td>{{ $shop->id }}</td>--}}
                                    <td>
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
