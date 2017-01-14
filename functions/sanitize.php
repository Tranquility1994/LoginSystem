<?php
/**
 * Created by PhpStorm.
 * User: Marthijn
 * Date: 14-1-2017
 * Time: 16:47
 */

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}