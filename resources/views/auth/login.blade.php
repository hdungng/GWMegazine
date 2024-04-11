<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/home/css/styles.css') }}" />
    <script src="{{ url('public/home/js/darkmode.js') }}"></script>
    <title>Reddit</title>
</head>

<body>
    <div class="wrapper">
        <div class="login-container">
            <h1 class="mb-4 text-center fw-semibold">Login</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="reset-password mb-3">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <div class="hstack">
                    <a href="{{ route('home.main-page') }}" class="me-auto">
                        < Return to main page</a>
                            <button type="submit" class="btn btn-primary square-btn py-3 px-5 ms-auto">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ url('public/home/js/popper.js') }}"></script>
    <script src="{{ url('public/home/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
