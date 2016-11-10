<?php
/**
 * Created by PhpStorm.
 * User: nicholai
 * Date: 9/15/16
 * Time: 3:33 PM
 */
?>

<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <title>Nicholai Mitchko</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nicholai Mitchko">
    <link rel="shortcut icon" href="favicon.ico">
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="css/font-awesome/font-awesome.css"><!--
    <link rel="stylesheet" href="css/material/material.min.css">-->
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue-deep_purple.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Theme CSS -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/index.css"
</head>

<body>
<video id="video-bg" style="position: absolute; z-index: 1;left: 0;">
</video>
<canvas id="canvas" width="640" height="480" style="position: absolute; z-index: 3; left: 0;"></canvas>
<a id="snap" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect pull-right">
    Single Shot
</a>
<a id="auto" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect pull-right">
    Continuous
</a>
<canvas id="canvas_hidden" style="display: none;" width="640" height="480"></canvas>
<script src="js/material/material.min.js"></script>
<!-- Javascript -->
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script><!-- custom js -->
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
