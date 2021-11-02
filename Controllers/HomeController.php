<?php
    namespace Controllers;

    use Models\Admin;
    use Models\Company;

    class HomeController
    {
        public function Index($message = "")
        {
            $studentController = new StudentController();
            $careerController = new CareerController();
            $adminController = new AdminController();
            $companyController = new CompanyController();
            $studentList = $studentController->ShowListView();
            $careerList = $careerController->ShowListView();

            $admin = new Admin(null, "giannito@utn.com", "1234");
            $adminList = $adminController->ShowListView($admin);

            $company = new Company(null, "Globant", "Una empresa lider en el lavado de dinero", "globant.com", "globant@gmail.com", "Programacion", "Buenos Aires", "Argentina");
            $companyController->ShowListView($company);
            require_once(VIEWS_PATH."home.php");
        }      
    }
?>