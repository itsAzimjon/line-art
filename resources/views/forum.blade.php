@extends('layouts.app')
@section('content')
<div class="row mt-4">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <x-search-forum/>
        <div class="cls_card">
            @foreach ($categories as $category)
                <a href="{{ route('category.show', ['category' => $category->id]) }}">
                    <div class="cls_cards p-3 mt-2 mb-2">
                        <div class="card_top">
                            <p>
                                <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.66 4.68375V9.79486C10.66 9.90331 10.6169 10.0073 10.5402 10.084C10.4636 10.1607 10.3596 10.2038 10.2511 10.2038H1.46C1.338 10.2038 1.221 10.1553 1.13473 10.069C1.04846 9.98275 1 9.86575 1 9.74375V3.30375C1 3.18175 1.04846 3.06475 1.13473 2.97848C1.221 2.89221 1.338 2.84375 1.46 2.84375H4.06667C4.1662 2.84375 4.26304 2.87603 4.34267 2.93575L5.93733 4.13175C6.01696 4.19147 6.1138 4.22375 6.21333 4.22375H10.2C10.322 4.22375 10.439 4.27221 10.5253 4.35848C10.6115 4.44475 10.66 4.56175 10.66 4.68375Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.84 2.84V1.46C2.84 1.338 2.88846 1.221 2.97473 1.13473C3.06099 1.04846 3.178 1 3.3 1H5.90666C6.00619 1 6.10304 1.03228 6.18266 1.092L7.77733 2.288C7.85695 2.34772 7.9538 2.38 8.05333 2.38H12.04C12.162 2.38 12.279 2.42846 12.3653 2.51473C12.4515 2.601 12.5 2.718 12.5 2.84V7.95111C12.5 8.00481 12.4894 8.05798 12.4689 8.10759C12.4483 8.1572 12.4182 8.20227 12.3802 8.24024C12.3423 8.27821 12.2972 8.30833 12.2476 8.32888C12.198 8.34942 12.1448 8.36 12.0911 8.36H10.66" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> {{ $category->tags->count() }} подразделов
                            </p>
                            <p>
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 8.125C11 8.41232 10.8946 8.68787 10.7071 8.89103C10.5196 9.0942 10.2652 9.20833 10 9.20833H4L2 11.375V2.70833C2 2.42102 2.10536 2.14547 2.29289 1.9423C2.48043 1.73914 2.73478 1.625 3 1.625H10C10.2652 1.625 10.5196 1.73914 10.7071 1.9423C10.8946 2.14547 11 2.42102 11 2.70833V8.125Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>  
                                @php
                                    $total = 0;
                                    foreach ($category->tags as $tag){
                                        $total += $tag->forums->count();
                                    }
                                @endphp
                                {{ $total }} тем
                            </p>
                        </div>
                        <div class="card_center">
                            <h3 class="fw-semibold">{{ $category->name }}</h3>
                            <div class="card_center_block">
                                @foreach ($category->tags as $tag)
                                    <a class="btn m-0 text-secondary" href="{{ route('tag.show', ['tag' => $tag->id])}}">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card_bottom mt-1">
                            <p>Последнее сообщение</p>
                            @foreach ($category->tags->take(1) as $tag)
                                @php $latestForum = $tag->forums()->latest()->first(); @endphp
                                @if ($latestForum)
                                    <p class="border border-light-subtle p-1 px-2 rounded-3 col-12 text-truncate">{{$latestForum->user->name}}  •  <span class="d-inline-block text-truncate mx-3" style="max-width: 60%; height: 14px;">{{$latestForum->title}}</span>  •  {{$latestForum->created_at}}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
            @can('admin')
                <button type="button" style="font-size: 16px" class="btn btn-on mb-0 col-12" data-bs-toggle="modal" data-bs-target="#categortCreate">
                    + Add Category
                </button>
                <div class="modal fade" id="categortCreate" tabindex="-1" aria-labelledby="categortCreateLabel" aria-hidden="true">
                    <x-category-create>
                        {{ 2 }}
                    </x-category-create>
                </div>
            @endcan
        </div>
    </div>
    <x-right-side/>
</div>
@endsection
