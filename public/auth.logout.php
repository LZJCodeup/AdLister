<?php
require_once '../bootstrap.php';

Auth::logout();
header("Location: index.php");
    exit();

?>