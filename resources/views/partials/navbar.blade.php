<nav>
    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/logos/logokabserang.png') }}" alt="Logo Desa Kopo" class="logo-img">
        <span>Desa Kopo</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ Route::is('home') ? '#beranda' : route('home') . '#beranda' }}">Beranda</a></li>
        <li><a href="{{ Route::is('home') ? '#pelayanan' : route('home') . '#pelayanan' }}">Pelayanan</a></li>
        <li><a href="{{ Route::is('home') ? '#keuangan' : route('home') . '#keuangan' }}">Transparansi</a></li>
        <li><a href="{{ Route::is('home') ? '#bumdes' : route('home') . '#bumdes' }}">BUMDes</a></li>
        <li><a href="{{ Route::is('home') ? '#berita' : route('home') . '#berita' }}">Berita</a></li>
        <li><a href="{{ Route::is('home') ? '#dokumen' : route('home') . '#dokumen' }}">Dokumen</a></li>
        @auth
            @if(Auth::user()->isAdmin())
                <li><a href="{{ route('admin.finance.index') }}" class="admin-badge"><i class="fa-solid fa-gauge"></i> Admin</a>
                </li>
            @else
                <li><a href="{{ route('akun') }}" class="nav-user-name" style="text-decoration: none;"><i
                            class="fa-solid fa-circle-user"></i> {{ explode(' ', Auth::user()->name)[0] }}</a></li>
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            <li><a href="{{ route('admin.login') }}" class="login-btn"><i class="fa-solid fa-right-to-bracket"></i>
                    Masuk</a></li>
        @endauth
    </ul>
</nav>