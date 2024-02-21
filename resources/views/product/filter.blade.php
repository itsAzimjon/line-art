@extends('layouts.app')
@section('content')
<nav class="my-5"> 
    <div class="dropdown">
        <a class="btn_toogle_left dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><b>Сортировать</b> Популярные</a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('filter', ['sort_by' => 'popular']) }}">Популярные</a></li>
            <li><a class="dropdown-item" href="{{ route('filter', ['sort_by' => 'highest_rated']) }}">С высшими оценками</a></li>
            <li><a class="dropdown-item" href="{{ route('filter', ['sort_by' => 'most_downloaded']) }}">Самые скачиваемые</a></li>
            <li><a class="dropdown-item" href="{{ route('filter', ['sort_by' => 'newest']) }}">Новые</a></li>
        </ul>
    </div>
    <ul class="ul_kniga ul_filter p-0">
        <li><a href="{{ route('filter', ['role_model' => '1']) }}">Книги</a></li>
        <li><a href="{{ route('filter', ['role_model' => '2']) }}">Чертежи</a></li>
        <li><a href="{{ route('filter', ['role_model' => '3']) }}">Курсы</a></li>
        <li><a href="{{ route('filter', ['role_model' => '4']) }}">Нормативы</a></li>
        <li><a href="{{ route('filter', ['role_model' => '5']) }}">Расчёты</a></li>
    </ul>
</nav>
@foreach ($filteredProducts->groupBy('role_model') as $roleModel => $groupedProducts)
    <div class="main_title d-flex my-4">
        @if ($roleModel == 1)
            <h4>Книги</h4>
            <a href="{{ route('filter', ['role_model' => 1])}}">Показать все</a>
        @elseif ($roleModel == 2)
            <h4>Чертежи</h4>
            <a href="{{ route('filter', ['role_model' => 2])}}">Показать все</a>
        @elseif ($roleModel == 3)
            <h4>Курсы</h4>
            <a href="{{ route('filter', ['role_model' => 3])}}">Показать все</a>
        @elseif ($roleModel == 4)
            <h4>Нормативы</h4>
            <a href="{{ route('filter', ['role_model' => 4])}}">Показать все</a>
        @elseif ($roleModel == 5)
            <h4>Расчёты</h4>
            <a href="{{ route('filter', ['role_model' => 5])}}">Показать все</a>
        @elseif ($roleModel == 6)
            <h4>Исследовать</h4>
            <a href="{{ route('filter', ['role_model' => 6])}}">Показать все</a>
        @endif
    </div>
    <div class="d-flex">
        @php
            $encounteredTags = [];
        @endphp
        @foreach ($groupedProducts as $product)
            @foreach ($product->tags as $tag)
                @if (!in_array($tag->name, $encounteredTags))
                    <form action="{{ route('filter')}}" method="GET">
                        <input type="hidden" name="tag_id" value="{{ $tag->id }}">
                        <input type="hidden" name="role_model" value="{{ $roleModel }}">
                        <button type="submit" class="btn metka_btn filter_tag border">{{ $tag->name }}</button>
                    </form>
                    @php
                        $encounteredTags[] = $tag->name;
                    @endphp
                @endif
            @endforeach
        @endforeach
    </div>
@endforeach
<div class="row p-0 block mt-3">
    @foreach ($filteredProducts as $p)
        <div class="col-2 mb-4">
            <a href="{{ route('product.show', ['product' => $p->id]) }}" class="card in">
                <img src="{{ asset('storage/' . json_decode($p->photo)[0]) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title overflow-ellipsis">
                        {{ $p->title }}
                    </h5>
                    <span class="card-text">{{ $p->category->name}} &nbsp;</span>         
                    <form action="{{ route('product.save', ['product' => $p->id]) }}" method="post">
                        @csrf
                        @php $userHasRated = false; @endphp
                        @foreach ($p->saves as $s)
                        @if (auth()->check())
                            @if ($s->user_id == auth()->user()->id)
                                @php $userHasRated = true; @endphp
                                <button type="submit" class="float-end btn" style="margin: -27px 0 0 0">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#F57500" fill-rule="evenodd" clip-rule="evenodd" d="M8.48237 2.4541C4.37737 2.4541 3.68388 3.05311 3.68388 7.87152C3.68388 13.2658 3.58297 14.6656 4.60874 14.6656C5.63387 14.6656 7.30813 12.2979 8.48237 12.2979C9.65661 12.2979 11.3309 14.6656 12.356 14.6656C13.3818 14.6656 13.2809 13.2658 13.2809 7.87152C13.2809 3.05311 12.5874 2.4541 8.48237 2.4541Z" stroke="#F57500" stroke-width="1.15688" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                @break
                            @endif
                        @endif
                        @endforeach
        
                        @if (!$userHasRated)
                            <button type="submit" class="float-end btn" style="margin: -27px 0 0 0">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.48237 2.4541C4.37737 2.4541 3.68388 3.05311 3.68388 7.87152C3.68388 13.2658 3.58297 14.6656 4.60874 14.6656C5.63387 14.6656 7.30813 12.2979 8.48237 12.2979C9.65661 12.2979 11.3309 14.6656 12.356 14.6656C13.3818 14.6656 13.2809 13.2658 13.2809 7.87152C13.2809 3.05311 12.5874 2.4541 8.48237 2.4541Z" stroke="#9CA0AF" stroke-width="1.15688" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        @endif
                    </form>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection