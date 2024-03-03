<div class="col col-3 cls_p3">
    <div class="right-header">
        <a href="{{ route('forum.create')}}" class="fw-semibold btn-on btn-lg btn ml-4" style="font-size: 14px">Задавать вопрос</a>
        <h6 class="mb-4 mt-4">Последние сообщения</h6>
        @foreach (App\Models\Forum::latest()->take(5)->get() as $forum)
            <a href="{{ route('forum.show', ['forum' => $forum->id]) }}">
                <div class="right-inner mt-3">
                    <div class="right-news">
                        <h6 class="col-12 text-truncate text-dark">{{ $forum->title }}</h6>
                        <p>{{ $forum->user->name }} • {{ \Carbon\Carbon::parse($forum->created_at)->locale('ru')->isoFormat('D MMMM HH:mm', 'Do MMMM HH:mm') }}</p>
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