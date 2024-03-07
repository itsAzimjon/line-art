<div class="col col-2 cls_p3">
    <div class="cls_info">
        <h6 class="mt-2 mb-2">Популярные разделы</h6>
        @foreach (App\Models\Tag::inRandomOrder()->take(5)->get() as $tag)
            <a href="{{ route('tag.show', ['tag' => $tag->id])}}">
                <div class="cls_info-text">
                    <h6>{{ $tag->name}}</h6>
                    <p>{{ $tag->forums->count() }}  Форумы</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="cls_block">
        <h6 class="mt-5 mb-3">Топ статьи и файлы</h6>
      
        @foreach (App\Models\Product::orderByDesc('view')->take(5)->get() as $product)
            <a href="{{ route('product.show', ['product' => $product->id]) }}">
                <div class="cls_block-text mt-3 mb-3">
                    <div class="block_left">
                        <img style="object-fit:cover" src="{{ asset('storage/' . json_decode($product->photo)[0]) }}">
                    </div>
                    <div class="block_right">
                        <h6 class="d-inline-block text-truncate" style="max-width: 120px;">{{ $product->title}}.</h6>
                        <p>{{ $product->raties->count() }} лайк  • {{ $product->branch->name}}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>