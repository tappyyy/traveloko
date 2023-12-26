<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="/storage/assets/logo2.png" alt=""
                width="180px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                <a class="nav-link" href="{{ route('consultations.index') }}">Travel Agent</a>
                @auth
                @if (Auth::user()->role == 'ADMIN')
                <a class="nav-link" href="{{ route('accomodation.show') }}">Accomodation</a>
                <a class="nav-link" href="{{ route('admin') }}">Confirmation</a>
                @endif
                @endauth


                @guest
                @if (Route::has('register'))
                <li class="nav-item ">
                    <a class="nav-link register-home-submit" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @if (Route::has('login'))
                <li class="nav-item ">
                    <a class="nav-link login-home-submit " href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif


                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            {{ __('Dashboard') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </div>
        </div>
    </div>
</nav>