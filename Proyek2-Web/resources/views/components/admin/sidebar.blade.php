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
                
                <li class="sidebar-title">Pesanan</li>
                <li
                    class="sidebar-item {{ Route::is('order.index', 'unpaid.index', 'paid.index', 'send.index', 'receive.index') ? 'active' : '' }}">
                    <a href="{{ route('unpaid.index') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Data Pesanan</span>
                    </a>
                </li>
                <li class="sidebar-title">Pendapatan</li>
                <li class="sidebar-item {{ Route::is('report.index') ? 'active' : '' }}">
                    <a href="{{ route('report.index') }}" class='sidebar-link'>
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li class="sidebar-title">Produk</li>
                <li class="sidebar-item {{ request()->is('active', 'deactive') ? 'active' : '' }}">
                    <a href="/active" class='sidebar-link'>
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
                <li class="sidebar-title ">User</li>
                <li class="sidebar-item {{ Route::is('user.index') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Daftar User</span>
                    </a>
                </li>
                {{-- <li
                class="sidebar-item d-block has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-collection-fill"></i>
                    <span>Total Pendapatan</span>
                </a>
                <ul
                    class="submenu">
                    <li class="submenu-item ">
                        <form action="#" method="GET">
                            <button type="submit" style="background-color: transparent;
                        background-repeat: no-repeat;
                        border: none;
                        cursor: pointer;
                        overflow: hidden;
                        outline: none;">
                                <div class="wrap-pesanan align-items-center d-flex">
                                    <i class="bi bi-cash"></i>
                                    <span
                                        style="padding: 1px 7px; border-radius: 12px; color: rgb(211, 234, 250)"></span>
                                    <span class="transaksi-badge ">Total Pendapatan </span>
                                </div>
                            </button>
                        </form>
                    </li>
                    <li class="submenu-item ">
                       <form action="{{ route('report.index') }}" method="GET">
                <button type="submit" style="background-color: transparent;
                                background-repeat: no-repeat;
                                border: none;
                                cursor: pointer;
                                overflow: hidden;
                                outline: none;">
                    <div class="wrap-pesanan align-items-center d-flex">
                        <i class="bi bi-file-earmark-excel"></i>
                        <span style="padding: 1px 7px; border-radius: 12px; color: rgb(211, 234, 250)"></span>
                        <span class="transaksi-badge ">Cetak Laporan</span>
                    </div>
                </button>
                </form>
                </li>
            </ul>
            </li> --}}
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>