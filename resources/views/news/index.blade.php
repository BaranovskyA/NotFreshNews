@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center mb-3 container">
        @if(auth()->user() != null)
            <a href="{{ route('news.create') }}" class="ml-auto btn btn-success">
                Добавить новость
            </a>
        @endif
    </div>

    <div class="container form-group">
        <h3 class="text-secondary">Текущая категория: {{ $searchingCategory }}</h3>
        <form method="GET">
            <input class="form-control" type="text" name="categories" placeholder="Поиск по категориям...">
            <button class="btn btn-secondary mt-2">Получить</button>
        </form>
    </div>

    @forelse($newss as $news)

        <?php
            $imgArr = explode(',', $news->img);
        ?>

        @if($statusSearch == 'all')
            <div class="border container text-break flex-wrap mt-5 card card-header">
                <h4 class="text-secondary text-right position-relative mt-1">{{ $news->updated_at->diffForHumans( ) }}</h4>

                <form class="text-right mt-3 mb-2" action="{{ route('news.destroy', $news) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="btn-group btn-group-sm">
                        @can('update', $news)
                            <a class="btn btn-info" href="{{ route('news.edit', $news) }}">Редактировать</a>
                        @endcan
                        @can('delete', $news)
                            <button class="btn btn-danger">Удалить</button>
                        @endcan
                    </div>
                </form>

                <h1 class="text-left">
                    <a href="{{ route('news.show', $news) }}" class="d-block text-decoration-none" style="color:black;">
                        {{ $news->title }}
                    </a>
                </h1>
            </div>

            <div class="container border card card-body">
                @if($imgArr[0] != "")
                    @foreach($imgArr as $img)
                        <div class="w-100 h-100 mt-2 mb-2">
                            <img src="{{ $img }}" style="width: 100%; height: 100%;">
                        </div>
                    @endforeach
                @endif

                <h2 class="text-center">{!! substr($news->content, 0, strpos($news->content, '<br>')) !!}...</h2>
            </div>

            @if($news->category_list != null)
                <div class="container card card-header mt-3">
                    Категории: {{ $news->category_list }}
                </div>
            @endif
        @endif

        @if($statusSearch == 'notAll' && (stripos( mb_strtolower($news->category_list), mb_strtolower($searchingCategory)) !== false))
            <div class="border container text-break flex-wrap mt-5 card card-header">
                <h4 class="text-secondary text-right position-relative mt-1">{{ $news->updated_at->diffForHumans( ) }}</h4>

                <form class="text-right mt-3 mb-2" action="{{ route('news.destroy', $news) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="btn-group btn-group-sm">
                        @can('update', $news)
                            <a class="btn btn-info" href="{{ route('news.edit', $news) }}">Редактировать</a>
                        @endcan
                        @can('delete', $news)
                            <button class="btn btn-danger">Удалить</button>
                        @endcan
                    </div>
                </form>

                <h1 class="text-left">
                    <a href="{{ route('news.show', $news) }}" class="d-block text-decoration-none" style="color:black;">
                        {{ $news->title }}
                    </a>
                </h1>
            </div>

            <div class="container border card card-body">
                @if($imgArr[0] != "")
                    @foreach($imgArr as $img)
                        <div class="w-100 h-100 mt-2 mb-2">
                            <img src="{{ $img }}" style="width: 100%; height: 100%;">
                        </div>
                    @endforeach
                @endif

                <h2 class="text-center">{!! substr($news->content, 0, strpos($news->content, '<br>')) !!}...</h2>
            </div>

            @if($news->category_list != null)
                <div class="container card card-header mt-3">
                    Категории: {{ $news->category_list }}
                </div>
            @endif
        @endif
    @empty
        <div class="alert alert-secondary container">
            Ничего нет :(
        </div>
    @endforelse

    @if($searchingCategory == ' ')
        <div class="d-flex justify-content-center mt-3">
            {{ $newss->links() }}
        </div>
    @endif
@endsection
