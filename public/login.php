<?php include_once '../core/init.php'; ?>

<?php

$passed = true;
$errors = array();

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        $passed = $validation->passed();
        if (!$passed) {
            $errors = $validation->errors();
        } else {
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));
            if ($login) {
                Redirect::to('index.php');
            } else {
                //TODO: Handling failed login messages.
            }
        }
    }
}

?>

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
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="btn-group ">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" value="Register" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php include_once '../includes/partials/footer.php'; ?>