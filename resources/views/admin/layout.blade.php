<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador</title>

    <!-- Global stylesheets -->
    {!! Html::style('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900') !!}
    {!! Html::style('assets/css/icons/icomoon/styles.css') !!}
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/core.min.css') !!}
    {!! Html::style('assets/css/components.admin.min.css') !!}
    {!! Html::style('assets/css/colors.min.css') !!}
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    {!! Html::script('assets/js/plugins/loaders/pace.min.js') !!}
    {!! Html::script('assets/js/core/libraries/jquery.min.js') !!}
    {!! Html::script('assets/js/core/libraries/bootstrap.min.js') !!}
    {!! Html::script('assets/js/plugins/loaders/blockui.min.js') !!}
    <!-- /core JS files -->

    @if($nav=='user')
        @if($action=='list')
            <!-- Theme JS files -->
            {!! Html::script('assets/js/plugins/tables/datatables/datatables.min.js') !!}
            {!! Html::script('assets/js/plugins/forms/selects/select2.min.js') !!}

            {!! Html::script('assets/js/core/app.js') !!}
            {!! Html::script('assets/js/pages/datatables_basic.js') !!}
            <!-- /theme JS files -->
        @elseif($action=='new'|| $action=='edit' || $action=='changepass' || $action=='resetpass')
            <!-- Theme JS files -->
            {!! Html::script('assets/js/plugins/forms/styling/uniform.min.js') !!}

            {!! Html::script('assets/js/core/app.js') !!}
            {!! Html::script('assets/js/pages/form_inputs.js') !!}
            <!-- /theme JS files -->
        @endif
    @elseif($nav=='begin')
        <!-- Theme JS files -->
        {!! Html::script('assets/js/plugins/visualization/d3/d3.min.js') !!}
        {!! Html::script('assets/js/plugins/visualization/d3/d3_tooltip.js') !!}
        {!! Html::script('assets/js/plugins/forms/styling/switchery.min.js') !!}
        {!! Html::script('assets/js/plugins/forms/styling/uniform.min.js') !!}
        {!! Html::script('assets/js/plugins/forms/selects/bootstrap_multiselect.js') !!}
        {!! Html::script('assets/js/plugins/ui/moment/moment.min.js') !!}
        {!! Html::script('assets/js/plugins/pickers/daterangepicker.js') !!}

        {!! Html::script('assets/js/core/app.js') !!}
        {!! Html::script('assets/js/pages/dashboard.js') !!}
        <!-- /theme JS files -->
    @endif


</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/assets/abrenet-logo.png') }}" style="margin-top: -9px; height: 38px;">
        </a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <!--
        <p class="navbar-text"><span class="label bg-success-400">Online</span></p>
        -->
        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('images/placeholder.jpg') }}" alt="">
                    <span>Victoria</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                    <li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- User menu -->
                @yield('menu-user')
                <!-- /user menu -->

                <!-- Main navigation -->
                @yield('menu-main')
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                @yield('header')
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <!-- Dashboard content -->
                @yield('content')
                <!-- /dashboard content -->


                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2015. <a href="#">Limitless Web App Kit</a> by
                    <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
