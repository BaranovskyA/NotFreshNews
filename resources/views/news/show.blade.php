@extends('layouts.app')

@section('content')

    <div class="container text-break card card-header">
        <form class="ml-auto" action="{{ route('news.destroy', $news) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="btn-group">
                @can('update', $news)
                    <a class="btn btn-info" href="{{ route('news.edit', $news) }}">Редактировать</a>
                @endcan
                @can('delete', $news)
                    <button class="btn btn-danger">Удалить</button>
                @endcan
            </div>
        </form>

        <h1 style="white-space: normal;">
            {{ $news->title }}
        </h1>

        <div class="lead text-muted container">
            {{ $news->updated_at->diffForHumans( ) }}
        </div>
    </div>

    <div class="mb-3"></div>

    <div class="card card-body container">
        @if($news->img != null)
            <div class="w-100 h-100 mt-2 mb-2">
                <img src="{{ $news->img }}" style="width: 100%; height: 100%;">
            </div>
        @endif

        <p class="lead mb-0">{!! $news->content !!}</p>
    </div>

    <div class="container card card-header mt-3">
        Категории: {{ $news->category_list }}
    </div>
@endsection
