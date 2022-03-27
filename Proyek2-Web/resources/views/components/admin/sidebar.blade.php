<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/dashboard"><img src="/images/logo1.png" alt="Logo" srcset=""
                            style="width: 240px; height: 100px;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  {{ request()->is('dashboard') ? 'active' : '' }} ">
                    <a href="/dashboard" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-title ">User</li>
                <li class="sidebar-item {{ Route::is('user.index') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Daftar User</span>
                    </a>
                </li>
                <li class="sidebar-title ">Pesanan</li>
                <li class="sidebar-item {{ Route::is('order.index') ? 'active' : '' }}">
                    <a href="{{ route('order.index') }}" class='sidebar-link'>
                        <i class="bi bi-wallet2"></i>
                        <span>Belum Dibayar</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('order.index') ? 'active' : '' }}">
                    <form action="{{ route('order.index') }}" method="GET" >
                        <input type="hidden" name="paid" value="paid">
                        <button type="submit" style="background-color: transparent;
                            background-repeat: no-repeat;
                            border: none;
                            cursor: pointer;
                            overflow: hidden;
                            outline: none;" class='sidebar-link'>
                            <i class="bi bi-box-seam"></i>
                            <span>Perlu Diproses</span>
                        </button>
                    </form>
                </li>
                <li class="sidebar-item {{ Route::is('order.index') ? 'active' : '' }}">
                    <form action="{{ route('order.index') }}" method="GET" >
                        <input type="hidden" name="send" value="send">
                        <button type="submit" style="background-color: transparent;
                            background-repeat: no-repeat;
                            border: none;
                            cursor: pointer;
                            overflow: hidden;
                            outline: none;" class='sidebar-link'>
                            <i class="bi bi-truck"></i>
                            <span>Perlu Dikirim</span>
                        </button>
                    </form>
                </li>
                <li class="sidebar-item {{ Route::is('order.index') ? 'active' : '' }}">
                    <form action="{{ route('order.index') }}" method="GET" >
                        <input type="hidden" name="receive" value="receive">
                        <button type="submit" style="background-color: transparent;
                            background-repeat: no-repeat;
                            border: none;
                            cursor: pointer;
                            overflow: hidden;
                            outline: none;" class='sidebar-link'>
                            <i class="bi bi-check2-circle"></i>
                            <span>Pesanan Selesai</span>
                        </button>
                    </form>
                </li>
                <li class="sidebar-title">Produk</li>
                <li class="sidebar-item  {{ Route::is('product.index') ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}" class='sidebar-link'>
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Produk</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('category.index') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class='sidebar-link'>
                        <i class="bi bi-bookmarks-fill"></i>
                        <span>Kategori Produk</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
