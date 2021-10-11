<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Admin</li>
            <li><a href="/dashboard"><i class="fa fa-home nav-icon"></i><span class="nav-text">Dashboard</span></a>
            </li>
            <li><a href="{{ route('user.index') }}"> <i class="fa fa-users nav-icon"></i><span class="nav-text">User</span></a>
            </li>
        </ul>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Kasir</li>
            <li><a><i class="fa fa-shopping-cart nav-icon"></i><span class="nav-text">Pesanan</span></a>
            </li>
        </ul>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Produk</li>
            <li><a href="{{ route('category.index') }}"><i class="nav-icon fa fa-list"></i><span class="nav-text">Kategori</span></a></li>
            <li><a><i class="nav-icon fa fa-product-hunt"></i><span class="nav-text">Input Produk</span></a></li>
        </ul>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Pelaporan</li>
            <li><a><i class="nav-icon fa fa-calculator"></i><span class="nav-text">Total Pendapatan</span></a></li>
        </ul>
    </div>
</div>
