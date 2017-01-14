<?php
/**
 * Created by PhpStorm.
 * User: Marthijn
 * Date: 14-1-2017
 * Time: 16:41
 */

require_once '../core/init.php';

$user = DB::getInstance()->get('users', array('username', '=', 'marthijn'));

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

    <?php include_once '../includes/partials/header.php'; ?>

    <div class="container">
    <?php
        if (!$user->error()) {
            echo $user->first()->username;
        }
    ?>
    </div>

    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
