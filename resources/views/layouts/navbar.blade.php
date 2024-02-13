<nav class="mt-2">
    <div class="logo">
        <a class="d-flex text-dark" href="{{ route('home')}}">
            <img src="{{ asset('images/logo.jpg') }}" width="30" height="30" alt="">
            <h1>LineArt</h1>
        </a>
    </div>
    <div class="form">
        <ul class="ul_1">
            <li class="li_1">
                <a class="{{ (Route::currentRouteName() == 'home' ? 'active' : '') }}" href="{{ route('home') }}">
                    <span class="icons material-symbols-outlined">language</span>Библиотека
                </a>
            </li>
            <li class="li_1">
                <a class="{{ (Route::currentRouteName() == 'forum' ? 'active' : '') }}" href="{{ route('forum') }}">
                    <span class="icons material-symbols-outlined">forum</span>Форум
                </a>
            </li>
            
            <li class="li_1">
                <a href="#"><span class="icons material-symbols-outlined">description</span>Статьи</a>
            </li>
            <li class="li_1">
                <a class="{{ (Route::currentRouteName() == 'price' ? 'active' : '') }}" href="{{ route('price') }}">
                    price
                </a>
            </li>
            </ul>
        <form action="#">

            <div class="search">
                <input type="text" placeholder="Поиск..." style="font-style: italic;">
                <button class="search_icons material-symbols-outlined bg-none">search</button>
            </div>
        </form>
    </div>
    <div>
        <ul class="registr">
            <li><a href="{{ route('downloads')}}"><span class="material-symbols-outlined">download</span></a></li>
            <li><a href="#"><span class="material-symbols-outlined">notifications</span></a></li>
            @if (auth()->check() && auth()->user()->photo)
                <li><a href="#"><img class="user_img" src="{{ asset('storage/' . auth()->user()->photo) }}"></a></li>
            @endif
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="mt-3 dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <p class="dropdown-item">Кредит: {{auth()->user()->credit}}</p>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
