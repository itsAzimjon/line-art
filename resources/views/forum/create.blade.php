@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <x-left-side/>
    <div class="col col-7 cls_p3">
        <x-search-forum/>
        <form class="row g-3" action="{{ route('forum.store') }}" method="POST">
        @csrf
            <h2 class="py-3">Задайте публичный вопрос</h2>
            
            <input disabled class="form-control" value="{{ $tag->name}}"></option>
            <input name="tag" type="hidden" value="{{ $tag->id}}"></option>
            <div class="col-12">
                <label for="title" class="fs-5 form-label">Заголовок</label>
                <textarea required name="title" class="form-control" placeholder="Задайте публичный вопрос" id="floatingTextarea2" style="height: 100px"></textarea>
            </div>
            <div class="col-12">
                <label for="title" class="fs-5 form-label">Описание</label>
                <textarea required name="description" class="form-control" placeholder="Введите описание вашего вопроса здесь" id="floatingTextarea2" style="height: 100px"></textarea>
            </div>
            <div class="col-12 p-0">
                <button type="submit" class="col-3 fs-6 btn btn-on btn-sm">Отправлять</button>
            </div>
        </form>
    </div>
</div>
@endsection