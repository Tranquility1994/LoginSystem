<?php
/**
 * Created by PhpStorm.
 * User: Marthijn
 * Date: 14-1-2017
 * Time: 16:41
 */

require_once 'core/init.php';

$user = DB::getInstance()->update('users', 1, array(
    'username' => 'marthijn'
));