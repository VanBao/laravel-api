<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>Netvas Webadmin</title>
    <meta name="description" content="Updates and statistics">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
@yield('meta')
<!--begin::Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{  asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
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

    <link href="{{ asset('assets/css/netvas.css') }}" rel="stylesheet" type="text/css"/>

    @yield('styles')

    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}"/>

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function () {
            OneSignal.init({
                appId: "7b47765d-b4aa-4976-be1c-2638cf231bf2",
            });
        });
    </script>

</head>
<!-- end::Head -->
<!-- begin::Body -->
<body
    class="">
<!-- begin:: Page -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <!-- begin:: Content -->

            @yield('content')

            <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-footer__copyright">
                        2020&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Netvas</a>
                    </div>
                    <div class="kt-footer__menu">
                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                    </div>
                </div>
            </div>

            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

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

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('//maps.google.com/maps/api/js') }}?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>

<!--end::Page Scripts -->

<!--begin::Netvas Scripts -->
@yield('scripts')
<!--end::Netvas Scripts -->
</body>

<!-- end::Body -->
</html>
