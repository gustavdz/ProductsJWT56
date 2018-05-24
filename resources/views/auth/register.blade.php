<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/ico" />

    <title>{{ config('app.name', 'EcuaBill') }} | Facturero Digital</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('css/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('css/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="login">
<div>


    <div class="login_wrapper">

        <div class="animate form">
            <section class="login_content">
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h1>Create Account</h1>
                    <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Name" required="" />
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('username') ? ' has-error' : '' }}">
                        <input id="username" name="username" type="text" value="{{ old('username') }}" class="form-control" placeholder="Username" required="" />
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required="" />
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="" />
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Repeat Password" required="" />
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit" >Create account</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="{{ route('login') }}" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <img src="{{asset('img/logoEcuabill.png')}}" alt="..." >
                            <p>©2018 All Rights Reserved to EcuaBill. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>