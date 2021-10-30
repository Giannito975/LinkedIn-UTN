<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            $studentController = new StudentController();
            $studentList = $studentController->GetAll();
            require_once(VIEWS_PATH."index.php");
        }        
    }
?>