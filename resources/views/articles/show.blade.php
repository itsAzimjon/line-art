@extends('layouts.app')
@section('content')
<div class="row page3_cards">
    <div class="user_page_right d-flex  col-12">
        <div class="row ">
            <div class=" col-12">
                <img style="width: 1100px; height:300px; object-fit:cover" src="{{ asset('storage/' . json_decode($article->photo)[0]) }}" alt="">
            </div>
        </div>  
    </div>
</div>
<div class="user_page_left pb-3 col-12">
    @can('admin')
        <div class="d-flex">
            <a href="{{ route('article.edit', ['article' => $article->id]) }}" class="btn btn-outline-warning">Изменит</a>
            <form action="{{ route('product.destroy', ['product' => $article->id])}}" method="POST">
            @method('DELETE')
            @csrf
                <button class="btn btn-outline-danger" type="submit">Удалить</button>
            </form>
        </div>
    @endcan
    <div class="user_title mt-3 pt-0">
        <h1>{{ $article->title }}</h1>
    </div>
</div>
<div class="row block-center">
    <div class="col col-8">
        <p class="title_p">{!!nl2br (__($article->description)) !!}</p>
        <div class="row ">
            @foreach (array_slice(json_decode($article->photo), 1) as $image)
                <div class="col-6">
                    <img class="w-100" src="{{ asset('storage/' . $image) }}" alt="">
                </div>
            @endforeach
        </div>  
    </div>
    <div class="col col-4">
        <div class="user_btn d-flex mb-3">            
            <form action="{{ route('product.like', ['product' => $article->id]) }}" method="post">
                @csrf
                @php $userHasRated = false; @endphp
                @foreach ($article->raties as $r)
                    @if (auth()->check() && $r->user_id == auth()->user()->id)
                        @php $userHasRated = true; @endphp
                        <button class="btn btn-on btn-page3 border mx-1 position-relative" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <path d="M2.1087 7.08691H5.76087V15H2.1087C1.94726 15 1.79244 14.9358 1.67828 14.8217C1.56413 14.7075 1.5 14.5527 1.5 14.3913V7.69561C1.5 7.53417 1.56413 7.37935 1.67828 7.2652C1.79244 7.15104 1.94726 7.08691 2.1087 7.08691V7.08691Z" stroke="#ffffff" stroke-width="1.16" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.76074 7.08696L8.80422 1C9.12396 1 9.44057 1.06298 9.73597 1.18534C10.0314 1.3077 10.2998 1.48704 10.5259 1.71313C10.752 1.93922 10.9313 2.20763 11.0537 2.50303C11.176 2.79843 11.239 3.11504 11.239 3.43478V5.26087H15.9469C16.1195 5.26087 16.2902 5.29758 16.4475 5.36856C16.6049 5.43955 16.7453 5.54318 16.8596 5.67259C16.9738 5.802 17.0592 5.95422 17.1101 6.11916C17.1611 6.28409 17.1763 6.45797 17.1549 6.62926L16.2419 13.9336C16.2051 14.228 16.062 14.4989 15.8395 14.6953C15.6171 14.8916 15.3306 15 15.0339 15H5.76074" stroke="#ffffff" stroke-width="1.16" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                {{ $article->raties->count() }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                        @break
                    @endif
                @endforeach
    
                @if (!$userHasRated)
                    <button class="btn btn-white btn-page3 border mx-1 position-relative" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                            <path d="M2.1087 7.08691H5.76087V15H2.1087C1.94726 15 1.79244 14.9358 1.67828 14.8217C1.56413 14.7075 1.5 14.5527 1.5 14.3913V7.69561C1.5 7.53417 1.56413 7.37935 1.67828 7.2652C1.79244 7.15104 1.94726 7.08691 2.1087 7.08691V7.08691Z" stroke="#6D8493" stroke-width="1.16" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.76074 7.08696L8.80422 1C9.12396 1 9.44057 1.06298 9.73597 1.18534C10.0314 1.3077 10.2998 1.48704 10.5259 1.71313C10.752 1.93922 10.9313 2.20763 11.0537 2.50303C11.176 2.79843 11.239 3.11504 11.239 3.43478V5.26087H15.9469C16.1195 5.26087 16.2902 5.29758 16.4475 5.36856C16.6049 5.43955 16.7453 5.54318 16.8596 5.67259C16.9738 5.802 17.0592 5.95422 17.1101 6.11916C17.1611 6.28409 17.1763 6.45797 17.1549 6.62926L16.2419 13.9336C16.2051 14.228 16.062 14.4989 15.8395 14.6953C15.6171 14.8916 15.3306 15 15.0339 15H5.76074" stroke="#6D8493" stroke-width="1.16" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                            {{ $article->raties->count() }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                @endif
            </form>
            <form action="{{ route('product.save', ['product' => $article->id]) }}" method="post">
                @csrf
                @php $userHasRated = false; @endphp
                @foreach ($article->saves as $s)
                    @if (auth()->check() && $s->user_id == auth()->user()->id)
                        @php $userHasRated = true; @endphp
                        <button class="btn btn-on btn-page3 border mx-1" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="16" viewBox="0 0 13 16" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66406 1C1.9616 1 1.16719 1.68674 1.16719 7.21084C1.16719 13.3952 1.05159 15 2.22666 15C3.40098 15 5.31893 12.2855 6.66406 12.2855C8.0092 12.2855 9.92714 15 11.1015 15C12.2765 15 12.1609 13.3952 12.1609 7.21084C12.1609 1.68674 11.3665 1 6.66406 1Z" stroke="#ffffff" stroke-width="1.15688" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        @break
                    @endif
                @endforeach
    
                @if (!$userHasRated)
                    <button class="btn btn-white btn-page3 border mx-1" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="16" viewBox="0 0 13 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66406 1C1.9616 1 1.16719 1.68674 1.16719 7.21084C1.16719 13.3952 1.05159 15 2.22666 15C3.40098 15 5.31893 12.2855 6.66406 12.2855C8.0092 12.2855 9.92714 15 11.1015 15C12.2765 15 12.1609 13.3952 12.1609 7.21084C12.1609 1.68674 11.3665 1 6.66406 1Z" stroke="#6D8493" stroke-width="1.15688" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                @endif
            </form>
        </div>
        <h5>Метки</h5>
        @foreach ($article->tags as $tag)
            <button class="btn metka_btn border">{{ $tag->name }}</button>
        @endforeach
    </div>
</div>
{{-- <div class="row book_info">
    <div class="col col-12 d-flex justify-content-between">
        <p class="active">Похожие Статьи</p>
        <h6 class="center_h5">Последнее обновление: {{ $article->created_at->locale('ru')->diffForHumans() }}</h6>
    </div>
    <div class="row">
        @foreach ($articles as $article)
            <div class="col-2 mb-4">
                <a href="{{ route('article.show', ['article' => $article->id]) }}" class="card in">
                    <img src="{{ asset('storage/' . json_decode($article->photo)[0]) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title overflow-ellipsis">
                            {{ $article->title }}
                        </h5>
                        <span class="card-text">{{ $article->branch->name}} &nbsp;</span>
                       
                        <form action="{{ route('article.save', ['article' => $article->id]) }}" method="post">
                            @csrf
                            @php $userHasRated = false; @endphp
                            @foreach ($article->saves as $s)
                                @if (auth()->check() && $s->user_id == auth()->user()->id)
                                    @php $userHasRated = true; @endphp
                                    <button type="submit" class="float-end btn" style="margin: -27px 0 0 0">
                                         <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="#F57500" fill-rule="evenodd" clip-rule="evenodd" d="M8.48237 2.4541C4.37737 2.4541 3.68388 3.05311 3.68388 7.87152C3.68388 13.2658 3.58297 14.6656 4.60874 14.6656C5.63387 14.6656 7.30813 12.2979 8.48237 12.2979C9.65661 12.2979 11.3309 14.6656 12.356 14.6656C13.3818 14.6656 13.2809 13.2658 13.2809 7.87152C13.2809 3.05311 12.5874 2.4541 8.48237 2.4541Z" stroke="#F57500" stroke-width="1.15688" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    @break
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
</div> --}}


<div class="row comment mt-5">
    @if (auth()->check())
        <div class="col col-8 sent_comment ">
            <form action="{{ route('comment.store') }}" method="post">
                @csrf
                <div class="row">
                    @if (auth()->check() && auth()->user()->photo)
                        <div class="col-1">
                            <div class="col-1">
                                <img class="comment_user_img" src="{{ asset('storage/' . auth()->user()->photo ) }}">
                            </div>
                        </div>
                    @endif
                    <input type="hidden" name="article" value="{{ $article->id }}">
                    <div class="col-8">
                        <div class="form-floating">
                            <textarea name="body" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Добавить комментарий…</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn border btn-on">отправил</button>
                    </div>
                </div>    
            </form>
        </div>
    @endif
    <div class="form-comment scroll px-5">
        @foreach ($article->comments as $c)
            <div class="row">
                <div class="col-12 comment_user">
                    @if (auth()->check() && auth()->user()->photo)
                        <div class="col-1">
                            <img class="comment_user_img cui" src="{{ asset('storage/' . $c->user->photo ) }}" alt="">
                        </div>
                    @endif
                    <p class="comment_user_name">{{ $c->user->name }}</p>
                    <p class="comment_user_time">{{ $c->created_at->locale('ru')->diffForHumans() }}</p>
                </div>
                <div class="col-6 comment_text">
                    <p>{{ $c->body }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection