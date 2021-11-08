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

        public function Login($email, $password){
            $studentController = new StudentController();
            $adminController = new AdminController();


            if($email == '' && $password == ''){
                $studentEmail = $_COOKIE['loggedStudent'];
                $studentPassword = $studentController->GetByEmail($studentEmail);
                $studentPassword = $studentPassword->getPassword();
            
                $adminEmail = $_COOKIE['loggedAdmin'];
                $adminPassword = $adminController->GetByEmail($adminEmail);
                $adminPassword = $adminPassword->getPassword();
                if($studentController->verifyStudent2($studentEmail, $studentPassword)){

                    $student = $studentController->GetByEmail($studentEmail);
                    $studentFirstName = $student->getFirstName();
                    //inserto el nombre del estudiante en la cookie, el "true" corresponde a ocultar datos en la URL.
                    setcookie("loggedStudent","$studentFirstName", true);
    
                    $jobOfferController = new JobOfferController();
                    $jobOfferController->JobOfferListViewStudent();
                    
                }elseif($adminController->verifyAdmin($adminEmail)){
    
                    $admin = $adminController->GetByEmail($adminEmail);
                    setcookie("loggedAdmin","$adminEmail", true);
                    $adminController->AdminMainView();
                    $this->AdminView();
                    
                }
            }else{
                if($studentController->verifyStudent2($email, $password)){

                    $student = $studentController->GetByEmail($email);
                    $studentFirstName = $student->getFirstName();
                    //inserto el nombre del estudiante en la cookie, el "true" corresponde a ocultar datos en la URL.
                    setcookie("loggedStudent","$studentFirstName", true);
    
                    $jobOfferController = new JobOfferController();
                    $jobOfferController->JobOfferListViewStudent();
                    
                }elseif($adminController->verifyAdmin($email)){
                    var_dump($email);
                    $admin = $adminController->GetByEmail($email);
                    var_dump($admin);
                    $adminEmail = $admin->getEmail();
                    
                    setcookie("loggedAdmin","$adminEmail", true);
                    $adminController->AdminMainView();
                    $this->AdminView();
                    
                }
            }      
        }
        

        public function logOut(){
            setcookie("none","none", true);
            $this->HomeView();
        }


                        // ************************                  METODOS VERIFICACIONES Y SESIONES CON COOKIES                    ***********************

        //si no encuentro admin en la cookie, la elimino sobre escribiéndola así no podrá acceder a las vistas.
        public function checkValidAdmin(){
            if( isset($_COOKIE["loggedAdmin"]) ){
                return true;
            }else{
                setcookie("none","none", true);
                return false;
            }
        }

        //si no encuentro student en la cookie, la elimino sobre escribiéndola así no podrá acceder a las vistas.
        public function checkValidStudent(){
            if( isset($_COOKIE["loggedStudent"]) ){
                return true;
            }else{
                setcookie("none","none", true);
                return false;
            }
        }

        //envía al usuario web a la vista de home.
        public function kickUnloggedUser(){
            $this->HomeView();
        }

        //si no encuentra admin, te manda al home
        public function adminVerify(){
            if(!$this->checkValidAdmin()){
                $this->kickUnloggedUser();
            }
        }

        //si no encuentra student, te manda al home
        public function studentVerify(){
            if(!$this->checkValidStudent()){
                $this->kickUnloggedUser();
            }
        }

        

        public function AdminView(){

            require_once(VIEWS_PATH."admin-nav.php");            
        }
    }
?>