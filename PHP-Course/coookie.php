<?php

    $mainColor = '#F00';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mainColor = $_POST['color'];
        setcookie('bg', $mainColor, time() + 3600, '/');
    }

    if(isset($_COOKIE['bg'])){
        $body = $_COOKIE['bg'];
    } else{
        $body = $mainColor;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body style="background-color: <?php echo $body; ?>">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="color" name="color">
            <input type="submit" value="Choose Color">
        </form>
    </body>
</html>