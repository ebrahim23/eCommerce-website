<?php

    include 'confic.php';

    // Routes
    $temp = 'includes/templates/';
    $css = 'layout/css/';
    $js = 'layout/js/';
    $lang = 'includes/languages/';
    $func = 'includes/functions/';

    // Include files
    include $func . 'funcs.php';
    include $lang . 'english.php';
    include $temp . 'header.php';

    if(!isset($noNav)) {
        include $temp . 'navbar.php';
    }
