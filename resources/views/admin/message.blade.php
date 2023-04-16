@extends('layouts.main')

@section('title', 'Редактирование новости')

@section('menu')
@include('admin.menu')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card align-items-center">
                <div class="card-header display-6 text-muted">{{ __('Редактировать новость') }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.message', $news->id) }}" method="post"
                        onsubmit="return confirm('Изменить статью?')" id="news">
                        @csrf
                        <div class="form-group">
                            <label for="newsCategory">Категория новости</label>
                            <select name="category_id" id="newsCategory" class="form-control" form="news">
                                @forelse($categories as $item)
                                <option {{ $item->id == $news->category_id ? 'selected' : '' }} value="{{ $item->id
                                    }}">{{
                                    $item->category_name }}</option>
                                @empty
                                <option value="0" selected>Нет категории</option>
                                @endforelse
                            </select>
                            @error('category_id') <span style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="newsTitle">Заголовок новости</label>
                            <textarea required class="form-control" id="newsTitle" cols="120" rows="2" name="title"
                                form="news">{{ $news->title }}</textarea>
                            @error('title') <span style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class=" form-group">
                            <label for="newsText">Текст новости</label>
                            <textarea required class="form-control" cols="120" rows="6" name="text" form="news"
                                id="newsText">{{ $news->text }}</textarea>
                            @error('text') <span style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-check">
                            <input id="isPrivate" name="is_private" type="checkbox" {{ $news->is_private == 1 ?
                            'checked' : ''}} class="form-check-input" form="news">
                            <label for="isPrivate">Приватная</label>
                            @error('is_private') <span style="color: red">{{ $message }}</span> @enderror
                        </div><br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-primary" value="Изменить" form="news">
                        </div>
                    </form><br>
                    <form action="{{ route('admin.delete.message', $news->id) }}" method="post"
                        onsubmit="return confirm('Удалить статью?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $news->id }}">
                        <input type="submit" class="btn btn-outline-danger" value=" Удалить ">
                    </form><br>
                    <a href="#" onclick="history.back();return false;" class="fs-5">Назад</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#newsText' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
