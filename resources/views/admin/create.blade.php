@extends('layouts.main')

@section('title', 'Добавление контента')

@section('menu')
@include('admin.menu')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card align-items-center">
                <div class="card-header display-6 text-muted">{{ __('Добавить новость') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.create.news') }}" method="post"
                        onsubmit="return confirm('Добавить новость?')" id="news">
                        @csrf
                        <div class="form-group">
                            <label for="newsCategory">Категория новости</label>
                            <select name="category_id" id="newsCategory" class="form-control" form="news">
                                <option selected value=0>Выберите Категорию</option>
                                @forelse($categories as $item)
                                <option {{ $item->id == old('category_id') ? 'selected' : '' }} value="{{ $item->id
                                    }}">{{ $item->category_name }}</option>
                                @empty
                                <option value="0" selected>Нет категории</option>
                                @endforelse
                            </select>
                            @error('category_id') <span style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Создать категорию</label>
                            <textarea class="form-control" id="categoryName" cols="120" rows="1" name="category_name"
                                form="news">{{ isset($parse['category_name']) ?  $parse['category_name'] : old('category_name') }}</textarea>
                            @error('category_name') <span style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="newsTitle">Заголовок новости</label>
                            <textarea required class="form-control" id="newsTitle" cols="120" rows="2" name="title"
                                form="news">{{ isset($parse['mark']) ? $parse['title'] : old('title') }}</textarea>
                            @error('title') <span style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class=" form-group">
                            <label for="newsText">Текст статьй</label>
                            <textarea required class="form-control" id="newsText" cols="120" rows="12" name="text"
                                form="news">{{ isset($parse['text']) ? $parse['text'] : old('text') }}</textarea>
                            @error('text') <span style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-check">
                            <input {{ old('is_private')===1 ? 'checked' : '' }} id="newsPrivate" name="is_private"
                                type="checkbox" value="1" class="form-check-input" form="news">
                            <label for="newsPrivate">Приватная</label>
                            @error('is_private') <span style="color: red">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-primary" value="Добавить новость" form="news">
                        </div>
                    </form>
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
