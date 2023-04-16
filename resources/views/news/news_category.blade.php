@extends('layouts.main')

@section('title', 'Категории новостей')

@section('menu')
@include('news.menu')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 mt-5">
            <div class="align-baseline">
                @foreach ($categories as $item)
                <a href="{{ route('news.category', $item->id) }}" class="fs-3 text-decoration-none link-secondary">{{
                    $item->category_name }}</a><br><hr>
                @endforeach
            </div>
        </div>
        <div class="col-md-10">
            <h1 class="mb-4 text-muted text-center">{{ $categoryName }}</h1>
            {{ $news->links() }}
            @forelse ($news as $item)
            @if ($item->is_private == 0 || auth()->user())
            <a href="{{ route('news.category.message', $item->id) }}" class="fs-5">{{ $item->title }}</a><br>
            <hr>
            @else
            <mark class="fs-5">{{ $item->title }}</mark><a href="{{ route('admin.index') }}" style="color: red;"
                class="fs-5 text-decoration-none"> >>> авторизуйтесь для просмотра</a><br>
            <hr>
            @endif
            @empty
            <h3>Категория отсутствует!</h3>
            @endforelse
        </div>
    </div>
</div>
@endsection
