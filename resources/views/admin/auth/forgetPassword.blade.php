

<!doctype html>
<html lang="en">
<head>
    <title>Atoshin</title>
    <link rel="icon" type="image/png" href="{{asset('admin/dist/img/Atoshin-hexagon.png')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('loginTemplate/css/style.css')}}">

</head>
<body class="img js-fullheight" style=" height: 435px; background-image: url({{asset('loginTemplate/images/bg.jpg')}}); backdrop-filter: blur(10px);">
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

                    <h3 class="mb-4 text-center">Please enter your email:</h3>
                    <form action="{{route('forget.password.post')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required  >
                            @error('email')
                            <small>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
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

