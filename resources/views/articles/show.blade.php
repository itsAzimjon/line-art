@extends('layouts.app')
@section('content')
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
    <div class="user_title my-4 pt-0">
        <h1>{{ $article->title }}</h1>
    </div>
</div>
<div class="row block-center">
    <div class="col col-8">
        <div class="user_page_right d-flex  col-12">
            <div class="row ">
                <div class=" col-8">
                    <img style="width: 750px; height:400px; object-fit:cover" src="{{ asset('storage/' . json_decode($article->photo)[0]) }}" alt="">
                </div>
            </div>  
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
        <hr>
        @if (!empty($article->author))
            <h5 class="mt-2">Автор</h5>
            <b class="p-2">{!!nl2br (__($article->author)) !!} </b> 
        @endif
    </div>
    <div class="col-12">
        <p class="title_p">{!!nl2br (__($article->description)) !!}</p>
        <div class="row ">
            @foreach (array_slice(json_decode($article->photo), 1) as $image)
                <div class="col-6 my-3">
                    <img class="w-100" src="{{ asset('storage/' . $image) }}" alt="">
                </div>
            @endforeach
        </div> 
    </div>
</div>
@endsection