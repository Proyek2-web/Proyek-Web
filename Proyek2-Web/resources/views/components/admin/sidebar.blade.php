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
                <li class="sidebar-title ">Pesanan</li>
                <li
                    class="sidebar-item d-block has-sub {{ Route::is('order.index', 'unpaid.index', 'paid.index', 'send.index', 'receive.index') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Data Pesanan</span>
                    </a>
                    <ul
                        class="submenu {{ Route::is('order.index', 'unpaid.index', 'paid.index', 'send.index', 'receive.index') ? 'active' : '' }}">
                        <li class="submenu-item {{ Route::is('unpaid.index') ? 'active' : '' }}">
                            <form action="{{ route('unpaid.index') }}" method="GET">
                                @php
                                    $unpaid = \App\Models\Order::all()
                                        ->where('status', '=', 'UNPAID')
                                        ->count();
                                @endphp
                                <button type="submit" style="background-color: transparent;
                            background-repeat: no-repeat;
                            border: none;
                            cursor: pointer;
                            overflow: hidden;
                            outline: none;">
                                    <div class="wrap-pesanan align-items-center d-flex">
                                        <i class="bi bi-wallet2 "></i>
                                        <span
                                            style="margin-inline: 6px;background-color: rgb(70, 81, 95); padding: 1px 7px; border-radius: 12px; font-size: 0.7rem; color: rgb(211, 234, 250)">{{ $unpaid }}</span>
                                        <span class="transaksi-badge ">Belum Bayar </span>
                                    </div>
                                </button>
                            </form>
                        </li>
                        <li class="submenu-item {{ Route::is('paid.index') ? 'active' : '' }}">
                            <form action="{{ route('paid.index') }}" method="GET">
                                @php
                                    $paid = \App\Models\Order::all()
                                    
                                        ->where('status', '=', 'PAID')
                                        ->where('resi', '==', null)
                                        ->count();
                                @endphp
                                <input type="hidden" name="paid" value="paid">
                                <button type="submit" style="background-color: transparent;
                                    background-repeat: no-repeat;
                                    border: none;
                                    cursor: pointer;
                                    overflow: hidden;
                                    outline: none;">
                                    <div class="wrap-pesanan align-items-center d-flex">
                                        <i class="bi bi-box-seam"></i>
                                        <span
                                            style="margin-inline: 6px;background-color: rgb(70, 81, 95); padding: 1px 7px; border-radius: 12px; font-size: 0.7rem; color: rgb(211, 234, 250)">{{ $paid }}</span>
                                        <span class="transaksi-badge ">Di Proses</span>
                                    </div>
                                </button>
                            </form>
                        </li>
                        <li class="submenu-item {{ Route::is('send.index') ? 'active' : '' }}">
                            <form action="{{ route('send.index') }}" method="GET">
                                @php
                                    $send = \App\Models\Order::all()
                                    
                                        ->where('status', '=', 'PAID')
                                        ->where('resi', '!=', null)
                                        ->where('order_notes', '=', null)
                                        ->count();
                                @endphp
                                <input type="hidden" name="send" value="send">
                                <button type="submit" style="background-color: transparent;
                                    background-repeat: no-repeat;
                                    border: none;
                                    cursor: pointer;
                                    overflow: hidden;
                                    outline: none;">
                                    <div class="wrap-pesanan align-items-center d-flex">
                                        <i class="bi bi-truck"></i>
                                        <span
                                            style="margin-inline: 6px;background-color: rgb(70, 81, 95); padding: 1px 7px; border-radius: 12px; font-size: 0.7rem; color: rgb(211, 234, 250)">{{ $send }}</span>
                                        <span class="transaksi-badge ">Pengiriman</span>
                                    </div>
                                </button>
                            </form>
                        </li>
                        <li class="submenu-item {{ Route::is('receive.index') ? 'active' : '' }}">
                            <form action="{{ route('receive.index') }}" method="GET">
                                @php
                                    $receive = \App\Models\Order::all()
                                    
                                        ->where('status', '==', 'PAID')
                                        ->where('resi', '!=', null)
                                        ->where('order_notes', '!=', null)
                                        ->count();
                                @endphp
                                <input type="hidden" name="receive" value="receive">
                                <button type="submit" style="background-color: transparent;
                                    background-repeat: no-repeat;
                                    border: none;
                                    cursor: pointer;
                                    overflow: hidden;
                                    outline: none;" active>
                                    <div class="wrap-pesanan align-items-center d-flex">
                                        <i class="bi bi-check2-circle"></i>
                                        <span
                                            style="margin-inline: 6px;background-color: rgb(70, 81, 95); padding: 1px 7px; border-radius: 12px; font-size: 0.7rem; color: rgb(211, 234, 250)">{{ $receive }}</span>
                                        <span class="transaksi-badge "> Selesai </span>
                                    </div>

                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">Pendapatan</li>
                
                <li class="sidebar-item {{ Route::is('report.index') ? 'active' : '' }}">
                    <a href="{{ route('report.index') }}" class='sidebar-link'>
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <span>Laporan</span>
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
                                    <span
                                    style="padding: 1px 7px; border-radius: 12px; color: rgb(211, 234, 250)"></span>
                                    <span class="transaksi-badge ">Cetak Laporan</span>
                                </div>
                            </button>
                        </form>
                    </li>
                </ul>
            </li> --}}
            <hr>
                <li class="sidebar-item text-center">
                    <i class="bi bi-person-circle"></i>
                                <span>{{ Auth::user()->email}}</span>
                </li>
                <a href="{{ url('/logout') }}" class='sidebar-link'>
                <li class="sidebar-item">
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Keluar</span>
                            </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
