@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <h2 class="mb-4 fw-semibold">{{ $category->name }}</h2>
        <div class="cls_card">
            @foreach ($category->tags->sortByDesc('views') as $tag)
            <form action="{{ route('product.showpunkt', ['tag' => $tag->id, 'branch' => $branch])}}" >
                <button class="btn text-start col-12 m-0">
                    <div class="cls_cards p-3">
                        <div class="card_top">
                            <p>
                                <svg width="16" height="16" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4522 7L10.2452 7.47905C9.91092 8.25243 9.82691 9.10637 10.0043 9.92729C10.275 11.1799 11.3011 12.1473 12.5976 12.3723L12.7117 12.3921C13.1229 12.4635 13.5438 12.4635 13.955 12.3921L14.0691 12.3723C15.3656 12.1473 16.3917 11.1799 16.6624 9.92729C16.8398 9.10637 16.7558 8.25243 16.4215 7.47905L16.2145 7" stroke="#858EAD" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M21.7926 15.143C21.2059 17.6504 19.2004 19.6204 16.6287 20.2251C14.4674 20.7334 12.1998 20.7334 10.0385 20.2251C7.46675 19.6204 5.46125 17.6504 4.87455 15.143C4.35034 12.9026 4.47783 10.5648 5.24276 8.39084L5.3564 8.06787C6.19806 5.67585 8.30063 3.91013 10.858 3.44766L11.5583 3.32102C12.7318 3.10881 13.9354 3.10881 15.1089 3.32102L15.8092 3.44766C18.3666 3.91013 20.4691 5.67586 21.3108 8.06789L21.4244 8.39084C22.1893 10.5648 22.3168 12.9026 21.7926 15.143Z" stroke="#858EAD" stroke-width="1.5"/>
                                </svg> {{ $tag->products->where('branch_id', 'like', $branch)->count()}} тем
                            </p>
                        </div>
                        <div class="card_center">
                            <h3 class="fw-semibold">{{ $tag->name }}</h3>
                        </div>
                    </div>
                </button>
            </form>
            @endforeach
            @can('admin')
                <button type="button" style="font-size: 16px" class="btn btn-on mb-0 col-12" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add Tag
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <x-tag-create>
                        {{ $category->id }}
                    </x-tag-create>
                </div>
            @endcan
        </div>
    </div>
    <x-right-side/>

</div>
@endsection
