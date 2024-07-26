<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link">
        <img src="{{ asset('img/icon.svg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">OrderFlow</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (empty(Auth::user()->profile_photo_path))
                <img src="{{ asset('img/no_photo.svg') }}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{ asset('storage/photo_user/'.Auth::user()->profile_photo_path) }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.index') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role != 'user')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product</p>
                                </a>
                            </li>
                            @if (Auth::user()->role != 'supplier')
                                <li class="nav-item">
                                    <a href="{{ route('supplier.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Supplier</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->role == 'user')
                    <li class="nav-item">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="far fa-list-alt nav-icon"></i>
                            <p>Daftar Product</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role != 'supplier')
                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.create') }}" class="nav-link ">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Buat Transaksi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" class="nav-link ">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>
                                Transaksi
                            </p>
                        </a>
                    </li>
                @endif

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
