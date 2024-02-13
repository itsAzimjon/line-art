@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>
                        
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="username" autofocus>
                                </div>
                        
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="age" class="col-md-4 col-form-label text-md-end">Age</label>
                        
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age">
                                </div>
                        
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">Gender</label>
                        
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex; align-items: center; gap: 10px;">
                                    <label for="gender">Gender</label>
                                    <input type="radio" value="1" name="gender">
                                    <input type="radio" value="2" name="gender">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="region" class="col-md-4 col-form-label text-md-end">Region</label>
                        
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region" value="{{ old('region') }}" required autocomplete="region">
                                </div>
                        
                                @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="job" class="col-md-4 col-form-label text-md-end">Job</label>
                        
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job') }}" required autocomplete="job">
                                </div>
                        
                                @error('job')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                        
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">
                                </div>
                        
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
