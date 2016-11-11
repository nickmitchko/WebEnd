<?php
/**
 * Created by PhpStorm.
 * User: nicholai
 * Date: 11/11/16
 * Time: 5:12 PM
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
    <title>Emotion Classifier</title>
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
<div class="row">
    <video id="video-bg">
    </video>
    <canvas id="canvas" width="640" height="480" style="position: absolute; z-index: 3; left: 0;"></canvas>
</div>
<div class="row">
    <button id="demo-menu-top-left"
            class="mdl-button mdl-js-button mdl-button--icon">
        <i class="material-icons">more_vert</i>
    </button>

    <ul id="options" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
        data-mdl-for="demo-menu-top-left">
    </ul>
</div>
<canvas id="canvas_hidden" style="display: none;" width="640" height="480"></canvas>
<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div>
<script src="js/material/material.min.js"></script>
<!-- Javascript -->
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script><!-- custom js -->
<script type="text/javascript" src="js/train.js"></script>
</body>
</html>