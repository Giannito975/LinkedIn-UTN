<?php
    namespace Controllers;

    use Models\Admin;
    use Models\Company;
use Models\JobPosition;

class HomeController
    {
        public function Index($message = "")
        {
            $studentController = new StudentController();
            $careerController = new CareerController();
            $adminController = new AdminController();
            $companyController = new CompanyController();
            $jobPositionController = new JobPositionController();
            $studentList = $studentController->ShowListView();
            $careerList = $careerController->ShowListView();

            $admin = new Admin(null, "giannito@utn.com", "1234");
            $adminList = $adminController->ShowListView($admin);

            $company = new Company(null, "Globant", "Una empresa lider en el lavado de dinero", "globant.com", "globant@gmail.com", "Programacion", "Buenos Aires", "Argentina");
            $companyController->ShowListView($company);

            $jobPositionController->ShowListView();
            require_once(VIEWS_PATH."home.php");
        }      
        
        public function HomeView(){
            require_once(VIEWS_PATH."home.php");
        }

        public function JobPositionView($message){
            var_dump($message);
            require_once(VIEWS_PATH."home.php");
        }

        public function CompanyListView(){

            $companyController = new CompanyController();

            $companyList = $companyController->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function StudentListView(){

            $studentController = new StudentController();

            $studentList = $studentController->GetAllActive();

            require_once(VIEWS_PATH."student-profile.php");
        }

        public function AdminView(){

            require_once(VIEWS_PATH."admin-nav.php");

            
        }
    }
?>