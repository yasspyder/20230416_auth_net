@extends('layouts.main')

@section('title', 'Редактирование')

@section('menu')
@include('admin.menu')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 mt-5">
            <div class="align-baseline">
                @foreach ($categories as $item)
                <a href="{{ route('admin.edit', $item->id) }}" class="fs-3 text-decoration-none link-secondary">{{
                    $item->category_name }}</a><br>
                <a href="{{ route('admin.category', $item->id) }}" class="fs-5">редактировать</a>&nbsp
                <br><hr>
                @endforeach
            </div>
        </div>
        <div class="col-md-10">
            <h1 class="mb-4 text-muted text-center">Редактировать новости категории: {{ $categoryName }}</h1>
            {{ $news->links() }}
            @foreach ($news as $item)
            <p class="fs-5">{{ $item->title }}</p>
            <a href="{{ route('admin.message', $item->id) }}" class="fs-5">редактировать</a>&nbsp
            <br>
            <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
