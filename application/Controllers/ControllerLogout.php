<?php

namespace Controllers;
use Core\Controller;
class ControllerLogout {
    public function actionIndex() {
        session_destroy();
        header("Location: /authorization");  
    }
}
