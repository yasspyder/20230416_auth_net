@extends('layouts.main')

@section('title', 'Новость')

@section('menu')
@include('news.menu')
@endsection

@section('content')
<div class="container">
    @if ($news)
    <h2>{{ $news->title }}</h2>
    <h4>{{ $news->text }}</h4>
    <a href="#" onclick="history.back();return false;" class="fs-5">Назад</a>
    @else
    <h3>Новость отсутствует!</h3>
    @endif
</div>
@endsection
