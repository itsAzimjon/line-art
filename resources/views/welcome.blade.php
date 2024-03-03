@extends('layouts.app')
@section('content')
    <div class="main">
        <h1>Находите и исследуйте файлы и книги вашего направления</h1>
        <h2>Исследуйте, устанавливайте, используйте и изменяйте тысячи файлов и строк.</h2>
    </div>
    @can('admin')   
        <button type="button" class="btn btn-on mb-0" data-bs-toggle="modal" data-bs-target="#Branch">
            + Add Branch
        </button>
        <div class="modal fade" id="Branch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <x-branch-create :branches="$branches" :categories="$categories"/>
        </div>
        <button type="button" class="btn btn-on mb-0" data-bs-toggle="modal" data-bs-target="#categortCreate">
            + Add Category
        </button>
        <div class="modal fade" id="categortCreate" tabindex="-1" aria-labelledby="categortCreateLabel" aria-hidden="true">
            <x-category-create/>
        </div>
        <button type="button" class="btn btn-on mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + Add Tag
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <x-tag-create :categories="$categories" />
        </div>
        <a href="{{ route('product.create')}}" class="btn btn-primary mb-0">
            + Add Product
        </a>
    @endcan
    @can('admin')
        <nav>
            <div class="dropdown d-flex"> 
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle px-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Branches
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($branches as $branch)
                            <li class="d-flex">
                                <p class="p-2" data-cat-id="{{ $branch->id }}">{{ $branch->name }}</p>
                                <div>
                                    <form action="{{ route('branch.destroy', ['branch' => $branch->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger my-1 mx-2" type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту ветку?')">Удалить</button>
                                    </form>                    
                                    <button type="button" class="btn btn-sm btn-outline-warning m-0 mx-2" data-bs-toggle="modal" data-bs-target="#BranchEdit{{ $branch->id }}">
                                        edit
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @foreach ($branches as $branch)
                        <div class="modal fade" id="BranchEdit{{ $branch->id }}" tabindex="-1" aria-labelledby="BranchEditLabel{{ $branch->id }}" aria-hidden="true">
                            <x-branch-edit :branch="$branch" :categories="$categories"/>
                        </div>
                    @endforeach
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle mx-2 px-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($categories as $category)
                            <li class="d-flex">
                                <p class="p-2" data-cat-id="{{ $category->id }}">{{ $category->name }}</p>
                                <form action="{{ route('category.destroy', ['category' => $category->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                        <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту ветку?')">Удалить</button>
                                </form>                    
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle  px-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Tags
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($tags as $tag)
                            <li class="d-flex">
                                <p class="p-2" data-cat-id="{{ $tag->id }}">{{ $tag->name }}</p>
                                <form action="{{ route('tag.destroy', ['tag' => $tag->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                        <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту ветку?')">Удалить</button>
                                </form>                    
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    @endcan
    @foreach ($branches as $branch)
    <a href="{{ route('branch.show', ['branch' => $branch->id]) }}">
        <div class="cls_cards p-3 mt-2 mb-2">
            <div class="card_top">
                <p>
                    <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.66 4.68375V9.79486C10.66 9.90331 10.6169 10.0073 10.5402 10.084C10.4636 10.1607 10.3596 10.2038 10.2511 10.2038H1.46C1.338 10.2038 1.221 10.1553 1.13473 10.069C1.04846 9.98275 1 9.86575 1 9.74375V3.30375C1 3.18175 1.04846 3.06475 1.13473 2.97848C1.221 2.89221 1.338 2.84375 1.46 2.84375H4.06667C4.1662 2.84375 4.26304 2.87603 4.34267 2.93575L5.93733 4.13175C6.01696 4.19147 6.1138 4.22375 6.21333 4.22375H10.2C10.322 4.22375 10.439 4.27221 10.5253 4.35848C10.6115 4.44475 10.66 4.56175 10.66 4.68375Z" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.84 2.84V1.46C2.84 1.338 2.88846 1.221 2.97473 1.13473C3.06099 1.04846 3.178 1 3.3 1H5.90666C6.00619 1 6.10304 1.03228 6.18266 1.092L7.77733 2.288C7.85695 2.34772 7.9538 2.38 8.05333 2.38H12.04C12.162 2.38 12.279 2.42846 12.3653 2.51473C12.4515 2.601 12.5 2.718 12.5 2.84V7.95111C12.5 8.00481 12.4894 8.05798 12.4689 8.10759C12.4483 8.1572 12.4182 8.20227 12.3802 8.24024C12.3423 8.27821 12.2972 8.30833 12.2476 8.32888C12.198 8.34942 12.1448 8.36 12.0911 8.36H10.66" stroke="#858EAD" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> {{ $branch->categories->count() }} подразделов
                </p>
            </div>
            <div class="card_center">
                <h3 class="fw-semibold">{{ $branch->name }}</h3>
                <div class="card_center_block">
                    @foreach ($branch->categories as $category)
                        <a class="btn border mb-0 ml-0 fw-bold text-secondary" href="{{ route('product-category.show', ['category' => $category->id, 'branch' => $branch->id])}}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </a>
    @endforeach
@endsection