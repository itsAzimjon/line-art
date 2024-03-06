<div class="col col-3 cls_p3">
    <div class="right-header">
        <h6 class="mb-4 mt-4">Новости</h6>
        @can('admin')
            <a href="{{ route('na.create',  ['role' =>'2'])}}" class="btn btn-primary mt-2">+Add News</a>
        @endcan
        @foreach (App\Models\Product::latest()->where('branch_id', 'like', '2')->take(5)->get() as $news)
        <a href="{{ route('article.show', ['article' => $news->id])}}" class="card text-bg-dark" style="height: 100px">
            <div style="position: relative;">
                <img src="{{ asset('storage/' . json_decode($news->photo)[0]) }}" class="card-img" style="height: 100px; object-fit: cover;" alt="...">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
            </div>
            <div class="card-img-overlay">
                <h5 class="card-title col-12 text-truncate">{{ $news->title }}</h5>
                <p class="card-text  col-12 text-truncate">{{ $news->description }}</p>
                <p class="card-text"><small>{{ $news->created_at->locale('uz')->diffForHumans() }}</small></p>
            </div>
        </a>
        @endforeach
        
        @foreach (App\Models\Forum::latest()->take(5)->get() as $forum)
            <a href="{{ route('forum.show', ['forum' => $forum->id]) }}">
                <div class="right-inner mt-3">
                    <div class="right-news">
                        <h6 class="col-12 text-truncate text-dark">{{ $forum->title }}</h6>
                        <p>{{ $forum->user->name }} • {{ \Carbon\Carbon::parse($forum->created_at)->locale('uz')->isoFormat('D MMMM HH:mm', 'Do MMMM HH:mm') }}</p>
                    </div>
                    <div class="right-button">
                        <div class="card_center_block">
                            <button class="btn">{{ $forum->tag->name }}</button>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>