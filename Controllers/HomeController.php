<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            $studentController = new StudentController();
            $studentList = $studentController->ShowListView();
            require_once(VIEWS_PATH."home.php");
        }      
    }
?>