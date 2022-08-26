<!DOCTYPE html>
<html>
    <head>
		<title>@yield('title') - {{config('configs.app_name')}}</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="stylesheet" href="{{asset('adminlte/component/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('adminlte/component/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('adminlte/component/Ionicons/css/ionicons.min.css')}}">
		<link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">
		<link rel="stylesheet" href="{{asset('adminlte/css/skins/_all-skins.min.css')}}">
		@yield('stylesheets')
    </head>
    <body class="skin-blue @yield('class')">
		@yield('content')
		<script src="{{asset('adminlte/component/jquery/jquery.min.js')}}"></script>
		<script src="{{asset('adminlte/component/bootstrap/js/bootstrap.min.js')}}"></script>
		@stack('scripts')
    </body>
</html>