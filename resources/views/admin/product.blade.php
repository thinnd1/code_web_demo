@extends('layout.index')
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12sdf">
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Danh sách sản phẩm</li>
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
                        <h2 class="col-lg-6 float-left">Danh sách sản phẩm</h2>
                        <div class="col-lg-6" style="padding-top: 21px; padding-left: 585px;">
                            <a href="{{ route('viewcreateproduct') }}" class="btn btn-info">Tạo mới</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover tablesorter">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Sản phẩm</th>
                                <th width="50%">Miêu tả</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Đánh giá</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @if (!$products)
                                    <td rowspan="9"> not data</td>
                                @else
                                @foreach ($products as $index =>$product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->vote }}</td>
                                        <td>
                                            <a class="btn btn-danger"
                                               href="{{ route('deleteproduct', ['id' => $product->id ]) }}">Xóa</a>
                                            <a class="btn btn-warning"
                                               href="{{ route('vieweditproduct', ['id' => $product->id ]) }}">Sửa</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tr></tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div><!-- /.row -->
        </div>
    </div>
@endsection
