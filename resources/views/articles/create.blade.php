@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col my-5">
            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">    
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
                    <input type="hidden" value="{{$role}}" name="branch_id">
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Tag</label>
                            <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                @foreach($tags as $tag)
                                    <div class="form-check">
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
                            <label for="welcome-title" class="form-control-label">Mavzu</label>
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
                            <label for="title" class="form-control-label">Tavsif</label>
                            <div class="@error('title')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="text" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-1">
                        <div class="form-group">
                            <label for="author" class="form-control-label">Muallif</label>
                            <div class="@error('author')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="text" name="author"></textarea>
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
                    <button type="button" class="btn bg-gradient-secondary  btn-md mt-4 mb-4 mx-3" data-bs-dismiss="modal">Yopish</button>
                    <button type="submit" class="btn bg-primary text-light text-w btn-md mt-4 mb-4">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
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