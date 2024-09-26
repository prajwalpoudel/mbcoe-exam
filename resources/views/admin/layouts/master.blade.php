<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>
        @yield('title')
    </title>
    <meta name="description" content="Add user example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->
    <!--end::Page Custom Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="{{ asset('assets/admin/css') }}/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->
    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/admin/css') }}/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/lineawesome.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('assets/admin/css') }}/base-light.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/menu-light.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/brand-dark.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/aside-dark.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/select2.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/style.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/summernote.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/toastr.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css') }}/wizard-4.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/icons') }}/favicon.ico" />
    @stack('style')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
@include('admin.includes.header-mobile')
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->
    @include('admin.includes.sidebar')
    <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
        @include('admin.includes.header')
        <!-- end:: Header -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    @yield('content')
                </div>

                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            @include('admin.includes.footer')
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
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{ asset('assets/admin/js') }}/jquery.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/popper.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/js.cookie.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/tooltip.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/perfect-scrollbar.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/sticky.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/wNumb.js" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('assets/admin/js') }}/scripts.bundle.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/datatables.bundle.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/sweetalert.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/select2.full.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/summernote.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/toastr.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js') }}/script.js" type="text/javascript"></script>


<script>
    var message = @json(session('message', []));
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
        if (this.message.status === 'success') {
            toastr.success(this.message.title)
        } else if(this.message.status == 'error') {
            toastr.error(this.message.title)
        } else if(this.message.status == 'warning') {
            toastr.warning(this.message.title)
        } else if(this.message.status == 'danger') {
            toastr.danger(this.message.title)
        }
</script>
@stack('script')
<!--end::Global Theme Bundle -->
</body>

<!-- end::Body -->
</html>
