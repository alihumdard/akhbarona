<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - Akhbarona</title>

    {!! HTML::style('admin/assets/css/app.css') !!}
    {!! HTML::style('admin/assets/css/fontawesome-all.min.css') !!}

    @yield('header-scripts')
</head>
<body class="auth">

    <div class="container">
        @yield('content')
    </div>

    {!! HTML::script('admin/assets/js/vendor.js') !!}
    {!! HTML::script('admin/assets/js/as/app.js') !!}
    {!! HTML::script('admin/assets/js/as/btn.js') !!}
    @yield('scripts')
</body>
</html>
