<!DOCTYPE html>
<html lang="en" ng-app="llzApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="/">
    <title ng-bind="title"></title>

    <!-- Styles -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/dep.css"/>
    <link rel="stylesheet" href="/admin/css/app.min.css"> -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/llz.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>


