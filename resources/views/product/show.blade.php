@extends('layouts.app')
@section('content')
<div class="row page3_cards">
    <div class="user_page_left col-4">
        @can('admin')
            <div class="d-flex">
                <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-outline-warning">Изменит</a>
                <form action="{{ route('product.destroy', ['product' => $product->id])}}" method="POST">
                @method('DELETE')
                @csrf
                    <button class="btn btn-outline-danger" type="submit">Удалить</button>
                </form>
            </div>
        @endcan
        <div class="user_title mt-5 pt-5">
            <h1>{{ $product->title }}</h1>
            @if ( $product->price == 0 || $product->price == null )
                <h4>Бесплатно</h4>
            @else
            <h4>цена: {{ $product->price }}</h4>
            @endif
            {{-- <p>{{ $product->category->name }}</p>   --}}
        </div>
        <div class="user_btn d-flex">
            <form action="{{ route('product.buy', ['product' => $product->id]) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-page3 btn_skachat  position-relative">
                    <svg class="btn_skachat_svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M7.75 2.1875V11.3906" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.39062 7.03125L7.75 11.3906L12.1094 7.03125" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.42188 13.3281H13.0781" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                        {{ $product->downloads->count() }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    Скачать
                </button>
                
            </form>
            <form action="{{ route('product.like', ['product' => $product->id]) }}" method="post">
                @csrf
                @php $userHasRated = false; @endphp
                @foreach ($product->raties as $r)
                    @if (auth()->check() && $r->user_id == auth()->user()->id)
                        @php $userHasRated = true; @endphp
                        <button class="btn btn-on btn-page3 border mx-1 position-relative" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <path d="M2.1087 7.08691H5.76087V15H2.1087C1.94726 15 1.79244 14.9358 1.67828 14.8217C1.56413 14.7075 1.5 14.5527 1.5 14.3913V7.69561C1.5 7.53417 1.56413 7.37935 1.67828 7.2652C1.79244 7.15104 1.94726 7.08691 2.1087 7.08691V7.08691Z" stroke="#ffffff" stroke-width="1.16" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.76074 7.08696L8.80422 1C9.12396 1 9.44057 1.06298 9.73597 1.18534C10.0314 1.3077 10.2998 1.48704 10.5259 1.71313C10.752 1.93922 10.9313 2.20763 11.0537 2.50303C11.176 2.79843 11.239 3.11504 11.239 3.43478V5.26087H15.9469C16.1195 5.26087 16.2902 5.29758 16.4475 5.36856C16.6049 5.43955 16.7453 5.54318 16.8596 5.67259C16.9738 5.802 17.0592 5.95422 17.1101 6.11916C17.1611 6.28409 17.1763 6.45797 17.1549 6.62926L16.2419 13.9336C16.2051 14.228 16.062 14.4989 15.8395 14.6953C15.6171 14.8916 15.3306 15 15.0339 15H5.76074" stroke="#ffffff" stroke-width="1.16" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                {{ $product->raties->count() }}
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
                            {{ $product->raties->count() }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                @endif
            </form>
            <form action="{{ route('product.save', ['product' => $product->id]) }}" method="post">
                @csrf
                @php $userHasRated = false; @endphp
                @foreach ($product->saves as $s)
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
    </div>
    <div class="user_page_right d-flex  col-8">
        <div class="row img_row_left">
            <div class="col col-12">
                @if ($product->branch_id == 3)
                    <?php
                        $url = $product->doc_number;
                        $videoId = str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $url);
                    ?>
                    <iframe width="600" height="315" src="{{ $videoId}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                @else
                    <img src="{{ asset('storage/' . json_decode($product->photo)[0]) }}" alt="">
                @endif
            </div>
        </div>  
        <div class="row img_row_right">
            @foreach (array_slice(json_decode($product->photo), 1) as $image)
                <div class="col">
                    <img src="{{ asset('storage/' . $image) }}" alt="">
                </div>
            @endforeach
        </div>  
    </div>
</div>
<div class="row book_info">
    <div class="col col-12 d-flex ">
        <p class="active">Информация о файле</p>
        {{-- <p>Комментарии</p> --}}
    </div>
</div>
<div class="row block-center">
    <div class="col col-8">
        <p class="title_p">{!!nl2br (__($product->description)) !!}</p>
    </div>
    <div class="col col-4">
        <h5>Метки</h5>
        @foreach ($product->tags as $tag)
            <button class="btn metka_btn border">{{ $tag->name }}</button>
        @endforeach

        {{-- <h5 class="link_h5">Поделиться</h5>
        <ul>
            <li><a href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.81738 15.1813L15.1813 8.81738" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.5909 16.7731L10.9392 19.4248C10.0953 20.2685 8.95077 20.7424 7.75743 20.7423C6.56409 20.7422 5.41965 20.2681 4.57583 19.4242C3.73201 18.5804 3.25791 17.436 3.25781 16.2426C3.25771 15.0493 3.73161 13.9048 4.57529 13.0608L7.22694 10.4092" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16.7731 13.5899L19.4248 10.9383C20.2685 10.0943 20.7424 8.94979 20.7423 7.75645C20.7422 6.56311 20.2681 5.41867 19.4243 4.57486C18.5804 3.73104 17.436 3.25694 16.2427 3.25684C15.0493 3.25673 13.9048 3.73064 13.0608 4.57431L10.4092 7.22596" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a></li>
            <li><a href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.25012 12.6446L16.6799 20.0628C16.7774 20.1486 16.8956 20.2076 17.0228 20.234C17.15 20.2605 17.2819 20.2534 17.4055 20.2135C17.5292 20.1737 17.6403 20.1024 17.7281 20.0066C17.8159 19.9108 17.8774 19.7939 17.9064 19.6673L21.4327 4.27983C21.4632 4.14679 21.4568 4.00796 21.4142 3.87828C21.3716 3.74861 21.2944 3.63302 21.191 3.54396C21.0876 3.4549 20.9618 3.39576 20.8272 3.3729C20.6927 3.35004 20.5544 3.36433 20.4274 3.41424L3.12517 10.2115C2.97438 10.2708 2.84683 10.3773 2.76159 10.515C2.67636 10.6528 2.63803 10.8145 2.65235 10.9759C2.66666 11.1372 2.73285 11.2896 2.841 11.4103C2.94915 11.5309 3.09346 11.6133 3.25233 11.645L8.25012 12.6446Z" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.25 12.6446L21.0105 3.42871" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.46 16.3494L9.53033 19.2791C9.42544 19.384 9.2918 19.4554 9.14632 19.4843C9.00083 19.5133 8.85003 19.4984 8.71299 19.4416C8.57594 19.3849 8.45881 19.2888 8.3764 19.1654C8.29399 19.0421 8.25 18.8971 8.25 18.7487V12.6445" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a></li>
            <li><a href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25895 16.5939C3.14076 14.7089 2.74916 12.4805 3.15768 10.3272C3.56621 8.1739 4.74675 6.2438 6.47764 4.89933C8.20852 3.55486 10.3707 2.8885 12.5581 3.02539C14.7455 3.16227 16.8078 4.09298 18.3575 5.64274C19.9073 7.19251 20.838 9.25472 20.9749 11.4421C21.1118 13.6296 20.4455 15.7917 19.101 17.5226C17.7565 19.2535 15.8264 20.4341 13.6732 20.8426C11.5199 21.2511 9.29149 20.8596 7.40649 19.7414L7.40651 19.7413L4.29808 20.6294C4.16948 20.6662 4.03338 20.6678 3.90391 20.6343C3.77443 20.6007 3.65628 20.5332 3.56171 20.4386C3.46713 20.344 3.39956 20.2259 3.36601 20.0964C3.33246 19.9669 3.33415 19.8308 3.37089 19.7022L4.25902 16.5938L4.25895 16.5939Z" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.2607 17.25C13.274 17.2514 12.2967 17.0581 11.3848 16.6811C10.4729 16.3042 9.64441 15.751 8.9467 15.0533C8.24899 14.3556 7.69582 13.5271 7.31887 12.6152C6.94192 11.7033 6.74861 10.726 6.75001 9.73934C6.75224 9.04482 7.02986 8.37953 7.52196 7.88943C8.01406 7.39932 8.68047 7.12441 9.375 7.125V7.125C9.48892 7.125 9.60081 7.15512 9.69934 7.21229C9.79787 7.26947 9.87953 7.35168 9.93605 7.45059L11.0321 9.36865C11.0982 9.48432 11.1323 9.61551 11.1309 9.74873C11.1294 9.88195 11.0926 10.0124 11.024 10.1266L10.1438 11.5937C10.5967 12.5986 11.4014 13.4033 12.4063 13.8562V13.8562L13.8734 12.976C13.9876 12.9074 14.118 12.8706 14.2513 12.8691C14.3845 12.8677 14.5157 12.9018 14.6313 12.9679L16.5494 14.064C16.6483 14.1205 16.7305 14.2021 16.7877 14.3007C16.8449 14.3992 16.875 14.5111 16.875 14.625V14.625C16.873 15.3187 16.5973 15.9837 16.1077 16.4752C15.6182 16.9667 14.9544 17.2452 14.2607 17.25V17.25Z" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a></li>
            <li><a href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75Z" stroke="#6D8493" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M16.125 3.375H7.875C5.38972 3.375 3.375 5.38972 3.375 7.875V16.125C3.375 18.6103 5.38972 20.625 7.875 20.625H16.125C18.6103 20.625 20.625 18.6103 20.625 16.125V7.875C20.625 5.38972 18.6103 3.375 16.125 3.375Z" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16.875 8.25C17.4963 8.25 18 7.74632 18 7.125C18 6.50368 17.4963 6 16.875 6C16.2537 6 15.75 6.50368 15.75 7.125C15.75 7.74632 16.2537 8.25 16.875 8.25Z" fill="#6D8493"/>
                </svg>
            </a></li>
            <li><a href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.75 8.25H14.25C13.6533 8.25 13.081 8.48705 12.659 8.90901C12.2371 9.33097 12 9.90326 12 10.5V21" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 13.5H15" stroke="#6D8493" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a></li>
        </ul> --}}
    </div>
</div>
<div class="row book_info">
    <div class="col col-12 d-flex justify-content-between">
        <p class="active">Похожие файлы</p>
        <h6 class="center_h5">Последнее обновление: {{ $product->created_at->locale('uz')->diffForHumans() }}</h6>
    </div>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-2 mb-4">
                <a href="{{ route('product.show', ['product' => $product->id]) }}" class="card in">
                    <img src="{{ asset('storage/' . json_decode($product->photo)[0]) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title overflow-ellipsis">
                            {{ $product->title }}
                        </h5>
                        <span class="card-text">{{ $product->branch->name}} &nbsp;</span>
                       
                        <form action="{{ route('product.save', ['product' => $product->id]) }}" method="post">
                            @csrf
                            @php $userHasRated = false; @endphp
                            @foreach ($product->saves as $s)
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
</div>


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
                    <input type="hidden" name="product" value="{{ $product->id }}">
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
        @foreach ($product->comments as $c)
            <div class="row">
                <div class="col-12 comment_user">
                    @if (auth()->check() && auth()->user()->photo)
                        <div class="col-1">
                            <img class="comment_user_img cui" src="{{ asset('storage/' . $c->user->photo ) }}" alt="">
                        </div>
                    @endif
                    <p class="comment_user_name">{{ $c->user->name }}</p>
                    <p class="comment_user_time">{{ $c->created_at->locale('uz')->diffForHumans() }}</p>
                </div>
                <div class="col-6 comment_text">
                    <p>{{ $c->body }}</p>
                </div>
            </div>
            @if (auth()->check())
                @if (auth()->user()->id == $c->user->id || auth()->user()->role_id == 1)
                <form action="{{ route('comment.destroy', ['comment' => $c->id ])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn fw-bold btn-sm btn-outline-danger mx-5">
                        Удалить
                    </button>
                </form>
                @endif
            @endif
        @endforeach
    </div>
</div>
@endsection