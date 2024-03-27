<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url('public/home/css/font-awesome.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/home/css/styles.css') }}" />
    <script src="{{ url('public/home/js/darkmode.js') }}"></script>
    <title>GWMegazine Home</title>
</head>

<body>
    <div class="wrapper">
        <div class="login-container">
            <h1 class="mb-4 text-center fw-semibold">Reset password</h1>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
                <div class="hstack">
                    <a href="{{ route('login') }}" class="me-auto">
                        < Return to login</a>
                            <button type="submit" class="btn btn-primary square-btn py-3 px-5 ms-auto">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ url('public/home/js/popper.js') }}"></script>
    <script src="{{ url('public/home/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/home/js/script.js') }}"></script>
</body>

</html>
