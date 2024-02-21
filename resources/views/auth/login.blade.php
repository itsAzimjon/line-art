<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('images/register.jpg')}}');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center d-flex">
                    <div class="col-md-7">
                        <div class="my-3">
                            <h4> <strong>Создать новый профиль!</strong></h4>
                            <b class="text-dark">Уже имеете аккаунт?<a class="text-primary" href="{{ route('register')}}"> Регистрация </a></b>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="name">Имя пользователя:</label>
                                    <input required class="form-control" type="text" id="name" name="name" placeholder="John Doe">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    <label for="password">Пароль:</label>
                                    <input required class="form-control" type="password" id="password" name="password" placeholder="***********">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-sub mt-3" type="submit">
                                    Войти
                                </button>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>