<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

@yield('styles')
<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::to('public/css/app.css') }}"  type="text/css" >
    <link rel="stylesheet"  href="{{ URL::to('public/css/admin.css') }}"  type="text/css">
    <link rel="stylesheet"  href="{{ URL::to('public/css/form.css') }}"  type="text/css">
    <link rel="stylesheet"  href="{{ URL::to('public/css/common.css') }}"  type="text/css">


    <script src="{{ URL::to('public/js/jquery-3.2.0.js') }}" ></script>

</head>
<body>
@include('includes.admin-header')
@yield('content')
<script type="text/javascript">
    var baseUrl="{{ URL::to('/') }}";
</script>
@yield('scripts')
</body>
</html>
