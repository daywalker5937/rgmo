<?php

include_once __DIR__ . '/session.php';

$ses = Session::getInstance();
$ses->__unset($ses->id);
$ses->destroy();
header("location: ../index.php");

?>