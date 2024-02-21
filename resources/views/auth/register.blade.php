<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <title>Register</title>
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
                            <h4> <strong>Присоединяйтесь к нашему сообществу!</strong></h4>
                            <b class="text-dark">Уже имеете аккаунт?<a class="text-primary" href="{{ route('login')}}"> Войдите</a></b>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Имя пользователя:</label>
                                <input required class="form-control form-control-sm" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Введите имя пользователя">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email">Электронная почта:</label>
                                <input required class="form-control form-control-sm" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Введите адрес электронной почты">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex">
                                <div class="form-group col-6 mb-3">
                                    <label for="age">Возраст:</label>
                                    <input required class="form-control form-control-sm" type="number" id="age" name="age" value="{{ old('age') }}" placeholder="Введите свой возраст">
                                    @error('age')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6 mb-3 px-2">
                                    <label for="experience">Опыт:</label>
                                    <input required class="form-control form-control-sm" type="text" id="experience" name="experience" value="{{ old('experience') }}" placeholder="Введите свой опыт">
                                    @error('experience')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="form-group col-6 mb-3">
                                    <label for="region">Область:</label>
                                    <input required class="form-control form-control-sm" type="text" id="region" name="region" value="{{ old('region') }}" placeholder="Введите свой регион">
                                    @error('region')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6 mb-3 px-2">
                                    <label for="job">Работа:</label>
                                    <input required class="form-control form-control-sm" type="text" id="job" name="job" value="{{ old('job') }}" placeholder="Введите свою работу">
                                    @error('job')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="phone">Номер телефона:</label>
                                <input required class="form-control form-control-sm" type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Введите свой номер телефона">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password">Пароль:</label>
                                <input required class="form-control form-control-sm" type="password" id="password" name="password" placeholder="Введите ваш пароль">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            <div class="form-group mb-3 ">
                                <label style="margin-right: 20px">Пол:</label>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input" type="radio" id="gender1" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender1">Мужской</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input" type="radio" id="gender2" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender2">Женский</label>
                                </div>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            <input required type="submit" value="Зарегистрироваться" class="btn btn-block btn-sub mb-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>