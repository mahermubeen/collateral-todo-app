<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CarGuru | Register </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/ico" href="{{ asset('images/carguru-logo.png') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="register-body">
    <div class="register-container">
        <div></div>
        <div class="register-heading">
            <a href="{{ url('/customRegister') }}">{{ __('Register') }}</a>
            <span class="cross">X</span>
        </div>
        <div class="register-box-body">
            <div></div>
            <div class="register-box-content">
                <div class="register-box-list">
                    <ul class="register-list-ul">
                        <li><a href="{{ url('/')  }}">Login</a></li>
                        <li><a class="active" href="{{ url('/customRegister') }}">Register</a></li>
                    </ul>
                </div>
                <form class="register-form" action="{{ url('/customRegister') }}" method="post">
                    @csrf

                    <input id="email" style="display:none" type="text" name="fakeusernameremembered">
                    <input id="password" style="display:none" type="password" name="fakepasswordremembered">

                    <div class="form-group">
                        <input
                            type="text"
                           name="fname"
                           value="{{ old('fname') }}"
                           placeholder="First Name"
                            autocomplete="nope"
                        />
                    </div>
                    @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                    <div class="form-group">
                        <input
                            type="text"
                           name="lname"
                           value="{{ old('lname') }}"
                           placeholder="Last Name"
                            autocomplete="nope"
                        />
                    </div>
                    @error('lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                    <div class="form-group">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            required
                        />
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                    <div class="form-group">
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            autocomplete="new-password"
                            required
                        />
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                    <div class="register-btn-box">
                        <button type="submit">
                            Register
                            <img src="images/send-arrow.png" />
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>
