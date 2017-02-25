<?php
include_once '../core/init.php';

$passed = true;
$errors = array();

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
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
           $user = new User();
           $salt = Hash::salt(32);
           try {
               $user->create(array(
                   'username' => Input::get('username'),
                   'password' => Hash::make(Input::get('password'), $salt),
                   'salt' => $salt,
                   'name' => Input::get('name'),
                   'joined' => date('Y-m-d H:i:s'),
                   'groups' => 1
               ));

               Session::flash('success', 'You have successfully registered a new account.');
               Redirect::to('index.php');

           } catch (Exception $e) {
               die($e->getMessage());
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
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" value="Register" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php include_once '../includes/partials/footer.php'; ?>

