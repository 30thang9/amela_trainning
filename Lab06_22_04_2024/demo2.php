<?php

require_once 'UserController.php';

$model = new UserModel();
$view = new UserView();
$controller = new UserController($model, $view);
$controller->getUser(123);

?>
