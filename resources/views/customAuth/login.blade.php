<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="target-densitydpi=device-dpi,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <meta content="True" name="HandheldFriendly">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('https://kit.fontawesome.com/b11236bde2.js') }}"></script>
</head>

<body>
    <header class="bg-white">
        <div class="container px-3 py-8 flex justify-center items-center mx-auto">
            <a href="{{url('/')}}">
                <img class="h-20" src="images/logo.png" />
            </a>
        </div>
    </header>
    <div class="container mx-auto">
        <div class="bg-white shadow w-64 mt-20 p-6 mx-auto" style="width:483px;">
            <h1 class="text-lg text-purple-600 mb-12 text-center font-bold text-3xl">Login</h1>
            <form method="post" action="{{ url('/customLogin') }}" data-lpignore=true>
                @csrf

                <input class="shadow w-full text-md mb-6 p-3" style="display:none" name="email" type="text" value="test@gmail.com" placeholder="Username" />

                <input class="shadow w-full text-md mb-6 p-3" data-lpignore=true type="password" name="password" placeholder="Password" />

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label class="w-2/3 mb-6 block text-gray-500 font-bold cursor-pointer">
                    <input class="mr-2 leading-tight" type="checkbox" name="remember_me">
                    <span class="text-sm">
                        Remember me
                    </span>
                </label>
                <button class="px-5 py-2 text-md bg-purple-600 text-white mr-0 ml-auto rounded-lg outline-none" type="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>
    <script src="js/index.js"></script>
</body>

</html>