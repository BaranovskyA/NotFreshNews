<?php
$update = isset($news);
?>

@extends('layouts.app')

@section('content')
    <h2 class="mb-3 container card card-header">{{ $update ? "Редактировать {$news->title}" : "Добавить новость" }}</h2>

    <div class="card card-body container">
        <form action="{{ $update ? route('news.update', $news) : route('news.store') }}" method="POST">
            @csrf
            @if($update)
                @method('PUT')
            @endif
            <a href="#" class="btn btn-outline-secondary mb-3" onclick="event.preventDefault(); window.history.back();">Назад</a>

            <div class="form-group">
                <label for="title">Заголовок <span class="text-danger">*</span></label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="Заголовок..." value="{{ old('title') ?? ($news->title ?? '') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Содержание</label>
                <textarea class="form-control" name="content" id="content" placeholder="Содержание...">{{ old('content') ?? ($news->content ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="category">Категории (Перечесление через запятую без пробела)</label>
                <input class="form-control" type="text" name="category_list" id="category" placeholder="Категории" value="{{ old('category_list') ?? ($news->category_list ?? '') }}">
            </div>

            <div class="form-group">
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <button class="btn btn-success">{{ $update ? "Обновить" : "Добавить" }}</button>

        </form>
    </div>

@endsection
