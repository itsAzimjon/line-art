@extends('layouts.app')
@section('content')
<nav class="my-5">
    <div class="dropdown">
        <a class="btn_toogle dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.77 13.75H15.73C13.72 13.75 12.75 12.82 12.75 10.9V4.1C12.75 2.18 13.73 1.25 15.73 1.25H19.77C21.78 1.25 22.75 2.18 22.75 4.1V10.9C22.75 12.82 21.77 13.75 19.77 13.75ZM15.73 2.75C14.46 2.75 14.25 3.09 14.25 4.1V10.9C14.25 11.91 14.46 12.25 15.73 12.25H19.77C21.04 12.25 21.25 11.91 21.25 10.9V4.1C21.25 3.09 21.04 2.75 19.77 2.75H15.73Z" fill="#28353D"/>
                <path d="M19.77 22.75H15.73C13.72 22.75 12.75 21.82 12.75 19.9V18.1C12.75 16.18 13.73 15.25 15.73 15.25H19.77C21.78 15.25 22.75 16.18 22.75 18.1V19.9C22.75 21.82 21.77 22.75 19.77 22.75ZM15.73 16.75C14.46 16.75 14.25 17.09 14.25 18.1V19.9C14.25 20.91 14.46 21.25 15.73 21.25H19.77C21.04 21.25 21.25 20.91 21.25 19.9V18.1C21.25 17.09 21.04 16.75 19.77 16.75H15.73Z" fill="#28353D"/>
                <path d="M8.27 22.75H4.23C2.22 22.75 1.25 21.82 1.25 19.9V13.1C1.25 11.18 2.23 10.25 4.23 10.25H8.27C10.28 10.25 11.25 11.18 11.25 13.1V19.9C11.25 21.82 10.27 22.75 8.27 22.75ZM4.23 11.75C2.96 11.75 2.75 12.09 2.75 13.1V19.9C2.75 20.91 2.96 21.25 4.23 21.25H8.27C9.54 21.25 9.75 20.91 9.75 19.9V13.1C9.75 12.09 9.54 11.75 8.27 11.75H4.23Z" fill="#28353D"/>
                <path d="M8.27 8.75H4.23C2.22 8.75 1.25 7.82 1.25 5.9V4.1C1.25 2.18 2.23 1.25 4.23 1.25H8.27C10.28 1.25 11.25 2.18 11.25 4.1V5.9C11.25 7.82 10.27 8.75 8.27 8.75ZM4.23 2.75C2.96 2.75 2.75 3.09 2.75 4.1V5.9C2.75 6.91 2.96 7.25 4.23 7.25H8.27C9.54 7.25 9.75 6.91 9.75 5.9V4.1C9.75 3.09 9.54 2.75 8.27 2.75H4.23Z" fill="#28353D"/>
            </svg>
            Области проектирования
        </a>
            
        <ul class="dropdown-menu" id="tagMenu">
            @foreach ($tags as $tag)
                <li><a class="dropdown-item" data-tag-id="{{ $tag->id }}">{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    </div>
    
       
    
    <ul class="ul_kniga">
        <li><a href="">Исследовать</a></li>
        <li><a href="{{ route('filter', ['role_model' => '1']) }}">Книги</a></li>
        <li><a href="{{ route('filter', ['role_model' => '2']) }}">Чертежи</a></li>
        <li><a href="{{ route('filter', ['role_model' => '3']) }}">Курсы</a></li>
        <li><a href="{{ route('filter', ['role_model' => '4']) }}">Нормативы</a></li>
        <li><a href="{{ route('filter', ['role_model' => '5']) }}">Расчёты</a></li>
    </ul>

    <div class="dropdown">
        <a class="btn_toogle_left dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><b>Сортировать</b> Популярные</a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
    
    <form class="d-none" id="filterForm" action="{{ route('filter') }}" method="GET">
        <input type="hidden" name="tag_id" id="selectedTagId" value="">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tagMenu a').on('click', function () {
                $('#selectedTagId').val($(this).data('tag-id'));
                
                $('#filterForm').submit();
            });
        });
    </script>
</nav>
@foreach ($filteredProducts->groupBy('role_model') as $roleModel => $groupedProducts)
    <div class="main_title d-flex my-4">
        @if ($roleModel == 1)
            <h4>Книги</h4>
            <a href="{{ route('filter', ['role_model' => 1])}})">Показать все</a>
        @elseif ($roleModel == 2)
            <h4>Чертежи</h4>
            <a href="{{ route('filter', ['role_model' => 2])}})">Показать все</a>
        @elseif ($roleModel == 3)
            <h4>Курсы</h4>
            <a href="{{ route('filter', ['role_model' => 3])}})">Показать все</a>
        @elseif ($roleModel == 4)
            <h4>Нормативы</h4>
            <a href="{{ route('filter', ['role_model' => 4])}})">Показать все</a>
        @elseif ($roleModel == 5)
            <h4>Расчёты</h4>
            <a href="{{ route('filter', ['role_model' => 5])}})">Показать все</a>
        @elseif ($roleModel == 6)
            <h4>Исследовать</h4>
            <a href="{{ route('filter', ['role_model' => 6])}})">Показать все</a>
        @endif
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