<!DOCTYPE html>
<html lang="en" dir="rtl">
    
<!-- Mirrored from webmasterlabs.ir/Mr-Admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 08:57:33 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport"    content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author"      content="Coderthemes">

        <link rel="shortcut icon" href="{{ asset('assets/images/construction.png') }}">

        <title>سیستم یکپارچه ساختمانی</title>


        <!-- App css -->
        <link href={{ asset('assets/css/bootstrap-rtl.min.css') }} rel="stylesheet" type="text/css" />
        <link href={{ asset('assets/css/core.css') }}              rel="stylesheet" type="text/css" />
        <link href={{ asset('assets/css/components.css') }}       rel="stylesheet" type="text/css" />
        <link href={{ asset('assets/css/icons.css') }}            rel="stylesheet" type="text/css" />
        <link href={{ asset('assets/css/pages.css') }}            rel="stylesheet" type="text/css" />
        <link href={{ asset('assets/css/menu.css') }}            rel="stylesheet" type="text/css" />
        <link href={{ asset('assets/css/responsive.css') }}        rel="stylesheet" type="text/css" />


        
         <!-- DataTables -->
         <link href={{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}       rel="stylesheet" type="text/css" />
         <link href={{ asset('assets/plugins/datatables/buttons.bootstrap.min.css') }}       rel="stylesheet" type="text/css" />
         <link href={{ asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}   rel="stylesheet" type="text/css" />
         <link href={{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}    rel="stylesheet" type="text/css" />
         <link href={{ asset('assets/plugins/datatables/scroller.bootstrap.min.css') }}      rel="stylesheet" type="text/css" />
         <link href={{ asset('assets/plugins/fileuploads/css/dropify.min.css') }}            rel="stylesheet" type="text/css" />
          <!--Morris Chart CSS -->
		{{-- <link rel="stylesheet" href={{ asset('assets/plugins/morris/morris.css') }}> --}}

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href={{ asset('assets/plugins/toastr/toastr.min.css') }}>
        <link rel="stylesheet" href={{ asset('assets/plugins/sweetalert/sweetalert.css') }}>

        <script src={{ asset('assets/js/modernizr.min.js') }}></script>
        

    </head>


    <body class="fixed-left">
        
        @include('sweetalert::alert')

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    {{-- <a href="" class="logo"><img src="assets/images/attached-files/4025163.jpg" width="60%" alt=""><i class="zmdi zmdi-layers"></i></a> --}}
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title">سیستم مدیریتی شرکت ساختمانی</h4>
                            </li>
                        </ul>

                        <!-- Right(Notification and Searchbox -->
                        {{-- <ul class="nav navbar-nav navbar-right">
                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline m-b-0">
                                        <li>
                                            <a href="javascript:void(0);" class="right-bar-toggle">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>
                            <li class="hidden-xs">
                                <form role="search" class="app-search">
                                    <input type="text" placeholder="به دنبال چه می گردی ؟؟؟"
                                            class="form-control">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul> --}}

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        {{-- <div class="user-img">
                            <img src={{ asset('assets/images/users/IMG-2.jpg') }} alt="user-img" title="Mat Helme" class="img-circle img-thumbnail">
                            <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                        </div> --}}
                        <h4><a>{{ Auth::user()->name }}</a> </h4>
                        <h5><a>{{ Auth::user()->email }}</a> </h5>
                        <ul class="list-inline">
                            
                            @auth
                                <li>
                                    <a href="{{ route('profile.show') }}" >
                                        <i class="zmdi zmdi-settings"></i>
                                    </a>
                                </li>
                                <li>
                                    <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger">
                                        <i class="fa fa-power-off"></i>
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" style="display: none" id="logout-form">
                                        @csrf
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="text-muted menu-title">دسته بندی ها</li>

                            <li>
                                <a href="/dashboard" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> داشبورد </span> </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>مدیریت کاربران </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/users">  کاربران </a></li>
                                    <li><a href="/roles">  نقش ها </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-building-o"></i> <span> نمایندگی ها </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/agencies">ثبت نمایندگی </a></li>
                                    <li><a href="/agenciesIncome">لیست درآمد نمایندگی ها </a></li>
                                    <li><a href="/agenciesExp">لیست مصارف نمایندگی ها </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i> <span> مصارف شخصی </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/HomeExp">ثبت مصارف خانه </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-institution"></i> <span> املاک </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/properties">ثبت و لیست املاک </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-tasks"></i> <span> مدیریت پروژه </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/projectmanagement">ثبت و لیست پروژه </a></li>
                                    <li><a href="/toProjExpenseReport"> گزارش خرید مواد از کمپنی </a></li>
                                    <li><a href="/companies">ثبت و لیست کمپنی </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-connectdevelop"></i> <span> مدیریت معاملات </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/toDebts"> لیست قروض </a></li>
                                    <li><a href="/toClaim"> لیست مطالبات </a></li>
                                    <li><a href="/toAltDebts"> ثبت و لیست قروض جانبی </a></li>
                                    <li><a href="/toAltClaims"> ثبت و لیست مطالبات جانبی </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-male"></i> <span> مدیریت کارمندان </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/toEmployees"> ثبت و لیست کارمندان </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-slideshare"></i> <span> مدیریت شرکا </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/toPartnersReg"> ثبت و لیست شرکا </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-files-o"></i> <span> مدیریت اسناد </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/toDocs"> ثبت و لیست اسناد </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/notes" class="waves-effect"><i class="fa fa-clipboard"></i> <span> یادداشت ها </span></a>
                            </li>


                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->



            <div class="content-page">
                <div class="content">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>





        



        

        <!-- jQuery  -->
        <script src={{ asset('assets/js/jquery.min.js') }}></script>
        <script src={{ asset('assets/js/bootstrap-rtl.min.js') }}></script>
        {{-- <script src={{ asset('') }}"resources/js/app.js"></script> --}}

        <!-- App js -->
        <script src={{ asset('assets/js/jquery.core.js') }}></script>
        <script src={{ asset('assets/js/jquery.app.js') }}></script>
        {{-- datatables js --}}
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <!-- Datatable init js -->
        <script src={{ asset('assets/pages/datatables.init.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/buttons.bootstrap.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/jszip.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/pdfmake.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/vfs_fonts.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/buttons.html5.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/buttons.print.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/dataTables.fixedHeader.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/dataTables.keyTable.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}></script>
        <script src={{ asset('assets/plugins/datatables/dataTables.scroller.min.js') }}></script>

        {{-- toastr js --}}
        <script src={{ asset('assets/plugins/toastr/toastr.min.js') }}></script>
        {!! Toastr::message() !!}
        

        {{-- sweetalert --}}
        <script src={{ asset('assets/plugins/sweetalert/sweetalert.js') }}></script>
        {{-- dropify --}}
        <script src={{ asset('assets/plugins/fileuploads/js/dropify.min.js') }}></script>
        <script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'فایل های ضروری را به اینجا بکشید یا کلیک کنید',
                    'replace': 'برای جایگزینی فایل را به اینجا بکشید یا کلیک کنید',
                    'remove': 'پاک کردن',
                    'error': 'با پوزش فراوان، خطایی رخ داده'
                },
                error: {
                    'fileSize': 'حجم فایل بیشتر از حد مجاز است (8M).'
                }
            });
        </script>

        {{-- stacking alternative js --}}
        @stack('js')

    </body>

<!-- Mirrored from webmasterlabs.ir/Mr-Admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Jun 2021 09:00:26 GMT -->
</html>