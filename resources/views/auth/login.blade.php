<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    
    <div id="container" class="p-0 m-0 main container-fluid">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Имя пользователя:</span>
                                <input class="form-control form-control-sm" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Введите имя пользователя">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2">Электронная почта:</span>
                                <input class="form-control form-control-sm" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Введите адрес электронной почты">
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">Возраст:</span>
                                <input class="form-control form-control-sm" type="number" id="age" name="age" value="{{ old('age') }}" placeholder="Введите свой возраст">
                            </div>
                            @error('age')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                         
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon5">Область:</span>
                                <input class="form-control form-control-sm" type="text" id="region" name="region" value="{{ old('region') }}" placeholder="Введите свой регион">
                            </div>
                            @error('region')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon6">Работа:</span>
                                <input class="form-control form-control-sm" type="text" id="job" name="job" value="{{ old('job') }}" placeholder="Введите свою работу">
                            </div>
                            @error('job')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon7">Опыт:</span>
                                <input class="form-control form-control-sm" type="text" id="experience" name="experience" value="{{ old('experience') }}" placeholder="Введите свой опыт">
                            </div>
                            @error('experience')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon8">Номер телефона:</span>
                                <input class="form-control form-control-sm" type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Введите свой номер телефона">
                            </div>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon9">Пароль:</span>
                                <input class="form-control form-control-sm" type="password" id="password" name="password" placeholder="Введите ваш пароль">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="input-group mb-3 d-flex">
                                <span class="input-group-text" id="basic-addon4">Пол:</span>
                                <div class="form-check form-check-inline mx-5 m-2">
                                    <input class="form-check-input" type="radio" id="gender1" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender1">Мужской</label>
                                </div>
                                <div class="form-check form-check-inline m-2">
                                    <input class="form-check-input" type="radio" id="gender2" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender2">Женский</label>
                                </div>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
            
                            
                            <button type="submit" class="btn-sm">
                                Зарегистрироваться
                            </button>
                        </form>
                        <p>
                            <span>
                                У вас уже есть аккаунт?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                <h6>Войти здесь</h4>
                            </b>
                        </p>
                    </div>
                </div>
            
            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-in">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mt-3">
                                <input class="form-control" type="text" name="email" placeholder="Username">
                            </div>
                            <div class="input-group my-2">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <button class="mt-3" type="submit">
                                Войти
                            </button>
                        </form>
                        {{-- <p>
                            <b>
                                Forgot password?
                            </b>
                        </p> --}}
                        <p>
                            <span>
                                У вас нет учетной записи?                            
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Подпишите здесь
                            </b>
                        </p>
                    </div>
                </div>
                <div class="form-wrapper">
        
                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Welcome
                    </h2>
    
                </div>
                <div class="img sign-in">
        
                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">
                
                </div>
                <div class="text sign-up">
                    <h2>
                        Join with us
                    </h2>
    
                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
    
    <script>
        let container = document.getElementById('container')
    
        toggle = () => {
            container.classList.toggle('sign-in')
            container.classList.toggle('sign-up')
        }
    
        setTimeout(() => {
            container.classList.add('sign-in')
        }, 200)
    </script>
</body>
</html>