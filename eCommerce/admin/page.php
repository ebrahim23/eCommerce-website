<?php

    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

    if ($action == 'Manage') {
        echo 'Welcome in Manage Category Page ';
        echo '<a href="?action=Add">Add New Category +</a>';
    } elseif($action == "Add") {
        echo 'Welcome in Add Category Page';
    } elseif($action == "Insert") {
        echo 'Welcome in Insert Category Page';
    } else {
        echo 'Error There\'s no page with this name';
    }
