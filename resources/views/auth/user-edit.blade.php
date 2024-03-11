@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="py-3">Пользователь #{{ $user->id }}</h2>
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($user->photo)
                                <img style="object-fit: cover" src="{{ asset('storage/'. $user->photo)}}" class="rounded-circle p-1 bg-primary" width="110">
                            @else
                                <img src="https://avatar.iran.liara.run/public" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                            @endif
                            <div class="mt-3">
                                <h4>{{ $user->name }}</h4>
                                <p class="text-secondary mb-1">{{ $user->job }}</p>
                                <p class="text-muted font-size-sm">{{ $user->region }}</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 d-flex">
                                    <span class="material-symbols-outlined px-1">
                                        savings
                                        </span>
                                    <span class="mt-1">Кошелек</span>
                                </h6>
                                <span class="text-secondary">{{ $user->credit }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 d-flex">
                                    <span class="material-symbols-outlined px-1">
                                        cloud_download
                                        </span>
                                    <span class="mt-1">Загрузки</span>
                                </h6>
                                <span class="text-secondary">{{ $user->downloads->count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 d-flex">
                                    <span class="material-symbols-outlined px-1">
                                        forum
                                        </span>
                                    <span class="mt-1">Форумы</span>
                                </h6>
                                <span class="text-secondary">{{ $user->forums->count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 d-flex">
                                    <span class="material-symbols-outlined px-1">
                                        reply
                                        </span>
                                    <span class="mt-1">Ответы</span>
                                </h6>
                                <span class="text-secondary">{{ $user->replies->count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 d-flex">
                                    <span class="material-symbols-outlined px-1">
                                        thumb_up
                                        </span>
                                    <span class="mt-1">Лайков</span>
                                </h6>
                                <span class="text-secondary">{{ $user->raties->count() }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card p-3">
                    <div class="card-body">
                        <form action="{{ route('user.update', [ 'user' => $user->id ])}}" method="POST" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Картина</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" name="photo" accept="image/*" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Имя</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input required type="text" name="name" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Электронная почта</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input required type="text" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Номер телефона</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input required type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Область</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input required type="text" name="region" class="form-control" value="{{ $user->region }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Работа</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input required type="text" name="job" class="form-control" value="{{ $user->job }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Возраст</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input required type="number" name="age" class="form-control" value="{{ $user->age }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Пароль</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="password" class="form-control" placeholder="******">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10"></div>
                                <div class="col-sm-2 text-secondary">
                                    <button type="submit" class="btn btn-on px-4 fw-semibold">Сохранять</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection