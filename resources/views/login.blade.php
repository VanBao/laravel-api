<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>Netvas Login</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{  asset('assets/css/pages/login/login-1.css') }}" rel="stylesheet"
          type="text/css"/>

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('assets/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css"/>

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}') }}"/>

    {{--    @yield('content')--}}

</head>
<!-- end::Head -->
<!-- begin::Body -->
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
        <div
            class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

            <!--begin::Aside-->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                 style="background-image: url({{ asset('assets/media/bg/bg-4.jpg') }});">
                <div class="kt-grid__item">
                    <a href="#" class="kt-login__logo">
                        <img src="{{ asset('image/netvas (1)-Recovered.png') }}" style="height: 60px;">
                    </a>
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <h3 class="kt-login__title">Welcome to Netvas!</h3>
                    </div>
                </div>
                <div class="kt-grid__item">
                    <div class="kt-login__info">
                        <div class="kt-login__copyright">
                            &copy {{ date('Y') }} NetVas
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Aside-->

            <!--begin::Content-->
            <div
                class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                <!--begin::Body-->
                <div class="kt-login__body">

                    <!--begin::Signin-->
                    <div class="kt-login__form">
                        <div class="kt-login__title">
                            <h3>Đăng nhập</h3>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form" action="{{ url('/login') }}" method="POST" novalidate="novalidate"
                              id="kt_login_form">
                            {{ csrf_field() }}
                            @if ($errors->any())
                                <div class="alert alert-solid-danger alert-bold flex-wrap">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert-text">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Username" name="email"
                                       autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" name="password"
                                       autocomplete="off">
                            </div>

                            <!--begin::Action-->
                            <div class="kt-login__actions">
                                <a href="{{ route('password.request') }}" class="kt-link kt-login__link-forgot">
                                    Quên mật khẩu ?
                                </a>
                                <button type="submit" id="kt_login_signin_submit"
                                        class="btn btn-primary btn-elevate kt-login__btn-primary">Đăng nhập
                                </button>
                            </div>

                            <!--end::Action-->
                        </form>

                        <!--end::Form-->
                    </div>

                    <!--end::Signin-->
                </div>

                <!--end::Body-->
            </div>

            <!--end::Content-->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
