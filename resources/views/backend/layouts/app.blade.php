<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Flat Management | @yield('title') </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/frontend/assets/img/favicon.ico') }}" />
    <link href="{{ asset('public/frontend/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('public/frontend/assets/js/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('public/frontend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/frontend/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('public/frontend/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/frontend/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('public/frontend/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/dropify/dropify.min.css') }}">
    <link href="{{ asset('public/frontend/assets/css/users/account-setting.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/assets/css/elements/alert.css') }}">
    <link href="{{ asset('public/frontend/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/frontend/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/frontend/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('public/frontend/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/select2/select2.min.css') }}">
    <link href="{{ asset('public/frontend/assets/css/components/custom-modal.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <!--  END CUSTOM STYLE FILE  -->

</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{ URL::to('/') }}">
                        <img src="{{ asset('public/frontend/assets/img/logo.svg') }}" class="navbar-logo"
                            alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{ URL::to('/') }}" class="nav-link"> Flat Management </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">

                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="{{ asset(auth()->user()->photo) }}" alt="avatar">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="{{ route('profile') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> Profile</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg> Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"> @csrf </form>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Flat Manage</a></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('backend.layouts.sidebar');
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            @section('content')

            @show
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank"
                            href="https://ictbanglabd.com/">Ictbanglabd</a>, All
                        rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('public/frontend/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('public/frontend/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('public/frontend/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('public/frontend/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{ asset('public/frontend/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('public/frontend/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/select2/custom-select2.js') }}"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->

    <script>
        const toast = swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 2000,
            padding: '2em'
        });
        @if (session()->has('success') || session()->has('error'))
            @if (session()->has('error'))
                toast({
                type: 'error',
                title: "{{ session('error') }}",
                padding: '2em',
                })
            @else
                toast({
                type: 'success',
                title: "{{ session('success') }}",
                padding: '2em',
                })
            @endif
        @endif
    </script>

    <script>
        $('#multi-column-ordering').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [4],
                orderData: [4, 0]
            }]
        });

        $(".tagging").select2({
            tags: true
        });
    </script>

    @section('footer')

    @show

</body>

</html>
