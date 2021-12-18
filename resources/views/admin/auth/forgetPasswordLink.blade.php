
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
<body class="img js-fullheight" >
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <img src="{{asset('admin/dist/img/Atoshinlogo.png')}}" alt="Atoshin Logo" class="brand-image" style="filter: brightness(0) invert(1);">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">

                    <h3 class="mb-4 text-center">please enter your email and your new password</h3>

                    <form action="{{ route('reset.password.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group ">

                                <input type="text" id="email_address" class="form-control" name="email" placeholder="Email" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif

                        </div>

                        <div class="form-group ">


                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required autofocus>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif

                        </div>

                        <div class="form-group ">
                                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required autofocus>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif

                        </div>

                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">reset password</button>
                        </div>
                    </form>
                    @if (\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert" style="background-color:#fbceb5 !important ">
                            <p class="text-dark">{!! \Illuminate\Support\Facades\Session::get('message') !!}</p>
                        </div>

                    @endif

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


