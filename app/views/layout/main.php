<?php
use core\Controllers\Loader;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>

        StartUp &middot; Marketing theme &middot; Official Bootstrap Themes

    </title>


    <link rel="stylesheet" href="/assets/css/bootstrap-theme.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets/css/tree.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.css" />
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">

    <script src="/assets/js/jquery.min.js" ></script>
    <script src="/assets/js/jquery-ui.js"></script>
    <script src="/assets/js/bootstrap.js" ></script>
    <script src="/assets/js/moment-with-locales.js" ></script>
    <script src="/assets/js/bootstrap-datetimepicker.js" ></script>
    <script src="/assets/js/lodash.js" ></script>
    <script src="/assets/js/arrows.1.0.0.js" ></script>
    <script src="/assets/js/variables.js" ></script>
    <script src="/assets/js/functions.js" ></script>


</head>


<body>

<?php
    if(Loader::app()->flashContent !== null){
        echo $this->partial('flashModal');
    }
?>

<?=$this->partial('header')?>
