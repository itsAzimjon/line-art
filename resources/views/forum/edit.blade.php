@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <x-search-forum/>
        <form class="row g-3" action="{{ route('forum.update', $forum->id) }}" method="POST">
        @method('PUT')
        @csrf
            <h2 class="py-3">Задайте публичный вопрос</h2>
            <div class="col-12">
                <label for="title" class="fs-5 form-label">Категория</label>
                <select required name="tag_id" class="form-select" aria-label="Default select example">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ $forum->tag->id == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="title" class="fs-5 form-label">Заголовок</label>
                <textarea required name="title" class="form-control" placeholder="Задайте публичный вопрос" id="floatingTextarea2" style="height: 100px">{{ $forum->title }}</textarea>
            </div>
            <div class="col-12">
                <label for="title" class="fs-5 form-label">Описание</label>
                <textarea required name="description" class="form-control" placeholder="Введите описание вашего вопроса здесь" id="floatingTextarea2" style="height: 100px">{{ $forum->description }}</textarea>
            </div>
            <div class="col-12 p-0">
                <button type="submit" class="col-12 fs-6 btn btn-on btn-lg">Отправлять</button>
            </div>
        </form>
    </div>
</div>
@endsection