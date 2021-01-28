<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/dekan.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?= $judul ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--  Material Dashboard CSS    -->
    <link href="<?= base_url() ?>/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?= base_url() ?>/assets/css/demo.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/css/mycss.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="<?= base_url(); ?>/assets/vendor/sweetalert2/dist/sweetalert.css" rel="stylesheet" type="text/css" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?= base_url() ?>/assets/js/material.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>/assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>

    <!-- js google chart
    <script type="text/javascript" src="http://www.google.com/jsapi"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <!-- Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="<?= base_url() ?>/assets/js/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
    <script src="<?= base_url() ?>/assets/js/nouislider.min.js"></script>

</head>

<body>
    <div class="wrapper">