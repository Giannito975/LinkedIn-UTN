<?php

    namespace Controllers;

    use DAO\AdminDao;
    use Models\Admin;

    class AdminController{
        
        private $adminDao;
        private $homeController;

        public function __construct()
        {
            $this->adminDao = new AdminDao();
            $this->homeController = new HomeController();
        }

        public function ShowListView($admin)
        {
            if($this->checkSessionAdmin()){
                $this->Add($admin);
                require_once(VIEWS_PATH."home.php");
            }
            else{
                $this->Logout();
            }

        }

        public function AdminMainView(){
            if($this->checkSessionAdmin()){
                require_once(VIEWS_PATH."admin-main-view.php");
            }
            else{
                $this->Logout();
            }
        }

        public function ShowModifyCompany(){
            if($this->checkSessionAdmin()){
                require_once(VIEWS_PATH."company-list-admin.php");
            }
            else{
                $this->Logout();
            }
        }

        public function ShowJobOfferViewAdmin(){
            if($this->checkSessionAdmin()){
                require_once(VIEWS_PATH."job-offer-admin.php");
            }
            else{
                $this->Logout();
            }
        }



        public function Add(Admin $admin){
            if(!$this->verifyAdmin($admin->getEmail())){
                $this->adminDao->Add($admin);
                return true;
            }
            return false;
        }

        public function GetByEmail($email){
            if($this->verifyAdmin($email)){
                $admin = $this->adminDao->GetByEmail($email);
                return $admin;
            }
            return null;
        }
        
        // Verifica si existe el email
        public function verifyAdmin($email){
            $adminList = $this->adminDao->GetAll();
            foreach($adminList as $admin){
                if($admin->getEmail() == $email){
                    return true;
                }
            }
            return false;
        }

        // Verifica si existe un admin con el mismo id
        public function verifyAdminId($id){
            $adminList = $this->adminDao->GetAll();
            foreach($adminList as $admin){
                if($admin->getId_admin() == $id){
                    return true;
                }
                else{
                    return false;
                }
            }
        }

        public function loginAdmin($email){
            if($this->verifyAdmin($email)){
                $this->homeController->AdminView();
            }
        }
    }
?>