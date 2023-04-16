@extends('layouts.main')

@section('title', 'Скачивание')

@section('menu')
@include('admin.menu')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card align-items-start">
                <div class="card-header display-6 text-muted">{{ __('Скачать новости:') }}</div>
                <div class="card-body">
                    <form action="{{ route('users.export') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <h5>Выберите категорию</h5>
                            <select name="category" class="form-control">
                                @forelse($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @empty
                                <option value="0" selected>Нет категории</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-outline-primary" value="Скачать">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection