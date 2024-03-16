@extends('layouts.app')
@section('content')
<div class="row mt-4">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <div class="cls_card">
            @foreach ($branch->categories as $category)
                <a href="{{ route('product-category.show', ['category' => $category->id, 'branch' => $branch->id]) }}">
                    <div class="cls_cards p-3 mt-2 mb-2">
                        <div class="card_top">
                            <p>
                                <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.66 4.68375V9.79486C10.66 9.90331 10.6169 10.0073 10.5402 10.084C10.4636 10.1607 10.3596 10.2038 10.2511 10.2038H1.46C1.338 10.2038 1.221 10.1553 1.13473 10.069C1.04846 9.98275 1 9.86575 1 9.74375V3.30375C1 3.18175 1.04846 3.06475 1.13473 2.97848C1.221 2.89221 1.338 2.84375 1.46 2.84375H4.06667C4.1662 2.84375 4.26304 2.87603 4.34267 2.93575L5.93733 4.13175C6.01696 4.19147 6.1138 4.22375 6.21333 4.22375H10.2C10.322 4.22375 10.439 4.27221 10.5253 4.35848C10.6115 4.44475 10.66 4.56175 10.66 4.68375Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.84 2.84V1.46C2.84 1.338 2.88846 1.221 2.97473 1.13473C3.06099 1.04846 3.178 1 3.3 1H5.90666C6.00619 1 6.10304 1.03228 6.18266 1.092L7.77733 2.288C7.85695 2.34772 7.9538 2.38 8.05333 2.38H12.04C12.162 2.38 12.279 2.42846 12.3653 2.51473C12.4515 2.601 12.5 2.718 12.5 2.84V7.95111C12.5 8.00481 12.4894 8.05798 12.4689 8.10759C12.4483 8.1572 12.4182 8.20227 12.3802 8.24024C12.3423 8.27821 12.2972 8.30833 12.2476 8.32888C12.198 8.34942 12.1448 8.36 12.0911 8.36H10.66" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> {{ $category->tags->count() }} подразделов
                            </p>
                            <p>
                                <svg width="16" height="16" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4522 7L10.2452 7.47905C9.91092 8.25243 9.82691 9.10637 10.0043 9.92729C10.275 11.1799 11.3011 12.1473 12.5976 12.3723L12.7117 12.3921C13.1229 12.4635 13.5438 12.4635 13.955 12.3921L14.0691 12.3723C15.3656 12.1473 16.3917 11.1799 16.6624 9.92729C16.8398 9.10637 16.7558 8.25243 16.4215 7.47905L16.2145 7" stroke="#858EAD" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M21.7926 15.143C21.2059 17.6504 19.2004 19.6204 16.6287 20.2251C14.4674 20.7334 12.1998 20.7334 10.0385 20.2251C7.46675 19.6204 5.46125 17.6504 4.87455 15.143C4.35034 12.9026 4.47783 10.5648 5.24276 8.39084L5.3564 8.06787C6.19806 5.67585 8.30063 3.91013 10.858 3.44766L11.5583 3.32102C12.7318 3.10881 13.9354 3.10881 15.1089 3.32102L15.8092 3.44766C18.3666 3.91013 20.4691 5.67586 21.3108 8.06789L21.4244 8.39084C22.1893 10.5648 22.3168 12.9026 21.7926 15.143Z" stroke="#858EAD" stroke-width="1.5"/>
                                </svg>
                                @php
                                    $total = 0;
                                    foreach ($category->tags as $tag){
                                        $total += $tag->products->where('branch_id', 'like', $branch->id)->count();
                                    }
                                @endphp
                                {{ $total }} тем
                            </p>
                        </div>
                        <div class="card_center">
                            <h3 class="fw-semibold">{{ $category->name }}</h3>
                            <div class="card_center_block">
                                @foreach ($category->tags as $tag)
                                    <a class="btn border mb-0 ml-0 fw-bold text-secondary" href="{{ route('product.showpunkt', ['tag' => $tag->id, 'branch' => $branch])}}">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <x-right-side/>
</div>
@endsection