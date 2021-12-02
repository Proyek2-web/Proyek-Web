<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first text-white" style="font-weight: bold">Admin</li>
            <li><a href="/dashboard"><i class="fa fa-home nav-icon"></i><span class="nav-text">Dashboard</span></a>
            </li>
            <li><a href="{{ route('user.index') }}"> <i class="fa fa-users nav-icon"></i><span
                        class="nav-text">User</span></a>
            </li>
        </ul>
        <ul class="metismenu" id="menu">
            <li class="nav-label first text-white"  style="font-weight: bold">Order</li>
            <li><a href="{{ route('order.index') }}"><i class="fa fa-shopping-cart nav-icon"></i><span class="nav-text">Pesanan</span></a>
            </li>
        </ul>
        <ul class="metismenu" id="menu">
            <li class="nav-label first text-white" style="font-weight: bold">Produk</li>
            <li><a href="{{ route('category.index') }}"><i class="nav-icon fa fa-list"></i><span
                        class="nav-text">Kategori</span></a></li>
            <li><a href="{{ route('product.index') }}"><i class="nav-icon fa fa-product-hunt"></i><span
                        class="nav-text">Input Produk</span></a></li>
        </ul>
        <ul class="metismenu" id="menu">
            <li class="nav-label first text-white"  style="font-weight: bold">Riwayat</li>
            <li><a href="{{ route('report.index') }}"><i class="nav-icon fa fa-calculator"></i><span class="nav-text">Riwayat Transaksi</span></a></li>
        </ul>
    </div>
</div>
