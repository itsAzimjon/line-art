<div class="row cls_comment mt-1 mb-4">
    <div class="col">
        <div class="row">
            @if (auth()->check() && auth()->user()->photo)
            <div class="col-1">
                    <img class="comment_user_img cls_page3" src="{{ asset('storage/' . auth()->user()->photo)}}">
                </div>
            @endif
            <form class="d-flex" action="{{ route('filter.forum') }}" method="GET">
                <div class="col-8 cls_p3_input">
                    <div class="input-group">
                        <input name="forum" type="text" class="form-control" placeholder="Поиск по форумам">
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn border btn_sent cls3">Найти</button>
                </div>
            </form>
        </div>    
    </div>
</div>