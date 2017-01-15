<?php
include_once '../core/init.php';

$passed = true;
$errors = array();

if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'username' => array(
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password' => array(
            'required' => true,
            'min' => 6
        ),
        'password_again' => array(
            'required' => true,
            'matches' => 'password'
        ),
        'name' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
        )
    ));

    $passed = $validation->passed();
    if (!$passed) {
        $errors = $validation->errors();
    } else {
        echo "true";
    }
}

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
    <div class="well">
        <?php
        if (!$passed) { ?>
            <div class="alert alert-danger">
                <b>Fix the following errors to continue:</b>
                <ul>
                <?php
                foreach($errors as $error) {
                    echo "<li>$error</li>";
                }
                ?>
                </ul>
            </div>
        <?php } ?>
        <form action="" method="post">
            <div class="input-group col-md-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo escape(Input::get('username')); ?>">
            </div>

            <div class="input-group col-md-3">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo escape(Input::get('name')); ?>">
            </div>

            <div class="input-group col-md-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="input-group col-md-3">
                <label for="password_again">Password confirmation</label>
                <input type="password" class="form-control" name="password_again">
            </div>
            <div class="btn-group ">
                <input type="submit" value="Register" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>