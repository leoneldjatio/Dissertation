<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>UBaDissertations</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Styles -->
    <!--<link href="{{ asset('sweetalert2.min.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-reboot.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    @section('navbar')
        @if (!Auth::guest())
            @include('layouts.navbar.navbar1')
    @show
    @else
        @include('layouts.navbar.navbar')
        @show
    @endif
    <main>
        @yield('content')
    </main>
</div>
<script src="{{ asset('js/jquery.min.js') }}" ></script>
<!--<script src="{{ asset('js/app.js') }}" ></script>-->
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/dropdown.js') }}" ></script>
<script src="{{ asset('js/styles.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $('#delete').on('show.bs.modal',function (event) {
        var button = $(event.relatedTarget)
        var thesis_id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #thesis').val(thesis_id)
    });
</script>
<script type="text/javascript">
    $('#deleteSearch').on('show.bs.modal',function (event) {
        var button = $(event.relatedTarget)
        var thesis_id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #SearchDel').val(thesis_id)
    });
</script>
</body>
</html>
