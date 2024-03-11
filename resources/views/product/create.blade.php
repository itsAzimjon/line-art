@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col my-5">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">    
                @csrf
                @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                        {{$errors->first()}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                        {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Branch</label>
                            <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                <select name="branch_id" aria-label="Default select example" class="form-select">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id}}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-image" class="form-control-label">File</label>
                            <div class="@error('image')border border-danger rounded-3 @enderror">
                                <input required class="form-control"  type="file"  id="welcome-image" name="file">
                                    @error('file')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Category</label>
                            <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                <select name="category_id" aria-label="Default select example" class="form-select">
                                    @foreach($categories as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Tags</label>
                            <input type="text" id="tag-search" class="form-control" placeholder="Search tags...">
                            <div id="tag-list" class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                @foreach($tags as $tag)
                                    <div class="form-check tag-item">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}">
                                        <label class="form-check-label" for="tag{{ $tag->id }}">
                                            {{ $tag->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Title</label>
                            <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                <input required class="form-control" type="text" id="welcome-title" name="title">
                                    @error('title')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Description</label>
                            <div class="@error('title')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="text" name="description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-author" class="form-control-label">Author</label>
                            <div class="@error('welcome.author')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="text" name="author"></textarea>
                                    @error('author')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Price</label>
                            <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                <input required class="form-control" type="text" id="welcome-title" name="price">
                                    @error('title')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Video Link</label>
                            <div class="@error('title')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="number" name="doc_number"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="image-forms" class="my-4 form-group"> 
                    <div class="image-form">
                        <label class="form-control-label" for="mult_image[]">Qo‘shimcha surat:</label>
                        <input required class="form-control" type="file" name="mult_image[]" accept="image/*">
                    </div>
                </div>
                
                <button type="button" id="add-image" class="btn btn-secondary">Rasm qo‘shish</button>
            
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-lg bg-primary text-light text-w btn-md mt-4 mb-4">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // search tags
    document.addEventListener('DOMContentLoaded', function() {
        const tagSearchInput = document.getElementById('tag-search');
        const tagList = document.getElementById('tag-list');

        tagSearchInput.addEventListener('input', function() {
        const searchTerm = tagSearchInput.value.trim().toLowerCase();
        const tagItems = tagList.querySelectorAll('.tag-item');

        tagItems.forEach(function(tagItem) {
            const tagName = tagItem.querySelector('.form-check-label').textContent.trim().toLowerCase();
                if (tagName.includes(searchTerm)) {
                    tagItem.style.display = 'block';
                } else {
                    tagItem.style.display = 'none';
                }
            });
        });
    });
    //////

    var maxImages = 4;
    var imageForms = document.getElementById('image-forms');
    var addImageButton = document.getElementById('add-image');

    function updateAddButtonState() {
        if (imageForms.childElementCount >= maxImages) {
            addImageButton.disabled = true;
        } else {
            addImageButton.disabled = false;
        }
    }

    addImageButton.addEventListener('click', function () {
        if (imageForms.childElementCount < maxImages) {
            var newImageForm = document.createElement('div');
            newImageForm.className = 'image-form';
            newImageForm.innerHTML = `
                <label class="form-control-label" for="mult_image[]">Qo‘shimcha surat:</label>
                <input  class="form-control" type="file" name="mult_image[]" accept="image/*">
            `;
            imageForms.appendChild(newImageForm);
            updateAddButtonState();
        }
    });

    updateAddButtonState();
</script>
@endsection