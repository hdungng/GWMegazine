<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url('public/home/css/font-awesome.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/home/css/styles.css') }}" />
    <title>GWMegazine Home</title>
</head>

<body>
    <div class="wrapper">
        <div class="login-container">
            <h1 class="mb-4 text-center fw-semibold">Forgot password</h1>
            @if (session('status'))
                <div class="alert alert-success bg-light" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-5">
                    <label for="email" class="form-label">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="hstack">
                    <a href="{{ route('login') }}" class="me-auto">
                        < Return to login</a>
                            <button type="submit" class="btn btn-primary square-btn py-3 px-5 ms-auto">
                                {{ __('Send Link') }}
                            </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ url('public/home/js/popper.js') }}"></script>
    <script src="{{ url('public/home/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/home/js/script.js') }}"></script>
</body>

</html>
