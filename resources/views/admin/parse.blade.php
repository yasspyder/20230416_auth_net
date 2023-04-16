@extends('layouts.main')

@section('title', 'Парсинг новостей')

@section('menu')
@include('admin.menu')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card align-items-center">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <form class="form-control" id="parse_link" method="post" action="{{ route('admin.parse', 1) }}">
                            @csrf
                            <label for="parse_link">Введите ссылку на новостной ресурс</label>
                            <input form="parse_link" type="text" name="parse_link" class="form-control">
                            <input form="parse_link" type="submit" class="btn btn-outline-primary mt-1"
                                value="Парсить ссылку">
                        </form>
                    </div>
                    <div class="card-header mb-3">
                        <form class="d-grid gap-2" id="parse_all" method="post" action="{{ route('admin.parse', 1) }}"
                            onsubmit="return confirm('Обновить все ленты?')">
                            @csrf
                            <input hidden form="parse_all" name="parse_all" value="get">
                            <input form="parse_all" type="submit" class="btn btn-outline-success mt-1"
                                value="ОБНОВИТЬ ВСЕ ИНФОРМАЦИОННЫЕ ЛЕНТЫ">
                        </form>
                        <table class="table">
                            <tr>
                                <td>Просмотр</td>
                                <td>Обновить</td>
                                <td>Название</td>
                                <td>Описание</td>
                                <td>Ссылка</td>
                                <td>Удалить</td>
                            </tr>
                            @forelse($resources as $key)
                            <tr>
                                <td>
                                    <form method="post" id="resource{{ $key['id'] }}"
                                        action="{{ route('admin.parse') }} ">
                                        @csrf
                                        <input hidden form="resource{{ $key['id'] }}" name="parse_link"
                                            value="{{ $key['resource_url'] }}">
                                        <input class="btn btn-outline-primary btn-sm" form="resource{{ $key['id'] }}"
                                            type="submit" value="смотреть ленту">
                                    </form>
                                </td>
                                <td>
                                    <form method="post" id="load{{ $key['id'] }}"
                                        action="{{ route('admin.parse.load') }} ">
                                        @csrf
                                        <input hidden form="load{{ $key['id'] }}" name="parse_link"
                                            value="{{ $key['resource_url'] }}">
                                        <input class="btn btn-outline-success btn-sm" form="load{{ $key['id'] }}"
                                            type="submit" value="обновить ленту">
                                    </form>
                                </td>
                                <td>
                                    {{ $key['resource_name'] }}
                                </td>
                                <td>
                                    {{ $key['resource_description'] }}
                                </td>
                                <td>
                                    <a href="{{ $key['resource_url'] }}" target="_blank">{{ $key['resource_url'] }} </a>
                                </td>
                                <td>
                                    <form method="post" id="resource_delete{{ $key['id'] }}"
                                        action="{{ route('admin.delete.parse', $key['id']) }} "
                                        onsubmit="return confirm('Удалить источник?')">
                                        @csrf
                                        @method('delete')
                                        <input hidden form="resource_delete{{ $key['id'] }}" name="id"
                                            value="{{ $key['id'] }}">
                                        <input class="btn btn-outline-danger btn-sm"
                                            form="resource_delete{{ $key['id'] }}" type="submit" value="удалить ленту">
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <h1>Нет сохранённых ресурсов</h1>
                            @endforelse
                        </table>
                    </div>

                </div>
                <div class="card-body">
                    @if (count($parse) > 0)
                    <h4>РЕСУРС: {{ $parse['title'] }}, ссылка - <a href={{ $parse['link'] }} target="_blank">{{
                            $parse['link'] }}</a>
                    </h4>
                    <h4>ОПИСАНИЕ: {{ $parse['description'] }}</h4>
                    <form id="resource" method="post" action="{{ route('admin.parse.add') }}">
                        @csrf
                        <input hidden form="resource" name="resource_name" value="{{ $parse['title'] }}">
                        <input hidden form="resource" name="resource_description" value="{{ $parse['description'] }}">
                        <input hidden form="resource" name="resource_url" value="{{ $parse_link }}">
                        <input type="submit" form="resource" class="btn btn-outline-primary btn-sm"
                            value="добавить источник">
                    </form>
                    @foreach($parse['news'] as $key => $item)
                    <hr>
                    <div class="card-body">
                        <h5>{{ $item['title'] }}</h5>
                        <p>{{ $item['description'] }}</p>
                        <p>АВТОР: {{ $item['author'] }}</p>
                        <p>КАТЕГОРИЯ: {{ $item['category'] }}</p>
                        <p>ОПУБЛИКОВАНО: {{ $item['pubDate']}}</p>
                        <p>ССЫЛКА: <a href={{ $item['link']}} target="_blank">смотреть в источнике</a></p>
                        <form method="post" id="parse{{ $key }}" action="{{ route('admin.create') }} " target="_blank">
                            @csrf
                            <input hidden form="parse{{ $key }}" type="text" name="mark" value="parse">
                            <input hidden form="parse{{ $key }}" type="text" name="category_name"
                                value="{{ $item['category'] }}">
                            <input hidden form="parse{{ $key }}" type="text" name="title" value="{{ $item['title'] }}">
                            <input hidden form="parse{{ $key }}" type="text" name="text"
                                value="{{ $item['description'] . '  ' . $item['link']}}">
                            <input form="parse{{ $key }}" type="submit" class="btn btn-outline-primary"
                                value="Сохранить">
                        </form>
                    </div>
                    @endforeach
                    @else
                    <h2>Нет загруженных источников</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
