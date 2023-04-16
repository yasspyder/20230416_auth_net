<li>
    <a class="nav-link {{ request()->routeIs('index')? 'active' : '' }}" href="{{ route('index') }}">Главная</a>&nbsp
</li>

<li>
    <a class="nav-link {{ request()->routeIs('news.index')? 'active' : '' }}"
        href="{{ route('news.index') }}">Новости</a>&nbsp
</li>

@auth
<li>
    <a class="nav-link {{ request()->routeIs('account')?' active' : '' }}" href="{{ route('account') }}">Мой
        аккаунт</a>&nbsp
</li>
@if (auth()->user()->role == 'admin')
<li>
    <a class="nav-link" href="{{ route('admin.index') }}">Администрирование</a>&nbsp
</li>
@endif
@endauth

@if (!auth()->user())
<a class="nav-link {{ request()->routeIs('registration')? 'active' : '' }}" href={{ route('registration')
    }}>Регистрация</a><br>
@endif

<li>
    <a class="nav-link {{ request()->routeIs('about')? 'active' : '' }}" href="{{ route('about') }}">О нас</a>
</li>
