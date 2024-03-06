@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <x-search-forum/>
        <div class="notifications">
            <h2>Уведомления</h2>
            @foreach (auth()->user()->forums as $forum)
                <a href="{{ route('forum.show', ['forum'=>$forum->id])}}" class="row mt-4 mb-4">
                    <div class="col-1 notif_left">
                        <p>{{ $forum->replies->count() }}</p>
                    </div>
                    <div class="col-11 notif_right">
                        <h3 class="col-10 text-truncate">{{ $forum->title}}</h3>
                        <p class="col-12 text-truncate">{{ $forum->description}}</span> <span class="time">
                            <p>{{ \Carbon\Carbon::parse($forum->created_at)->locale('uz')->isoFormat('D MMMM HH:mm', 'Do MMMM HH:mm') }}</p>
                        </span></p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <x-right-side/>
</div>
@endsection

       