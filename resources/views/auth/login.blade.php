<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    
    <div id="container" class="container">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input-group">
                                <label for="name">Username:</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your username">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                
                            <div class="input-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                
                            <div class="input-group">
                                <label for="age">Age:</label>
                                <input type="number" id="age" name="age" value="{{ old('age') }}" placeholder="Enter your age">
                            </div>
                            @error('age')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                
                            <div class="input-group" style="display: flex">
                                <label for="gender">Gender:</label>
                                <input type="radio" id="gender1" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                                <label for="gender1">Male</label>
                                <input type="radio" id="gender2" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                                <label for="gender2">Female</label>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                
                            <div class="input-group">
                                <label for="region">Region:</label>
                                <input type="text" id="region" name="region" value="{{ old('region') }}" placeholder="Enter your region">
                            </div>
                            @error('region')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                
                            <div class="input-group">
                                <label for="job">Job:</label>
                                <input type="text" id="job" name="job" value="{{ old('job') }}" placeholder="Enter your job">
                            </div>
                            @error('job')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                
                            <div class="input-group">
                                <label for="phone">Phone:</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number">
                            </div>
                        @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                
                            <div class="input-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" placeholder="Enter your password">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
            
                            
                            <button type="submit">
                                Sign up
                            </button>
                        </form>
                        <p>
                            <span>
                                Already have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign in here
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
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" name="email" placeholder="Username">
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit">
                                Sign in
                            </button>
                        </form>
                        <p>
                            <b>
                                Forgot password?
                            </b>
                        </p>
                        <p>
                            <span>
                                Don't have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign up here
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