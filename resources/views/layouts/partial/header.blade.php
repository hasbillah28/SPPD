<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <div class="px-md-0 me-md-3">
        </div><a class="header-brand d-md-none" href="#">
            <img src="{{ asset('storage/logobpn.png') }}" alt=""></a>

        <ul class="header-nav ms-2">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="col-auto avatar avatar-md bg-dark">
                        @if(Auth::user()->avatar != null)
                            <img class="avatar-img" src="{{ asset('storage/file/'.Auth::user()->id.'/avatar/'.Auth::user()->avatar) }}" alt="">
                        @else
                            <i class="text-white icon icon-lg fas fa-user"></i>
                        @endif
                    </div>
                    </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">{{ Auth::user()->name }}</div>
                    </div>
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <i class="icon me-2 cil-user"></i> Profile</a>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="icon me-2 cil-account-logout"></i> Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="header-divider">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>
    </div>
</header>

