<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sibas</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    {!! Html::style('assets/css/icons/icomoon/styles.css') !!}
    {!! Html::style('assets/css/icons/fontawesome/styles.min.css') !!}
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/core.min.css') !!}
    {!! Html::style('assets/css/components.min.css') !!}
    {!! Html::style('assets/css/colors.min.css') !!}
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/style_inbox.css') !!}
            <!-- /global stylesheets -->
    <!-- Core JS files -->
    {!! Html::script('assets/js/plugins/loaders/pace.min.js') !!}
    {!! Html::script('assets/js/core/libraries/jquery.min.js') !!}
    {!! Html::script('assets/js/core/libraries/bootstrap.min.js') !!}
    {!! Html::script('assets/js/plugins/loaders/blockui.min.js') !!}
    {!! Html::script('assets/js/plugins/ui/nicescroll.min.js') !!}
    {!! Html::script('assets/js/plugins/ui/drilldown.js') !!}
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
    
    <!--fin notificacion-->
    
    
</head>
<body class="layout-boxed">
<!-- Main navbar -->
@yield('header')
<!-- /main navbar -->
<div class="page-header">
    <div class="page-header-content">
        <div class="cabecera">
        </div>
    </div>
</div>
<!-- Second navbar -->
@yield('menu-main')
<!-- /second navbar -->
<!-- Page header -->
@yield('menu-header')
<!-- /page header -->
<!-- Page container -->
<div class="page-container @yield('class-container')">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Grid -->
            @yield('content-wrapper')

        </div>
        <!-- /grid -->
    </div>
    <!-- /main content -->
    <!-- Footer -->
    <div class="footer text-muted">
        &copy; 2016. <a href="#">Powered by Abrenet</a> © 2016 | <a href="#">Política de privacidad</a>
    </div>
    <!-- /footer -->
</div>
<!-- modal information product -->
@include('partials.information_product')
<!-- /modal -->
</body>
</html>
