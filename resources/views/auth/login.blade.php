<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }} - Daxil ol</title>
    <!-- CSS files -->
    <link href="{{ asset('back') }}/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="{{ asset('back') }}/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="{{ asset('back') }}/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="{{ asset('back') }}/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="{{ asset('back') }}/dist/css/demo.min.css" rel="stylesheet"/>
</head>
<body class=" border-top-wide border-primary d-flex flex-column">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('front.home') }}" class="navbar-brand navbar-brand-autodark">
                <img src="https://adpu.edu.az/images/adpu_files/frontend_files/logo/android-chrome-100x100.png" height="36" alt="">
            </a>
        </div>
        <form class="card card-md" action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">@lang('login.login_to_your_account')</h2>
                <div class="mb-3">
                    <label class="form-label" for="email">@lang('login.email')</label>
                    <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('login.email_enter')">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label" for="password">
                        @lang('login.password')
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('login.password')" autocomplete="off">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input"/>
                        <span class="form-check-label">@lang('login.remember_me_on_this_device')</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">@lang('login.login')</button>
                </div>
            </div>

        </form>
    </div>
</div>
<script src="{{ asset('back') }}/dist/js/tabler.min.js"></script>
</body>
</html>
