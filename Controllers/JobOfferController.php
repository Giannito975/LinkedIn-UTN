<?php

    namespace Controllers;

    use DAO\JobOfferDao;
    use DAO\JobPositionDAO;
    use DAO\CompanyDao;
    use Models\JobOffer;

    class JobOfferController{

        private $jobOfferDao;
        private $jobPositionDao;
        private $companyDao;

        public function __construct()
        {
            $this->jobOfferDao = new JobOfferDao();
            $this->jobPositionDao = new JobPositionDAO();
            $this->companyDao = new CompanyDao();
        }

<<<<<<< HEAD
        public function JobOfferListViewAdmin(){

            $jobOfferController = new JobOfferController();
    
            $jobOfferList = $jobOfferController->GetAll();

            $companyList = $this->companyDao->GetAll();
            
    
            require_once(VIEWS_PATH."job-offer-list-admin.php");
        }

        public function RemoveJobOffer($id){
            if($this->remove($id)){
                header("location: ".FRONT_ROOT."JobOffer/JobOfferListViewAdmin");
                echo "<script> alert('JobOffer succesfully removed');
                        window.location='Views\job-offer-list-admin.php'
                        </script>";
            }
            else{
                echo "<script> alert('Cannot remove Job Offer');
                        window.location='Views\job-offer-list-admin.php'
                        </script>";
            }
        }

        public function add($name, $description){
            $company = $this->companyDao->GetByName($name);
            $idCompany = $company->getId_company();
=======
        public function add($idJobPosition, $idCompany, $title, $requirements, $responsabilities, $profits, $salary){
>>>>>>> 55adef0c9040ce9d3c5cd3a5574d948ceca30491

            $jobOffer = new JobOffer(null, $idJobPosition, $idCompany, $title, $requirements, $responsabilities, $profits, $salary);

            $this->jobOfferDao->add($jobOffer);
        }

        public function getAll(){
           try{
                
                $jobOfferArray = $this->jobOfferDao->GetAll();
                $newjobOfferArray = array();
                foreach($jobOfferArray as $jobOffer){
                    array_push($newjobOfferArray, $jobOffer);
                }
                return $newjobOfferArray;
            }
            catch(\PDOException $e){
            
                $message = $e->getMessage();
                $this->homeController->JobPositionView($message);
                return null;
            }  
        }

        public function verifyGetAll(){
            if(!empty($this->GetAll())){
                return true;
            }
            else{
                return false;
            }
        }

        public function verifyId($id){
            $jobOfferList = $this->GetAll();
            foreach($jobOfferList as $jobOffer){
                if($jobOffer->getJobOfferId() == $id){
                    
                    return true;
                }
            }
            return false;
        }

        public function remove($jobOfferId){
            if($this->verifyId($jobOfferId)){
                $this->jobOfferDao->remove($jobOfferId);
                return true;
            }
            else{
                return false;
            }
        }

        public function update($jobOffer){
            if($this->verifyId($jobOffer->getJobOfferId())){
                $this->jobOfferDao->update($jobOffer);
            }
            else{
                return null;
            }
        }
    }












?>