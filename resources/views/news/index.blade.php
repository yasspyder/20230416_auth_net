@extends('layouts.main')

@section('title', 'Новости')

@section('menu')
@include('news.menu')
@endsection

@section('content')
<div class="container">
    {{ $news->links() }}
    @forelse ($news as $item)
    @if ($item->is_private === 0 || auth()->user())
    <a href="{{ route('news.category.message', $item->id) }}" class="fs-5">{{ $item->title }} </a><br>
    <hr>
    @else
    <mark class="fs-5">{{ $item->title }}</mark><a href="{{ route('admin.index') }}" style="color: red;"
        class="fs-5 text-decoration-none"> >>> авторизуйтесь для просмотра</a><br>
    <hr>
    @endif
    @empty
    <h3>Нет такой новости!</h3>
    @endforelse
</div>
@endsection
