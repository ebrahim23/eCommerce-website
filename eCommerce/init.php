<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    include 'admin/confic.php';

    $sessionUser = '';
    if(isset($_SESSION['user'])){
      $sessionUser = $_SESSION['user'];
    }

    // Routes
    $temp   = 'includes/templates/';
    $css    = 'layout/css/';
    $js     = 'layout/js/';
    $lang   = 'includes/languages/';
    $func   = 'includes/functions/';

    // Include files
    include $func . 'funcs.php';
    include $lang . 'english.php';
    include $temp . 'header.php';
