<?php

    namespace Controllers;

    use DAO\AdminDao;
    use Models\Admin;

    class AdminController{
        
        private $adminDao;

        public function __construct()
        {
            $this->adminDao = new AdminDao();
        }

        public function ShowListView($admin)
        {
            
            $this->Add($admin);
            require_once(VIEWS_PATH."home.php");
        }

        public function Add(Admin $admin){

            if(!$this->verifyAdminId($admin->getId_admin())){
                if(!$this->verifyAdmin($admin->getEmail())){
                    $this->adminDao->Add($admin);
                    return true;
                }
            }
            return false;
        }
        
        // Verifica si existe el email
        public function verifyAdmin($email){
            $adminList = $this->adminDao->GetAll();
            foreach($adminList as $admin){
                if($admin->getEmail() == $email){
                    return true;
                }
                else{
                    return false;
                }
            }
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
    }
?>