@extends('layouts.app')
@section('content')
    <div class="row mt-3">
        <x-left-side/>
        <div class="col col-7 cls_p3">
            <x-search-forum/>
            <div class="links mt-1">
                <a href="#">Форум <svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.128 0.86H1.508L4.412 3.608L1.508 6.368H0.128L3.032 3.608L0.128 0.86Z" fill="#444750"/></svg></a>
                <a href="#">{{ $category->name }} </a>
            </div>
            <h2 class="mb-4 fw-semibold">{{ $category->name }}</h2>
            <div class="cls_card">
                @foreach ($category->tags as $tag)
                <a href="{{ route('tag.show', ['tag' => $tag->id])}}">
                    <div class="cls_cards p-3 mt-2 mb-2">
                        <div class="card_top">
                            <p>
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 8.125C11 8.41232 10.8946 8.68787 10.7071 8.89103C10.5196 9.0942 10.2652 9.20833 10 9.20833H4L2 11.375V2.70833C2 2.42102 2.10536 2.14547 2.29289 1.9423C2.48043 1.73914 2.73478 1.625 3 1.625H10C10.2652 1.625 10.5196 1.73914 10.7071 1.9423C10.8946 2.14547 11 2.42102 11 2.70833V8.125Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> {{ $tag->forums->count()}} тем
                            </p>
                        </div>
                        <div class="card_center">
                            <h3 class="fw-semibold">{{ $tag->name }}</h3>
                        </div>
                        <div class="card_bottom mt-1">
                            <p>Последнее сообщение</p>
                            @foreach ($tag->forums()->latest()->take(1)->get() as $forum)
                                <p class="border border-light-subtle p-1 px-2 rounded-3 col-12 text-truncate">
                                    {{ $forum->user->name }} • 
                                    <span class="d-inline-block text-truncate mx-3" style="max-width: 60%; height: 14px;">
                                        {{ $forum->title }}
                                    </span> • 
                                    {{ $forum->created_at }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </a>
                @endforeach
                <button type="button" style="font-size: 16px" class="btn btn-on mb-0 col-12" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add Tag
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <x-tag-create>
                        {{ $category->id }}
                    </x-tag-create>
                </div>
            </div>
        </div>
        <x-right-side/>

    </div>
@endsection
