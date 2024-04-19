<?php

require_once 'UserModel.php';
require_once 'UserView.php';

class UserController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function getUser($id) {
        $userData = $this->model->getUser($id);
        $this->view->output($userData);
    }
}

?>
