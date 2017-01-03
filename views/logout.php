<?php
/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 03/01/2017
 * Time: 23:23
 */
session_start();
session_unset();
session_destroy();
header("location: index.php");