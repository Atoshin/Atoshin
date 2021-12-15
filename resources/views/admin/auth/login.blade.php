<!doctype html>
<html lang="en">
<head>
    <title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('loginTemplate/css/style.css')}}">

</head>
<body class="img js-fullheight" style=" height: 435px; background-image: url("images/bg.jpg");">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <img src="{{asset('admin/dist/img/Atoshinlogo.png')}}" alt="Atoshin Logo" class="brand-image" style="opacity: .8">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Login</h3>
                    <form action="{{route('login')}}" class="signin-form" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username" required  >
                            @error('username')
                                <small>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control" placeholder="Password" name="password" required>
                            @error('username')
                            <small>{{$message}}</small>
                            @enderror
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Remember Me
                                    <input type="checkbox" name="remember" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="{{route('forget.password.get')}}" style="color: #fff">Forgot Password</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('loginTemplate/js/jquery.min.js')}}"></script>
<script src="{{asset('loginTemplate/js/popper.js')}}"></script>
<script src="{{asset('loginTemplate/js/bootstrap.min.js')}}"></script>
<script src="{{asset('loginTemplate/js/main.js')}}"></script>

</body>
</html>

