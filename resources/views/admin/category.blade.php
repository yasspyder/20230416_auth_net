@extends('layouts.main')

@section('title', 'Редактирование категории')

@section('menu')
@include('admin.menu')
@endsection

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card align-items-center">
                <div class="card-header display-6 text-muted">{{ __('Редактировать категорию новостей') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.category', $category->id) }}" method="post"
                        onsubmit="return confirm('Изменить категорию?')">
                        @csrf
                        <div class="form-group">
                            <label for="categoryName">Заголовок категории</label>
                            <textarea required class="form-control" id="categoryName" cols="120" rows="1"
                                name="category_name">{{ $category->category_name }}</textarea>
                        </div>
                        @error('category_name') <span style="color: red">{{ $message }}</span> @enderror
                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-primary mt-2" value="Изменить">
                        </div>
                    </form><br>
                    <form action="{{ route('admin.delete.category', $category->id) }}" method="post"
                        onsubmit="return confirm('Удалить категорию?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <input type="submit" class="btn btn-outline-danger" value=" Удалить ">
                    </form><br>
                    <a href="#" onclick="history.back();return false;" class="fs-5">Назад</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
