@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <x-search-forum/>
        <div class="links mt-1">
            <a href="#">{{ $tag->category->name }} <svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.128 0.86H1.508L4.412 3.608L1.508 6.368H0.128L3.032 3.608L0.128 0.86Z" fill="#444750"/></svg></a>
            <a href="#">{{ $tag->name }} </a>
        </div>
        <h2 class="mb-4 fw-semibold">{{ $tag->name }}</h2>
        <div class="cls_card">
            @foreach ($tag->forums as $forum)    
            <a href="{{ route('forum.show', ['forum' => $forum->id]) }}">
                <div class="cls_cards p-3 mt-2 mb-2">
                    <div class="card_top">
                        <p>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.25 11.5C9.1495 11.5 11.5 9.1495 11.5 6.25C11.5 3.35051 9.1495 1 6.25 1C3.35051 1 1 3.35051 1 6.25C1 9.1495 3.35051 11.5 6.25 11.5Z" stroke="#858EAD" stroke-miterlimit="10"/>
                                <path d="M6.24969 8C7.45782 8 8.43719 7.02062 8.43719 5.8125C8.43719 4.60438 7.45782 3.625 6.24969 3.625C5.04157 3.625 4.06219 4.60438 4.06219 5.8125C4.06219 7.02062 5.04157 8 6.24969 8Z" stroke="#858EAD" stroke-miterlimit="10"/>
                                <path d="M2.73877 10.1533C3.06832 9.50534 3.57074 8.96124 4.19041 8.5812C4.81008 8.20116 5.52283 8 6.24975 8C6.97668 8 7.68942 8.20115 8.30909 8.58119C8.92876 8.96123 9.43119 9.50532 9.76074 10.1533" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> {{ $forum->user->name}}
                        </p>
                        <p>
                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.5 10.2943V2.71094" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3 6.5026L6.5 2.71094L10 6.5026" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> {{ $forum->forumlikes->count() }}
                        </p>
                    </div>
                    <div class="card_center">
                        <h3 class="fw-semibold">{{ $forum->title}}</h3>
                        <p class="text-secondary">{{ $forum->description }}</p>
                    </div>
                    <div class="card_top mt-1">
                        <p><svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 8.125C10.5 8.41232 10.3946 8.68787 10.2071 8.89103C10.0196 9.0942 9.76522 9.20833 9.5 9.20833H3.5L1.5 11.375V2.70833C1.5 2.42102 1.60536 2.14547 1.79289 1.9423C1.98043 1.73914 2.23478 1.625 2.5 1.625H9.5C9.76522 1.625 10.0196 1.73914 10.2071 1.9423C10.3946 2.14547 10.5 2.42102 10.5 2.70833V8.125Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> {{ $forum->replies->count() }} сообщений
                        </p>
                        <p><svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.5 6.4974C0.5 6.4974 2.5 2.16406 6 2.16406C9.5 2.16406 11.5 6.4974 11.5 6.4974C11.5 6.4974 9.5 10.8307 6 10.8307C2.5 10.8307 0.5 6.4974 0.5 6.4974Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 8.125C6.82843 8.125 7.5 7.39746 7.5 6.5C7.5 5.60254 6.82843 4.875 6 4.875C5.17157 4.875 4.5 5.60254 4.5 6.5C4.5 7.39746 5.17157 8.125 6 8.125Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> {{ $forum->views }} просмотров
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <x-right-side/>
</div>
@endsection
