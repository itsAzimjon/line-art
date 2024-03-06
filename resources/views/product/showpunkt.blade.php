@extends('layouts.app')
@section('content')
<div class="row p-0 mt-3">
    @php
        $theme = $products->first();
    @endphp
    @if (isset($theme) && !empty($theme))
        <div class="my-3">
            <h2 class="my-">{{ $theme->branch->name }}</h2>
            <p>{{ $theme->tags->first()->name }}</p>
        </div>
    @endif
    
    @foreach ($products as $p)
    <div class="col-2 mb-4">
        <a href="{{ route('product.show', ['product' => $p->id]) }}" class="card in">
            <img src="{{ asset('storage/' . json_decode($p->photo)[0]) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title overflow-ellipsis">
                    {{ $p->title }}
                </h5>
                @if ( $p->price == 0 || $p->price == null )
                    <span class="card-text">Бесплатно &nbsp;</span>         
                @else
                <span class="card-text">цена: {{ $p->price }} &nbsp;</span>         
                @endif
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