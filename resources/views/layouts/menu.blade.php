<li class="nav-item">
    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
        @csrf
    </form>
    <a class="nav-link" style="color: #f13f3f" href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon cil-account-logout" style="color: #f13f3f"></i>
        Logout
    </a>
</li>
<li class="nav-title">Toko Beras Mulia</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('dashboard') }}">
        <i class="nav-icon cil-home"> </i>
        Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('setting') }}">
        <i class="nav-icon cil-settings"> </i>
        Setting
    </a>
</li>
<li class="nav-title">Data Keuangan</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('data-keuangan-masuk') }}">
        <i class="nav-icon cil-chevron-double-down"></i>
        Data Keuangan Masuk
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('data-keuangan-keluar') }}">
        <i class="nav-icon cil-chevron-double-up"></i>
        Data Keuangan Keluar
    </a>
</li>
<li class="nav-title">Data Beras</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('data-stok-beras') }}">
        <i class="nav-icon cil-description"></i>
        Data Stok Beras 
    </a>
</li>