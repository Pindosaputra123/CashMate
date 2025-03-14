<ul class="menu" id="menu-nav">
    <li class="sidebar-item">
        <a href="{{ route('dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>Master Data</span>
        </a>

        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('barang.index') }}" class="submenu-link">Data Barang</a>
            </li>

            <li class="submenu-item">
                <a href="{{ route('customer.index') }}" class="submenu-link">Data Customer</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-cash"></i>
            <span>Transaksi</span>
        </a>

        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('incoming_sale.index') }}" class="submenu-link">Data Transaksi</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('incoming_sale.create') }}" class="submenu-link">Tambah Transaksi</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item">
        <a href="{{ route('user.index') }}" class='sidebar-link'>
            <i class="bi bi-people"></i>
            <span>Kelola User</span>
        </a>
    </li>

    <li class="sidebar-title">Configuration</li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-person-fill-gear"></i>
            <span>Setting Akun</span>
        </a>

        <ul class="submenu">
            <li class="submenu-item">
                <a href="{{ route('settings.set-profile') }}" class="submenu-link">Profile</a>
            </li>
            <li class="submenu-item">
                <a href="{{ route('settings.set-password') }}" class="submenu-link">Ganti Password</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item">
        <a href="{{ route('logout') }}" class='sidebar-link'>
            <i class="bi bi-power"></i>
            <span>Log Out</span>
        </a>
    </li>
    <li class="sidebar-title">Repost by <a href='https://pindo-portfolio.vercel.app/' title='pindosaputra' target='_blank'>Pindo Saputra</a>
    </li>
</ul>
