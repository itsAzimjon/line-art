@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <x-search-forum/>
        <div class="links mb-3">
            <a href="#">{{ $forum->tag->category->name }} <svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.128 0.86H1.508L4.412 3.608L1.508 6.368H0.128L3.032 3.608L0.128 0.86Z" fill="#444750"/></svg></a>
            <a href="#">{{ $forum->tag->name }} <svg width="5" height="7" viewBox="0 0 5 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.128 0.86H1.508L4.412 3.608L1.508 6.368H0.128L3.032 3.608L0.128 0.86Z" fill="#444750"/></svg></a>
            <a href="#"  class="d-inline-block text-truncate pb-2" style="max-width: 150px; height:17px">{{ $forum->title }} </a>
        </div>
        <div class="cls_card">
            <div class="cls_cards p-3 mt-2 mb-2">
                <div class="card_top">
                    @if ($forum->user->photo != null)
                        <div class="user_img">
                            <img src="{{ asset('storage/' . $forum->user->photo )}}" alt="">
                        </div>
                    @endif
                    <div class="user_name">
                        <h6>{{ $forum->user->name}}</h6>
                        <p>{{ \Carbon\Carbon::parse($forum->created_at)->locale('uz')->isoFormat('D MMMM HH:mm', 'Do MMMM HH:mm') }}</p>
                    </div>
                    <div class="user_lavel">
                        <h6>{{ $forum->user->job}}</h6>
                        {{-- <h6>{{ $forum->user->experience}} год стажа</h6> --}}
                    </div>
                    <div class="user_date">
                    </div>
                </div>
                <div class="card_center mx-1 py-3">
                    <h3 class="pb-2">{{ strip_tags($forum->title) }}</h3>
                    <p>{!! nl2br(strip_tags($forum->description)) !!}</p>
                </div>
                <div class="card_top mt-1">
                    <div class="card_top_content">
                        <form action="{{ route('forumlike.store', ['forumlike' => $forum->id]) }}" method="POST">
                        @csrf
                            @if (Auth::check() && count(auth()->user()->forumlikes)>0 )
                                <input type="hidden" name="forum_id" value="{{ $forum->id}}">
                                <button class="btn card_top_btn bg-light text-secondary border">
                                    <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 13.9557V4.03906" stroke="gray" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.125 8.9974L7.5 4.03906L11.875 8.9974" stroke="gray" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                    Голосовать
                                </button>
                            @else
                                <input type="hidden" name="forum_id" value="{{ $forum->id}}">
                                <button type="submit" class="btn card_top_btn">
                                    <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 13.9557V4.03906" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.125 8.9974L7.5 4.03906L11.875 8.9974" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                    Голосовать
                                </button>
                            @endif
                        </form>
                        <p class="m-1 px-2"><svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 8.125C10.5 8.41232 10.3946 8.68787 10.2071 8.89103C10.0196 9.0942 9.76522 9.20833 9.5 9.20833H3.5L1.5 11.375V2.70833C1.5 2.42102 1.60536 2.14547 1.79289 1.9423C1.98043 1.73914 2.23478 1.625 2.5 1.625H9.5C9.76522 1.625 10.0196 1.73914 10.2071 1.9423C10.3946 2.14547 10.5 2.42102 10.5 2.70833V8.125Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> {{ $forum->replies->count() }} сообщений
                        </p>
                        <p class="m-1 px-2"><svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.5 6.4974C0.5 6.4974 2.5 2.16406 6 2.16406C9.5 2.16406 11.5 6.4974 11.5 6.4974C11.5 6.4974 9.5 10.8307 6 10.8307C2.5 10.8307 0.5 6.4974 0.5 6.4974Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 8.125C6.82843 8.125 7.5 7.39746 7.5 6.5C7.5 5.60254 6.82843 4.875 6 4.875C5.17157 4.875 4.5 5.60254 4.5 6.5C4.5 7.39746 5.17157 8.125 6 8.125Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> {{ $forum->views }} просмотров
                        </p>
                    </div>
                </div>
            </div>
            @can('user', $forum,)
                <div class="my-3 d-flex">
                    <a href="{{ route('forum.edit', ['forum' => $forum->id ])}}" class="btn fw-bold btn-sm btn-outline-warning">
                        Изменить
                    </a>
                    <form id="deleteForm" action="{{ route('forum.destroy', ['forum' => $forum->id ])}}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button type="button" class="btn fw-bold btn-sm btn-outline-danger" onclick="confirmDelete()">
                            Удалить
                        </button>
                    </form>
                </div>
            @endcan
            <div class="card_top_in_center">
                <form action="{{ route('reply.store')}}" method="POST">
                @csrf
                    <div class="row cls_comment mt-1">
                        <div class="col">
                            <div class="row">
                                @if (auth()->check() && auth()->user()->photo)
                                    <div class="col-1">
                                        <img class="comment_user_img cls_page3" src="{{ asset('storage/' . auth()->user()->photo)}}">
                                    </div>
                                @endif
                                <div class="col-8 cls_p3_input">
                                    <div class="input-group flex-nowrap">
                                        <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                        <textarea required name="comment" class="form-control" placeholder="Написать ответ..." aria-label="Username" aria-describedby="addon-wrapping"></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn border btn_sent cls3">Ответить</button>
                                </div>
                            </div>    
                        </div>
                    </div>
                </form>
                @foreach ($forum->replies->sortByDesc('true_answer') as $reply)                    
                    <div class="row block_coment mt-5 mb-4 {{ $reply->true_answer == 1 ? 'true-reply' : ''}}">
                        @if ($reply->true_answer == 1)
                            <span class="material-symbols-outlined checked px-1">
                                check
                            </span>
                        @endif
                        @if (auth()->check() && auth()->user()->role_id != 4)
                        <form action="{{ route('check', ['reply' => $reply->id])}}" method="POST">
                            @method('PUT')
                            @csrf
                                <button type="submit">
                                    <span class="material-symbols-outlined check px-1">
                                        check
                                    </span>
                                </button>
                            </form>
                        @endif
                        <div class="col-1 block_coment_left mr-5">
                            <form action="{{ route('replylike.store', ['replyLike' => $reply->id]) }}" method="POST">
                            @csrf
                                <input type="hidden" name="reply_id" value="{{ $reply->id }}">
                                <button type="submit" class="h1" type="button">+</button>
                            </form>
                            <h1>{{ $reply->replulikes->count() }}</h1>
                            @foreach ($reply->replulikes as $replylike)
                                @if (auth()->check() && auth()->user()->id == $replylike->user_id)
                                    <form action="{{ route('replylike.destroy', ['replylike' => $replylike->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h1 btn-sm mt-1">-</button>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="col-10 block_coment_right ml-5">
                            <div class="cls_coment_cards p-2 mt-2 mb-2">
                                <div class="card_top">
                                    @if ($reply->user->photo != null)
                                        <div class="user_img">
                                            <img src="{{ asset('storage/' . $reply->user->photo)}}" alt="">
                                        </div>
                                    @endif
                                    <div class="user_name">
                                        <h6>{{ $reply->user->name }}</h6>
                                        <p>{{ $reply->user->job }}</p>
                                    </div>
                                    {{-- <div class="user_lavel">
                                        <h6>Модератор</h6>
                                    </div> --}}
                                    <div class="user_date m-1">
                                        <p>{{ \Carbon\Carbon::parse($reply->created_at)->locale('uz')->isoFormat('D MMMM HH:mm', 'Do MMMM HH:mm') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p>{!!nl2br (__($reply->comment)) !!}</p>
                                </div>
                                <div class="card_top mt-1">
                                    <div class="card_top_content">
                                        @if (count($reply->replytoreplies) > 0)
                                            <button class="btn m-0 p-1" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $reply->id }}" aria-expanded="false" aria-controls="collapseExample">
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8.125C10.5 8.41232 10.3946 8.68787 10.2071 8.89103C10.0196 9.0942 9.76522 9.20833 9.5 9.20833H3.5L1.5 11.375V2.70833C1.5 2.42102 1.60536 2.14547 1.79289 1.9423C1.98043 1.73914 2.23478 1.625 2.5 1.625H9.5C9.76522 1.625 10.0196 1.73914 10.2071 1.9423C10.3946 2.14547 10.5 2.42102 10.5 2.70833V8.125Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg> {{ $reply->replytoreplies->count() }} ответа
                                            </button>
                                        @endif
                                        <button class="btn m-0 p-1 mx-2" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $reply->id }}" aria-expanded="false" aria-controls="collapseExample">
                                            <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.79216 4.1708L4.22974 1.11754C4.53064 0.850254 5.00488 1.06724 5.00488 1.48243V3.09064C8.14216 3.12759 10.6299 3.77433 10.6299 6.83243C10.6299 8.06673 9.85682 9.28952 9.00228 9.92883C8.73562 10.1283 8.35558 9.87794 8.4539 9.55456C9.33952 6.64138 8.03384 5.86798 5.00488 5.82314V7.58929C5.00488 8.00514 4.53028 8.22116 4.22974 7.95419L0.79216 4.90061C0.57594 4.70852 0.57564 4.36317 0.79216 4.1708Z" stroke="#858EAD"/>
                                            </svg> Ответить
                                        </button>
                                        @if (auth()->check())
                                            @if (auth()->user()->id == $reply->user->id || auth()->user()->role_id == 1)
                                            <form action="{{ route('reply.destroy', ['reply' => $reply->id ])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn fw-bold btn-sm btn-outline-danger mx-5">
                                                    Удалить
                                                </button>
                                            </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12 block_coment_center">
                            <p class="d-inline-flex gap-1"></p>
                            <div class="collapse" id="collapseExample{{ $reply->id }}">
                                <form action="{{ route('replytoreply.store')}}" method="POST">
                                    @csrf
                                    <div class="row cls_comment mt-1">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-1">
                                                </div>
                                                <div class="col-8 cls_p3_input">
                                                    <div class="input-group flex-nowrap">
                                                        <input type="hidden" name="reply_id" value="{{ $reply->id }}">
                                                        <textarea required name="comment" class="form-control" placeholder="Написать ответ..." aria-label="Username" aria-describedby="addon-wrapping"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn border mx-0 btn_sent cls3">Отвечать</button>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </form>
                                @foreach ($reply->replytoreplies as $r2r)    
                                    <div class="row com_cards_block">
                                        <div class="col-2"></div>
                                        <div class="col-10 cls_coment_cards p-2 mt-2 mb-2">
                                            <div class="card_top">
                                                <div class="user_img">
                                                    @if ($r2r->user->photo !== null)
                                                        <img src="{{ asset('storage/' . $r2r->user->photo)}}">
                                                    @endif
                                                </div>
                                                <div class="user_name">
                                                    <h6>{{ $r2r->user->name }}</h6>
                                                    <p>{{ $r2r->user->job }}</p>
                                                </div>
                                                <div class="user_date">
                                                    <p>{{ \Carbon\Carbon::parse($r2r->created_at)->locale('uz')->isoFormat('D MMMM HH:mm', 'Do MMMM HH:mm') }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <p><span class="user_nick"></span>{!!nl2br (__($r2r->comment)) !!}</p>
                                                @if (auth()->check())
                                                    @if (auth()->user()->id == $reply->user->id || auth()->user()->role_id == 1)
                                                        <form action="{{ route('replytoreply.destroy', ['replytoreply' => $r2r->id ])}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn fw-bold btn-sm btn-outline-danger mx-5">
                                                                Удалить
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach  
            </div>
        </div>
    </div>


    <div class="col col-3 cls_p3">
        <div class="right-header">
            <div class="comet_users p-3 mt-1 mb-2">
                <div class="coment_users_block">
                    <div class="coment_users_block_left">
                        @if ($forum->user->photo != null)
                            <img src="{{'storage/' . $forum->user->photo }}" alt="">
                            <h5>@usomatura</h5>
                        @endif
                    </div>
                    <div class="coment_users_block_right">
                        <h3 class="users_name">Усама Тураев</h3>
                        <p class="users_works">Конструктор</p>
                        <p class="users_otvet">Кол-во ответов: 64</p>
                        <p class="users_time">На сайте:</p>
                        <p class="users_staj">0 год стажа</p>
                    </div>
                </div>
            </div>
            <div class="right-inner mt-3">
                <div class="right-news">
                    <h6>Заземление при капремонте зданий с пересечен..</h6>
                    <p>UIHUT  •  Сегодня в 12:40</p>
                </div>
                <div class="right-button">
                    <div class="card_center_block">
                        <button class="btn">Технология</button>
                        <button class="btn">Металлургия</button>
                        <button class="btn">Общее вопросы</button>
                    </div>
                </div>
            </div>
            <!-- nusxa olinadi -->
                <div class="right-inner mt-3">
                    <div class="right-news">
                        <h6>Заземление при капремонте зданий с пересечен..</h6>
                        <p>UIHUT  •  Сегодня в 12:40</p>
                    </div>
                    <div class="right-button">
                        <div class="card_center_block">
                            <button class="btn">Технология</button>
                            <button class="btn">Металлургия</button>
                            <button class="btn">Общее вопросы</button>
                        </div>
                    </div>
                </div>
                <div class="right-inner mt-3">
                    <div class="right-news">
                        <h6>Заземление при капремонте зданий с пересечен..</h6>
                        <p>UIHUT  •  Сегодня в 12:40</p>
                    </div>
                    <div class="right-button">
                        <div class="card_center_block">
                            <button class="btn">Технология</button>
                            <button class="btn">Металлургия</button>
                            <button class="btn">Общее вопросы</button>
                        </div>
                    </div>
                </div>
                <div class="right-inner mt-3">
                    <div class="right-news">
                        <h6>Заземление при капремонте зданий с пересечен..</h6>
                        <p>UIHUT  •  Сегодня в 12:40</p>
                    </div>
                    <div class="right-button">
                        <div class="card_center_block">
                            <button class="btn">Технология</button>
                            <button class="btn">Металлургия</button>
                            <button class="btn">Общее вопросы</button>
                        </div>
                    </div>
                </div>
                <div class="right-inner mt-3">
                    <div class="right-news">
                        <h6>Заземление при капремонте зданий с пересечен..</h6>
                        <p>UIHUT  •  Сегодня в 12:40</p>
                    </div>
                    <div class="right-button">
                        <div class="card_center_block">
                            <button class="btn">Технология</button>
                            <button class="btn">Металлургия</button>
                            <button class="btn">Общее вопросы</button>
                        </div>
                    </div>
                </div>
            <!-- nusxa olinadi -->
        </div>
    </div>
@endsection
