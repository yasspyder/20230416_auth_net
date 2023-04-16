<li>
    <a class="nav-link {{ request()->routeIs('index')? 'active' : '' }}" href="{{ route('index') }}">Главная</a>&nbsp
</li>

<li>
    <a class="nav-link {{ request()->routeIs('news.index')? 'active' : '' }}" href="{{ route('news.index') }}">Все новости</a>&nbsp
</li>

<li>
    <a class="nav-link {{ request()->routeIs('news.category')? 'active' : '' }}" href="{{ route('news.category', 1) }}" class="text-decoration-none">Новости по категориям</a>
</li>
