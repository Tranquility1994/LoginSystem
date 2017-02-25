<?php
/**
 * Created by PhpStorm.
 * User: Marthijn
 * Date: 14-1-2017
 * Time: 16:41
 */

require_once '../core/init.php';

?>
<?php include_once '../includes/partials/header.php'; ?>

<div class="container">
    <div class="well">
        <h1>Home</h1>
        <?php
        if (Session::exists('success')) {
            echo Session::flash('success');
        }
        ?>
    </div>
</div>

<?php include_once '../includes/partials/footer.php'; ?>