<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | {{ env('APP_NAME') }}</title>
    
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="{{ url('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/toast.css')}}">
    <link rel="stylesheet" id="primaryColor" href="{{ url('assets/css/blue-color.css') }}">
    <link rel="stylesheet" id="rtlStyle" href="#">
</head>
<body class="dark-theme">
    <x-anon.loader></x-anon.loader>    
    <x-alerts.basic :message="Session::all()"></x-alerts.basic>

    {{-- {{ dd(Session::all()) }} --}}
    <!-- main content start -->
    <div class="main-content login-panel">
        <div class="login-body">
            <div class="top d-flex justify-content-between align-items-center">
                <div class="logo">
                    <img src="{{ url('assets/images/logo-black.png') }}" alt="Logo">
                </div>
                <a href="{{ url("/") }}"><i class="fa-duotone fa-house-chimney"></i></a>
            </div>
            <div class="bottom">
                <h3 class="panel-title">Registration</h3>
                <form action="{{ route('registerPost') }}" method="post">
                    @csrf
                    <div class="input-group mb-25">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <x-forms.input
                            :type="'text'" 
                            id="'first-name'"
                            :name="'first-name'" 
                            :placeholder="'First Name'" 
                            :error="$errors->get('first-name')">
                        </x-forms.input>
                    </div>
                    <div class="input-group mb-25">
                        <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                        <x-forms.input
                            :type="'text'" 
                            :id="'last-name'" 
                            :name="'last-name'" 
                            :placeholder="'Last Name'" 
                            :error="$errors->get('last-name')">
                        </x-forms.input>
                    </div>
                    <div class="input-group mb-25">
                        <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                        <x-forms.input
                            :type="'email'" 
                            :id="'email'" 
                            :name="'email'" 
                            :placeholder="'Email address'" 
                            :error="$errors->get('email')">
                        </x-forms.input>
                    </div>
                    <div class="input-group mb-20">
                        <span class="input-group-text"><i class="fa-regular fa-lock"></i></span>
                        <x-forms.input
                            :class="'rounded-end'"
                            :type="'password'" 
                            :id="'password'" 
                            :name="'password'" 
                            :placeholder="'Password'" 
                            :error="$errors->get('password')">
                        </x-forms.input>
                        <a role="button" class="password-show"><i class="fa-duotone fa-eye"></i></a>
                    </div>
                    <div class="d-flex justify-content-between mb-25">
                        <div class="form-check">
                            <input class="form-check-input" checked type="checkbox" name="term-policy" value="ok" id="loginCheckbox">
                            <label class="form-check-label text-white" for="loginCheckbox">
                                I agree <a href="#" class="text-white text-decoration-underline">Terms & Policy</a>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 login-btn">Sign up</button>
                </form>
                <div class="other-option">
                    <p>Or continue with</p>
                    <div class="social-box d-flex justify-content-center gap-20">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="{{ url("/oauth/google") }}"><i class="fa-brands fa-google"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
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
    
    <script src="{{ url('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
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