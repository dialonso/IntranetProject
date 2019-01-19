<?php 

session_start();
$rootPath = '/pfe/';

unset($_SESSION['user']);
unset($_SESSION['msg']);
header('Location:'.$rootPath);