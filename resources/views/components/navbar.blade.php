<div id="bdSidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-dark bg-dark-custom text-white offcanvas-md offcanvas-start" style="width: 280px;">
    <a href="{{ route('auth.dashboard') }}" class="navbar-brand">
        <img src="{{ asset('images/eterna-whitelogo.webp') }}" id="app-logo" alt="Eterna App">
    </a>
    <hr>
    <ul class="mynav nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ route('auth.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                {{ __('Gösterge Paneli') }}
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="{{ route('categories.index') }}">
                <i class="fa-solid fa-list"></i>
                {{ __('Kategoriler') }}
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('products.index') }}">
                <i class="fa-regular fa-newspaper"></i>
                {{ __('Ürünler') }}
            </a>
        </li>
    </ul>
    <hr>
    <div class="d-flex">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name='{{ urlencode(auth()->user()->firstname. ' '. auth()->user()->lastname) }}'&color=7F9CF5&background=EBF4FF" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ auth()->user()->username }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="">
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                    >{{ __('Çıkış Yap') }}</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</div>
