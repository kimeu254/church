<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Church Management Software">
    <meta name="author" content="Solutech Ltd">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <title>PalmChurch - Church Assistant Software</title>

    <!-- DataTables -->
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>

    <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="assets/js/modernizr.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

</head>


<body>

<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{route('home')}}" class="logo"><span>Palm<span>church</span></span></a>
            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown"
                           aria-expanded="true">
                            {{ Auth::user()->name }} {{ Session::get('church_name') }} | {{ date("d D M Y") }}
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="ti-user m-r-5"></i> Profile</a></li>
                            <li><a href="{{ route('logout') }}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

        </div>
    </div>

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="active">
                        <a href="home" class="active"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="members" class=""><i class="zmdi zmdi-accounts-alt"></i> <span> Members </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-accounts-list"></i><span> Manage Attendance </span> </a>
                        <ul class="submenu">
                            <li><a href="attendance">Attendance List</a></li>
                            <li><a href="events">Manage Events </a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="messaging" class=""><i class="zmdi zmdi-email"></i> <span> Messaging </span> </a>
                        <ul class="submenu">
                            <li><a href="{{route('compose')}}">New Message</a></li>
                            <li><a href="{{route('pending')}}">Pending Messages</a></li>
                            <li>
                                <a href="{{route('outbox')}}">
                                    Outbox
                                </a>
                            </li>
                            <li>
                                <a href="{{route('recharge-history')}}">
                                    Recharge History
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#" class=""><i class="zmdi zmdi-view-agenda"></i> <span> Projects </span></a>
                        <ul class="submenu">
                            <li><a href="projects">Manage Projects</a></li>
                            <li><a href="contributions">Project Contributions</a></li>
                        </ul>
                    </li>



                    <li class="has-submenu">
                        <a href="#" class=""><i class="zmdi zmdi-money"></i> <span> Finances </span></a>
                        <ul class="submenu">
                            <li><a href="incomes">Incomes</a></li>
                            <li><a href="expenses">Expenses</a></li>
                        </ul>
                    </li>


                    <li class="has-submenu pull-right">
                        <a href="#"><i class="zmdi zmdi-settings"></i><span> Settings </span> </a>
                        <ul class="submenu">
                            <li><a href="groups">Member Groups</a></li>
                            <li><a href="zones">Fellowship Zones</a></li>
                            <li><a href="schedules">Church Services</a></li>
                            <li><a href="projectstages">Project Stages</a></li>
                            <li><a href="incometypes">Income Types</a></li>
                            <li><a href="expensetypes">Expense Types</a></li>
                            <li><a href="{{route('recharge-sms')}}">Recharge SMS Units</a></li>
                        </ul>
                    </li>


                </ul>
                <!-- End navigation menu  -->
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->


<div class="wrapper">
    <div class="container">
        <div class="col-md-12">
            @if(session('success'))
                <div class="card-box">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="card-box">
                    <div class="alert alert-success">
                        {{session('error')}}
                    </div>
                </div>
            @endif
        </div>
    @yield('content')
    <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        {{date("Y")}} © Solutech Limited.
                    </div>
                    <div class="col-xs-6">
                        <ul class="pull-right list-inline m-b-0">
                            <li>
                                <a href="www.solutech.co.ke">About</a>
                            </li>
                            <li>
                                <a href="www.solutech.co.ke">Help</a>
                            </li>
                            <li>
                                <a href="www.solutech.co.ke">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div>
    <!-- end container -->


</div>


<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>

<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

<script src="assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
<!-- Datatables-->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
<script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable({
            ajax: "assets/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
    });
    TableManageButtons.init();


    jQuery('#starttime').timepicker({
        minuteStep: 15
    });
    jQuery('#endtime').timepicker({
        minuteStep: 15
    });
    jQuery('#eventdate').datepicker({
        format: "yyyy-mm-dd",
        clearBtn: true
    });
</script>

</body>
</html>















