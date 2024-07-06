<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ env('APP_NAME') }}</title>
    
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css')}}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css')}}">
    <link rel="stylesheet" id="rtlStyle" href="#">
</head>
<body class="dark-theme">
    <x-anon.loader></x-anon.loader>    
    <x-alerts.basic :message="Session::all()"></x-alerts.basic>

    <!-- main content start -->
    <div class="main-content login-panel login-panel-3">
        <div class="container">
            <div class="d-flex justify-content-end">
                <div class="login-body">
                    <div class="top d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <img src="{{ asset('assets/images/logo-black.png') }}" alt="Logo">
                        </div>
                        <a href="{{ asset('/') }}"><i class="fa-duotone fa-house-chimney"></i></a>
                    </div>
                    <div class="bottom">
                        <h3 class="panel-title">Login</h3>
                        <form action="{{ route("loginPost") }}" method="post">
                            @csrf

                            <div class="input-group mb-25">
                                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'email'" 
                                    :name="'email'" 
                                    :id="'email'" 
                                    :placeholder="'Email address'" 
                                    :error="$errors->get('email')">
                                </x-forms.input>
                            </div>
                            <div class="input-group mb-20">
                                <span class="input-group-text"><i class="fa-regular fa-lock"></i></span>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'password'" 
                                    :name="'password'" 
                                    :id="'password'" 
                                    :class="'rounded-end'"
                                    :placeholder="'Password'" 
                                    :error="$errors->get('password')">
                                </x-forms.input>
                                <a role="button" class="password-show"><i class="fa-duotone fa-eye"></i></a>
                            </div>
                            <div class="d-flex justify-content-between mb-25">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="ok" id="loginCheckbox">
                                    <label class="form-check-label text-white" for="loginCheckbox">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="reset-password.html" class="text-white fs-14">Forgot Password?</a>
                            </div>
                            <button class="btn btn-primary w-100 login-btn">Sign in</button>
                        </form>
                        <div class="other-option">
                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-white text-decoration-underline">create</a></p>
                            <p>Or continue with</p>
                            <div class="social-box d-flex justify-content-center gap-20">
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-google"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer start -->
        <div class="footer">
            <p>Copyright© <script>document.write(new Date().getFullYear())</script> All Rights Reserved By <span class="text-primary">{{ env('APP_NAME') }}</span></p>
        </div>
        <!-- footer end -->
    </div>
    <!-- main content end -->
    
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- for demo purpose -->
    <script>
        var rtlReady = $('html').attr('dir', 'ltr');
        if (rtlReady !== undefined) {
            localStorage.setItem('layoutDirection', 'ltr');
        }
    </script>
    <!-- for demo purpose -->
</body>
</html>