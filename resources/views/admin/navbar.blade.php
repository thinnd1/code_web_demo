<div id="wrapper">
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i> Thông tin cá nhân </a></li>
                <li><a href=""><i class="fa fa-dashboard"></i> Quản lý tài khoản </a></li>
                <li><a href="{{ route('listcustomer')}}"><i class="fa fa-dashboard"></i> Quản lý khách hàng </a></li>
                <li><a href="{{ route('product')}}"><i class="fa fa-dashboard"></i> Quản lý sản phẩm </a></li>
                <li><a href="{{ route('order')}}"><i class="fa fa-bar-chart-o"></i> Quản lý đơn hàng </a></li>
                <li><a href="{{ route('shop') }}"><i class="fa fa-bar-chart-o"></i> Quản lý Công ty </a></li>
                <li><a href="{{ route('logout') }}" onclick="return confirm('Bạn chắc chắn muốn đăng xuất ?')"><i class="fa fa-table"></i> Đăng xuất </a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</div>
