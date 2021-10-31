<?php
    namespace Controllers;

    use Models\Admin;

    class HomeController
    {
        public function Index($message = "")
        {
            $studentController = new StudentController();
            $careerController = new CareerController();
            $adminController = new AdminController();
            $studentList = $studentController->ShowListView();
            $careerList = $careerController->ShowListView();

            $admin = new Admin("dantegh720@utn.com", "1234");
            $adminList = $adminController->Add($admin);
            require_once(VIEWS_PATH."home.php");
        }      
    }
?>