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
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/core.min.css') !!}
    {!! Html::style('assets/css/components.min.css') !!}
    {!! Html::style('assets/css/colors.min.css') !!}
    {!! Html::style('css/style.css') !!}
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
    {!! Html::script('assets/js/plugins/forms/styling/uniform.min.js') !!}
    {!! Html::script('assets/js/plugins/forms/styling/switchery.min.js') !!}
    {!! Html::script('assets/js/plugins/forms/inputs/touchspin.min.js') !!}
    {!! Html::script('assets/js/core/app.js') !!}
    {!! Html::script('assets/js/pages/form_input_groups.js') !!}
    {!! Html::script('assets/js/core/libraries/jquery_ui/interactions.min.js') !!}
    <!-- /theme JS files -->
</head>

<body>
<!-- Main navbar -->
<div class="navbar navbar-inverse2">
    <div class="navbar-boxed">
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a href="#">
                  {!! Html::image('images/sudamericana.jpg', '', ['width' => '160']) !!}
                </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" >
                  {!! Html::image('images/image_gallery6.png', '', ['width' => '86', 'height' => '20']) !!}
                </a></li>
                <li><a href="#" >
                  {!! Html::image('images/image_gallery7.png', '', ['width' => '86', 'height' => '20']) !!}
                </a></li>
                <li><a href="#" >
                  {!! Html::image('images/image_gallery8.png', '', ['width' => '86', 'height' => '20']) !!}
                </a></li>
                <li><a href="#" >
                  {!! Html::image('images/image_gallery11.png', '', ['width' => '86', 'height' => '20']) !!}
                </a></li>
                <li><a href="#" >
                  {!! Html::image('images/image_gallery2.png', '', ['width' => '86', 'height' => '20']) !!}
                </a></li>
                <li><a href="#" >
                  {!! Html::image('images/image_gallery13.png', '', ['width' => '86', 'height' => '20']) !!}
                </a></li>
                <li><a href="#" >
                  {!! Html::image('images/image_gallery2.png', '', ['width' => '86', 'height' => '20']) !!}
                </a></li>
            </ul>
        </div>
    </div>
</div>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container login-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    <!-- Footer -->
    <div class="footer text-muted">
        &copy; 2016. <a href="#">Powered by Sibas S.R.L.</a> © 2016 | <a href="#">Política de privacidad</a>
    </div>
    <!-- /footer -->
</div>
<!-- /page container -->
</body>
</html>
