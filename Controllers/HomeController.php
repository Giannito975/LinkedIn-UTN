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
            $jobOfferController = new JobOfferController();

            require_once(VIEWS_PATH."home.php");
        }      
        
        public function HomeView(){
            require_once(VIEWS_PATH."home.php");
        }

        public function JobPositionView($message){
            var_dump($message);
            require_once(VIEWS_PATH."home.php");
        }

        /*public function CompanyListView(){

            $studentController = new StudentController();

            if($studentController->checkSessionStudent()){

                $companyController = new CompanyController();

                $companyList = $companyController->GetAll();
    
                require_once(VIEWS_PATH."company-list.php");
            }
            else{
                $studentController->Logout();
            }
        }*/

        /*public function StudentListView(){

            $studentController = new StudentController();

            if($studentController->checkSessionStudent()){

                $studentController = new StudentController();

                $studentList = $studentController->GetAllActive();

                require_once(VIEWS_PATH."student-profile.php");
            }
            else{
                $studentController->Logout();
            }
        }*/

        public function Login($email, $password){
            $studentController = new StudentController();
            $adminController = new AdminController();

            if($studentController->verifyStudent2($email, $password)){
               // session_start();
                $student = $studentController->GetByEmail($email);
                $_SESSION['loggedUser'] = $student;

                $jobOfferController = new JobOfferController();
                $jobOfferController->JobOfferListViewStudent();
                
            }elseif($adminController->verifyAdmin($email) && $adminController->verifyPassword($password)){
               // session_start();
                $admin = $adminController->GetByEmail($email);
                $_SESSION['loggedAdmin'] = $admin;
                $this->AdminView();
            }
        }

        public function LogOut(){
            session_destroy();  
            $this->HomeView();
        }

        public function AdminView(){
            require_once(VIEWS_PATH."admin-nav.php");            
        }
    }
?>