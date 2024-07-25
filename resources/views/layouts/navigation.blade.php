<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('admin') }}" class="brand-link">
        <img src="{{ asset('assets/vendor/adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Resto</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/vendor/adminlte') }}/dist/img/user2-160x160.jpg"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/master/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.master.daftar_makanan_minuman.index') }}"
                                class="nav-link {{ request()->is('admin/master/daftar_makanan_minuman*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Makanan Minuman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.master.resto.index') }}"
                                class="nav-link {{ request()->is('admin/master/resto*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Resto</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Transaksi</li>
                <li class="nav-item">
                    <a href="{{ route('admin.transaksi.create') }}"
                        class="nav-link {{ request()->is('admin/transaksi/create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Buat Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.transaksi.index') }}"
                        class="nav-link {{ request()->is('admin/transaksi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link bg-danger"
                            onclick="event.preventDefault();
                        this.closest('form').submit();">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>