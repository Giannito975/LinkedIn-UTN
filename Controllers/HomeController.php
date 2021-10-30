<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            $studentController = new StudentController();
            $careerController = new CareerController();
            $studentList = $studentController->ShowListView();
            $careerList = $careerController->ShowListView();
            require_once(VIEWS_PATH."home.php");
        }      
    }
?>