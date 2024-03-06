@extends('layouts.app')
@section('content')
<div class="row p-0 block mt-3">
        <x-left-side/>
    <div class="col-8 mx-3">
        <div class="row">
            <div>
                <h2 class="p-3 d-inline fw-bold">Статьи</h2>
                <a href="{{ route('article.create')}}" class="btn btn-primary float-end mt-2">+Add Articles</a>
            </div>
            @foreach ($products as $p)
                <div class="col-3 mb-4">
                    <a href="{{ route('article.show', ['article' => $p->id]) }}" class="card in">
                        <img src="{{ asset('storage/' . json_decode($p->photo)[0]) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title overflow-ellipsis">
                                {{ $p->title }}
                            </h5>
                            <span class="card-text d-inline-block text-truncate" style="max-width: 150px;">{{ $p->title}} &nbsp;</span>         
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection