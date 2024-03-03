@extends('layouts.app')
@section('content')
<div class="row mb-2">
    <div class="col mx-5 my-3 col-8">
        <div class="loader_block">
            <div class="loader_block_top">
                <h3>Загрузки</h3>
            </div>
            <div class="loader_block_bottom">
                <ul class="" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link loader_block_link active text-dark p-2" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Сохранённые</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link loader_block_link text-dark p-2" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Загруженные файлы</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-12  mx-5">
        <div class="tab-content">
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                @foreach ($downloads as $d)
                   <div class="row mb-3">
                        <div class="col-2 ">
                            <img class="load_block_img" src="{{ asset('storage/' . json_decode($d->product->photo)[0]) }}">
                        </div>
                        <div class="col-6 load_block_center">
                            <a class="text-dark" href="{{ route('product.show', ['product' => $d->product->id])}}">
                                <h5>{{$d->product->title}}</h5>
                                <p class="bolim">{{$d->product->branch->name}}</p>
                            </a>
                            <span class="span_1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
                                    <path d="M1.42744 5.27441H3.9921V10.8312H1.42744C1.31408 10.8312 1.20536 10.7861 1.1252 10.706C1.04503 10.6258 1 10.5171 1 10.4037V5.70186C1 5.58849 1.04503 5.47977 1.1252 5.39961C1.20536 5.31945 1.31408 5.27441 1.42744 5.27441V5.27441Z" stroke="#9196A8" stroke-width="0.814584" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.99219 5.27443L6.1294 1C6.35393 1 6.57626 1.04422 6.7837 1.13015C6.99114 1.21607 7.17963 1.34201 7.33839 1.50078C7.49716 1.65955 7.6231 1.84803 7.70902 2.05547C7.79495 2.26291 7.83917 2.48524 7.83917 2.70977V3.9921H11.1452C11.2664 3.9921 11.3863 4.01788 11.4967 4.06773C11.6072 4.11757 11.7059 4.19035 11.7861 4.28122C11.8663 4.37209 11.9263 4.47899 11.962 4.59481C11.9978 4.71064 12.0085 4.83274 11.9935 4.95302L11.3523 10.0823C11.3265 10.2891 11.226 10.4793 11.0698 10.6172C10.9136 10.7551 10.7124 10.8312 10.504 10.8312H3.99219" stroke="#9196A8" stroke-width="0.814584" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $d->product->raties->count() }}
                            </span>    
                            <span class="span_2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M1 1H2.81818L4.03636 7.24851C4.07793 7.46336 4.19178 7.65635 4.35798 7.79371C4.52417 7.93106 4.73214 8.00403 4.94545 7.99983H9.36364C9.57696 8.00403 9.78492 7.93106 9.95112 7.79371C10.1173 7.65635 10.2312 7.46336 10.2727 7.24851L11 3.33328H3.27273M5 10.5C5 10.7761 4.77614 11 4.5 11C4.22386 11 4 10.7761 4 10.5C4 10.2239 4.22386 10 4.5 10C4.77614 10 5 10.2239 5 10.5ZM10.5 10.5C10.5 10.7761 10.2761 11 10 11C9.72386 11 9.5 10.7761 9.5 10.5C9.5 10.2239 9.72386 10 10 10C10.2761 10 10.5 10.2239 10.5 10.5Z" stroke="#9196A8" stroke-width="0.950912" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                
                                <?php $downloadCount = $d->where('product_id', $d->product->id)->count(); ?>
                                {{ $downloadCount }}
                            </span>
                            @if ($d->product->price == 0 || $d->product->price == null)
                                <p>Бесплатно</p>
                            @else
                                <p class="tekin">{{ $d->product->price }}</p>
                            @endif
        
                        </div>
                        <div class="col-1">
                            <p class="data_time">{{ \Carbon\Carbon::parse($d->created_at)->format('d.m.Y') }}</p>
                        </div>
                        
                        <div class="col-3 btn_skachat_div">
                            <a href="{{ asset('storage/' . $d->product->file) }}" download class="btn btn-page3 btn_skachat">
                                <svg class="btn_skachat_svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M7.75 2.1875V11.3906" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.39062 7.03125L7.75 11.3906L12.1094 7.03125" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.42188 13.3281H13.0781" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Скачать
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                @foreach ($saves as $s)
                   <div class="row mb-3">
                        <div class="col-2 ">
                            <img class="load_block_img" src="{{ asset('storage/' . json_decode($s->product->photo)[0]) }}">
                        </div>
                        <div class="col-6 load_block_center">
                            <a class="text-dark" href="{{ route('product.show', ['product' => $s->product->id])}}">
                                <h5>{{$s->product->title}}</h5>
                                <p class="bolim">{{$s->product->branch->name}}</p>
                            </a>
                            <span class="span_1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
                                    <path d="M1.42744 5.27441H3.9921V10.8312H1.42744C1.31408 10.8312 1.20536 10.7861 1.1252 10.706C1.04503 10.6258 1 10.5171 1 10.4037V5.70186C1 5.58849 1.04503 5.47977 1.1252 5.39961C1.20536 5.31945 1.31408 5.27441 1.42744 5.27441V5.27441Z" stroke="#9196A8" stroke-width="0.814584" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.99219 5.27443L6.1294 1C6.35393 1 6.57626 1.04422 6.7837 1.13015C6.99114 1.21607 7.17963 1.34201 7.33839 1.50078C7.49716 1.65955 7.6231 1.84803 7.70902 2.05547C7.79495 2.26291 7.83917 2.48524 7.83917 2.70977V3.9921H11.1452C11.2664 3.9921 11.3863 4.01788 11.4967 4.06773C11.6072 4.11757 11.7059 4.19035 11.7861 4.28122C11.8663 4.37209 11.9263 4.47899 11.962 4.59481C11.9978 4.71064 12.0085 4.83274 11.9935 4.95302L11.3523 10.0823C11.3265 10.2891 11.226 10.4793 11.0698 10.6172C10.9136 10.7551 10.7124 10.8312 10.504 10.8312H3.99219" stroke="#9196A8" stroke-width="0.814584" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $s->product->raties->count() }}
                            </span>    
                            <span class="span_2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M1 1H2.81818L4.03636 7.24851C4.07793 7.46336 4.19178 7.65635 4.35798 7.79371C4.52417 7.93106 4.73214 8.00403 4.94545 7.99983H9.36364C9.57696 8.00403 9.78492 7.93106 9.95112 7.79371C10.1173 7.65635 10.2312 7.46336 10.2727 7.24851L11 3.33328H3.27273M5 10.5C5 10.7761 4.77614 11 4.5 11C4.22386 11 4 10.7761 4 10.5C4 10.2239 4.22386 10 4.5 10C4.77614 10 5 10.2239 5 10.5ZM10.5 10.5C10.5 10.7761 10.2761 11 10 11C9.72386 11 9.5 10.7761 9.5 10.5C9.5 10.2239 9.72386 10 10 10C10.2761 10 10.5 10.2239 10.5 10.5Z" stroke="#9196A8" stroke-width="0.950912" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                
                                <?php $downloadCount = $s->where('product_id', $s->product->id)->count(); ?>
                                {{ $downloadCount }}
                            </span>
                            @if ($s->product->price == 0 || $s->product->price == null)
                                <p>Бесплатно</p>
                            @else
                                <p class="tekin">{{ $s->product->price }}</p>
                            @endif
        
                        </div>
                        <div class="col-1">
                            <p class="data_time">{{ \Carbon\Carbon::parse($s->created_at)->format('d.m.Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection