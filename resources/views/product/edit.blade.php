@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col my-5">
            <form action="{{ route('posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">  
                @method('PUT')  
                @csrf
                @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="welcome-image" class="form-control-label">Surat</label>
                            <div class="@error('image')border border-danger rounded-3 @enderror">
                                <input class="form-control"  type="file" id="welcome-image" accept="image/*"  name="image">
                                    @error('image')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Kategoriya</label>
                            <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                <select name="category_id" aria-label="Default select example" class="form-select">
                                    @foreach($categories as $option)
                                    <option value="{{ $option->id }}" {{ $option->id == $post->category_id ? 'selected' : '' }}>
                                        {{ $option->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="welcome-title" class="form-control-label">Sarlavha</label>
                            <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" name="title" value="{{ $post->title}}">
                                    @error('title')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image-Passport" class="form-control-label">Tavsif</label>
                            <div class="@error('Passport')border border-danger rounded-3 @enderror">
                                <textarea class="form-control"  type="text" name="description">{{ $post->description}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="welcome-title" class="form-control-label">Sarlavha en</label>
                        <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                            <input required class="form-control" type="text" id="welcome-title" name="title_en" value="{{ __($post->title, [], 'en')}}">
                                @error('title')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title" class="form-control-label">Tavsif en</label>
                        <div class="@error('title')border border-danger rounded-3 @enderror">
                            <textarea class="form-control"  type="text" name="description_en">{{ __($post->description, [], 'en')}}
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="welcome-title" class="form-control-label">Sarlavha ru</label>
                        <div class="@error('welcome.title')border border-danger rounded-3 @enderror">
                            <input required class="form-control" type="text" id="welcome-title" name="title_ru" value="{{ __($post->title, [], 'ru')}}">
                                @error('title')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title" class="form-control-label">Tavsif ru</label>
                        <div class="@error('title')border border-danger rounded-3 @enderror">
                            <textarea class="form-control"  type="text" name="description_ru">{{ __($post->description, [], 'ru')}}
                            </textarea>
                        </div>
                    </div>
                </div>
                @if($post->mult_image)
                <p class="mt-4">Suratni o‘chirish uchun belgilang</p>
                @foreach ($post->mult_image as $index => $image)
                <div>
                    <img class="mb-5" src="{{ asset('storage/' . $image) }}" alt="Image" style="width: 160px">
                    <input class="m-1" type="checkbox" name="deleted_images[]" value="{{ $index }}">O‘chirish
                </div>
                @endforeach
                @endif
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="welcome-image" class="form-control-label">Surat</label>
                        <div class="@error('image')border border-danger rounded-3 @enderror">
                            <input class="form-control" type="file" name="mult_image[]" accept="image/*" multiple>
                                @error('image')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>
            
            </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-primary text-light text-w btn-md mt-3 mb-5">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const addImageButton = document.getElementById('add-image-button');
    const newImagesContainer = document.getElementById('new-images-container');

    let imageCount = 0;

    addImageButton.addEventListener('click', function () {
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'new_images[]';
        newInput.accept = 'image/*';
        newInput.classList.add('new-image-input');
        
        newImagesContainer.appendChild(newInput);

        imageCount++;
    });
</script>

@endsection