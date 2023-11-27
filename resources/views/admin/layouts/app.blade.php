<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - Akhbarona</title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('admin/assets/img/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url('admin/assets/img/icons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ url('admin/assets/img/icons/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('admin/assets/img/icons/favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="Akhbarona"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ url('admin/assets/img/icons/mstile-144x144.png') }}" />

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('admin/assets/css/vendor.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('admin/assets/css/app.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">

    @yield('styles')
</head>
<body>
    @include('admin.partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('admin.partials.sidebar')

            <div class="content-page">
                <main role="main" class="px-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <div id="modal_loading" class="modal" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content" style="width: 134px;top: 133px;left: 50%;">
                <button type="button" style="display: none;" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body">
                    <img src="{{asset('admin/assets/img/loading.gif')}}" style="width: auto;">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/as/app.js') }}"></script>
    <script>
        function processTabs(obj, arrTab, _class) {
            var _id = $(obj).attr("data-id");
            for (var i in arrTab) {
                if (arrTab[i] != _id) {
                    $('#' + arrTab[i]).hide();
                    $("." + _class + " li").find('a[data-id=' + arrTab[i] + ']').parent().removeClass('active');
                } else {
                    $('#' + _id).show();
                    $(obj).parent().attr("class", "active");

                }
            }
        }
    </script>
    @yield('scripts')
    <script>
        function showNoticeSuccess(data) {
            $("#notice_success").html('<i class="fa fa-check"></i>' + data.message);
            $("#notice_success").show();
            setTimeout(function(){ $("#notice_success").hide(); }, 5000);
        }
        function showNoticeError(data) {
            $("#notice_error li").html(data.message);
            $("#notice_error").show();
            setTimeout(function(){ $("#notice_error").hide(); }, 5000);
        }
    </script>
</body>
</html>
