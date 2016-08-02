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
    {!! Html::style('assets/css/icons/fontawesome/styles.min.css') !!}
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap-combined.min.css') !!}
    {!! Html::style('assets/css/core.min.css') !!}
    {!! Html::style('assets/css/components.admin.min.css') !!}
    {!! Html::style('assets/css/colors.min.css') !!}
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/style_inbox.css') !!}
    {!! Html::style('css/animate.min.css') !!}
    {!! Html::style('summernote/dist/summernote.css') !!}

    <!-- /global stylesheets -->
    <!-- Core JS files -->
    {!! Html::script('assets/js/plugins/loaders/pace.min.js') !!}
    {!! Html::script('assets/js/core/libraries/jquery.min.js') !!}
    {!! Html::script('assets/js/core/libraries/bootstrap.min.js') !!}
    {!! Html::script('assets/js/plugins/loaders/blockui.min.js') !!}
    {!! Html::script('assets/js/plugins/ui/nicescroll.min.js') !!}
    {!! Html::script('assets/js/plugins/ui/drilldown.js') !!}
    {!! Html::script('assets/js/plugins/notifications/bootbox.min.js')!!}
    {!! Html::script('js/strength-meter.js')!!}
    <!-- /core JS files -->
    <!-- Theme JS files -->
    {!! Html::script('assets/js/plugins/forms/validation/validate.min.js') !!}
    {!! Html::script('assets/js/plugins/forms/selects/bootstrap_multiselect.js') !!}
    {!! Html::script('assets/js/plugins/forms/styling/uniform.min.js') !!}
    {!! Html::script('assets/js/plugins/forms/styling/switchery.min.js') !!}
    {!! Html::script('assets/js/plugins/forms/styling/switch.min.js') !!}
    {!! Html::script('assets/js/plugins/forms/inputs/touchspin.min.js') !!}

    {!! Html::script('assets/js/pages/form_input_groups.js') !!}
    {!! Html::script('assets/js/core/libraries/jquery_ui/interactions.min.js') !!}

    {!! Html::script('assets/js/pages/form_select2.js') !!}
    {!! Html::script('assets/js/plugins/forms/selects/bootstrap_select.min.js') !!}
    {!! Html::script('assets/js/pages/form_bootstrap_select.js') !!}
    {!! Html::script('assets/js/pages/form_validation.js') !!}
    {!! Html::script('js/functions.js') !!}
    {!! Html::script('summernote/dist/summernote.min.js') !!}
    {!! Html::script('assets/js/plugins/uploaders/fileinput.min.js') !!}
    {!! Html::script('assets/js/pages/uploader_bootstrap.js') !!}
    <!-- /theme JS files -->

    <!--picker date-->
    {!! Html::script('assets/js/core/libraries/jquery_ui/datepicker.min.js') !!}
    {!! Html::script('assets/js/plugins/ui/moment/moment.min.js') !!}
    {!! Html::script('assets/js/plugins/pickers/daterangepicker.js') !!}
    {!! Html::script('assets/js/plugins/pickers/anytime.min.js') !!}
    {!! Html::script('assets/js/plugins/pickers/pickadate/picker.js') !!}
    {!! Html::script('assets/js/plugins/pickers/pickadate/picker.date.js') !!}
    {!! Html::script('assets/js/plugins/pickers/pickadate/picker.time.js') !!}
    {!! Html::script('assets/js/plugins/pickers/pickadate/legacy.js') !!}
    {!! Html::script('assets/js/pages/picker_date.js') !!}
    <!--fin picker date-->

    <!--datatable-->
    {!! Html::script('assets/js/plugins/tables/datatables/datatables.min.js') !!}
    {!! Html::script('assets/js/plugins/tables/datatables/extensions/fixed_columns.min.js') !!}
    {!! Html::script('assets/js/plugins/forms/selects/select2.min.js') !!}
    {!! Html::script('assets/js/core/app.js') !!}
    {!! Html::script('assets/js/pages/datatables_extension_fixed_columns.js') !!}
    {!! Html::script('assets/js/pages/datatables_basic.js') !!}
    <!--fin datatable-->

    <!--notificacion-->
    {!! Html::script('assets/js/plugins/notifications/pnotify.min.js') !!}
    {!! Html::script('assets/js/plugins/notifications/noty.min.js') !!}
    {!! Html::script('assets/js/plugins/notifications/jgrowl.min.js') !!}
    {!! Html::script('assets/js/pages/components_notifications_other.js') !!}
    {!! Html::script('assets/js/plugins/notifications/sweet_alert.min.js') !!}

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/assets/abrenet-logo-admin.png') }}" style="margin-top: -9px; height: 38px;">
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
                    <i class="icon-user"></i>
                    <span>{{auth()->user()->full_name}}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('admin.user.profile', ['nav'=>'profile'])}}"><i class="icon-user-plus"></i> Mi perfil</a></li>
                    <li><a href="{{route('admin.user.account-setting', ['nav'=>'account_setting'])}}"><i class="icon-cog5"></i> Configuraciones de la cuenta</a></li>
                    <li><a href="{{route('auth.logout')}}"><i class="icon-switch2"></i> Salir</a></li>
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

                    &copy; 2016. <a href="#">Powered by Abrenet</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- The modal -->
<div class="modal fade colored-header" id="md-colored" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="info_alert">Eliminar registro</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <hr />
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle primary"><i class="fa fa-info"></i></div>
                    <h4 id="title_alert">Esta seguro que desea eliminar el registro?</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /page container -->

</body>
</html>
