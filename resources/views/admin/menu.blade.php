<li>
    <a class="nav-link {{ request()->routeIs('index')? 'active' : '' }}" href="{{ route('index') }}">Главная</a>
</li>

<li>
    <a class="nav-link {{ request()->routeIs('admin.index')? 'active' : '' }}" href="{{ route('admin.index') }}">Пользователь</a>
</li>

<li>
    <a class="nav-link {{ request()->routeIs('admin.create')? 'active' : '' }}" href="{{ route('admin.create') }}">Добавление</a>
</li>

<li>
    <a class="nav-link {{ request()->routeIs('admin.edit')? 'active' : '' }}" href="{{ route('admin.edit', 1) }}">Редактирование</a>
</li>

<li>
    <a class="nav-link {{ request()->routeIs('admin.save')? 'active' : '' }}" href="{{ route('admin.save') }}">Скачать</a>
</li>

<li>
    <a class="nav-link {{ request()->routeIs('admin.parse')? 'active' : '' }}" href="{{ route('admin.parse') }}">Парсер</a>
</li>

<li>
    <a class="nav-link {{ request()->routeIs('news.index')? 'active' : '' }}" href="{{ route('news.index') }}">Новости</a>
</li>
