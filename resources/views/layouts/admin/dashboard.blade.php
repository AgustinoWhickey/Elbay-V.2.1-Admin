<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>Elbay Admin</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/extras/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('global_assets/js/main/jquery.min.js') }} "></script>
    <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('global_assets/js/plugins/visualization/d3/d3.min.js') }} "></script>
    <script src="{{ asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js') }} "></script>
    <script src="{{ asset('global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/wizards/steps.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/extensions/jquery_ui/widgets.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
    
    <script src="../../../../global_assets/js/plugins/pickers/pickadate/picker.js"></script>
	  <script src="../../../../global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>

    <script src="{{ asset('js/datatables.min.js') }} "></script>

    <script src="{{ asset('global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>

    <script src="{{ asset('global_assets/js/demo_pages/extra_sweetalert.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script src="{{ asset('global_assets/js/demo_pages/dashboard.js') }} "></script>
    <script src="{{ asset('global_assets/js/demo_pages/form_wizard.js') }} "></script>
    <script src="{{ asset('global_assets/js/demo_pages/charts/echarts/columns_waterfalls.js') }} "></script>
    <script src="{{ asset('global_assets/js/demo_pages/form_checkboxes_radios.js') }} "></script>
    <script src="{{ asset('global_assets/js/demo_pages/picker_date.js') }} "></script>
    <script src="{{ asset('global_assets/js/demo_pages/job_apply.js') }} "></script>
    
  </head>
  <body>
    @include('partials.navbar')
    @include('partials.admin.sidebar')
    @yield('container')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>