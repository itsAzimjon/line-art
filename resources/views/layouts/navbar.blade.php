<nav class="mt-2 ml-0 nav-in">
    <div class="logo">
        <a class="d-flex text-dark" href="{{ route('home')}}">
            <svg class="mt-3 m-1" width="32" height="28" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4436 1.93925C11.5181 2.04734 11.5195 2.18988 11.4471 2.29943L2.6902 15.5504C2.64307 15.6217 2.69422 15.7168 2.77971 15.7168H20.2964C20.4056 15.7168 20.5074 15.7722 20.5667 15.864L21.2772 16.9634C21.4156 17.1776 21.2619 17.4599 21.0069 17.4599H0.95982C0.638858 17.4599 0.343816 17.2839 0.191662 17.0016C0.0395079 16.7192 0.0548169 16.3762 0.23152 16.1086L10.2313 0.960556C10.357 0.770174 10.6354 0.767351 10.7649 0.955146L11.4436 1.93925ZM12.4277 4.30864C12.5524 4.11135 12.8391 4.10831 12.968 4.30291L18.5851 12.7828C18.7268 12.9967 18.5734 13.2824 18.3167 13.2824H16.9741C16.866 13.2824 16.765 13.2281 16.7055 13.1378L14.8869 10.383C14.8274 10.2928 14.7264 10.2385 14.6183 10.2385H9.05818C8.80089 10.2385 8.64761 9.95151 8.79066 9.73765L9.52607 8.63825C9.58581 8.54895 9.68616 8.49534 9.7936 8.49534H13.4414C13.5269 8.49534 13.5781 8.40028 13.531 8.32895L11.7836 5.68196C11.7139 5.57632 11.7125 5.43962 11.7802 5.33263L12.4277 4.30864Z" fill="black"/>
            </svg>
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
            </li>`
            <li class="li_1">
                <a class="{{ (Route::currentRouteName() == 'article.index' ? 'active' : '') }}" href="{{ route('article.index') }}">
                    <span class="icons material-symbols-outlined">description</span>Статьи
                </a>
            </li>
            <li class="li_1">
                <a class="{{ (Route::currentRouteName() == 'price' ? 'active' : '') }}" href="{{ route('price') }}">
                    price
                </a>
            </li>
        </ul>
        <form  action="{{ route('filter') }}" method="GET">
            <div class="search">
                <input type="text" name="query" placeholder="Поиск..." style="font-style: italic;">
                <button type="submit" class="search_icons material-symbols-outlined bg-none" aria-label="Search">search</button>
            </div>
        </form>            
    </div>
    <div>
        <a href="{{ route('calculation')}}" class="fw-semibold btn-on btn ml-4"  style="font-size: 12px; ">Расчет</a>
    </div>
    <div>
        <ul class="registr">
            <li><a href="{{ route('downloads')}}"><span class="material-symbols-outlined">download</span></a></li>
            <li><a href="{{ route('notification') }}"><span class="material-symbols-outlined">notifications</span></a></li>
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    @if (auth()->check() && auth()->user()->photo)
                        <a id="navbarDropdown" class="nav-link dropown-toggle"  role="button" data-bs-toggle="dropdown"><img class="user_img" src="{{ asset('storage/' . auth()->user()->photo) }}"></a>
                    @else
                        <a id="navbarDropdown" class="nav-link dropown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="material-symbols-outlined">account_circle</span>
                        </a>
                    @endif
                    <div class="mt-3 dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <p class="dropdown-item"><a class="text-dark" href="{{ route('user.edit', ['user' => auth()->user()->id])}}">{{ Auth::user()->name }}</a></p>
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
