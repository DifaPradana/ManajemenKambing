<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Penerimaan
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('supplier') }}">
            <i class="fas fa-edit"></i>
            <span>Supplier</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pelanggan') }}">
            <i class="fas fa-edit"></i>
            <span>Pelanggan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('penerimaan') }}">
            <i class="fas fa-edit"></i>
            <span>Input Penerimaan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('data-kambing-awal') }}">
            <i class="fas fa-edit"></i>
            <span>Input Data Kambing Awal</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('data-kambing-akhir') }}">
            <i class="fas fa-edit"></i>
            <span>Input Data Kambing Akhir</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('data-kambing') }}">
            <i class="fas fa-book-reader"></i>
            <span>Data Kambing</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kategori-view') }}">
            <i class="fas fa-edit"></i>
            <span>Kategori</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('jenis-view') }}">
            <i class="fas fa-edit"></i>
            <span>Jenis</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('form-penjualan') }}">
            <i class="	fas fa-comments-dollar"></i>
            <span>Jual</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('data-penjualan') }}">
            <i class="	fas fa-comments-dollar"></i>
            <span>Data Penjualan</span></a>
    </li>
    <hr class="sidebar-divider">
</ul>
