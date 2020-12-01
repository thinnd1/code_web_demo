@extends('layout.index')
@section('title', 'Trang danh sách sản phẩm')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@section('content')
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
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
                        <div class="col-lg-6 text-right h2">
                            <a href="{{ route('viewcreateproduct') }}" class="btn btn-info">Tạo sản phẩm mới</a>
                        </div>
                    </div>

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
                        <p></p>

                        <table class="table table-bordered table-hover tablesorter">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Sản phẩm</th>
                                <th width="50%">Miêu tả</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Đánh giá</th>
                                <th width="10%">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @if (count($products) == 0)
                                    <tr class="borderless">
                                        <td colspan="7" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @else
                                @foreach ($products as $index =>$product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="divide-column-7">
                                                {{ $product->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column-description">
                                                {{ $product->description }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column-7">
                                                {{ $product->quantity }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column-7">
                                                {{ $product->price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column-7">
                                                {{ $product->vote }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="divide-column-7">
                                                <a class="btn btn-warning"
                                                   href="{{ route('vieweditproduct', ['id' => $product->id ]) }}">Sửa</a>

                                                <a class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này không?')"
                                                   href="{{ route('deleteproduct', ['id' => $product->id ])  }}">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tr></tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div>
    </div>
@endsection
