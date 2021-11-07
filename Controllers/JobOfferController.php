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

        public function JobOfferListViewAdmin(){

            $jobOfferController = new JobOfferController();
    
            $jobOfferList = $jobOfferController->GetAll();
    
            require_once(VIEWS_PATH."job-offer-list-admin.php");
        }

        public function add($name, $description){
            $company = $this->companyDao->GetByName($name);
            $idCompany = $company->getId_company();

            $jobPosition = $this->jobPositionDao->GetByDescription($description);
            $idJobPosition = $jobPosition->getJobPositionId();

            $jobOffer = new JobOffer(null, $idJobPosition, $idCompany, "Desarrollador Java", "Java 8, Springboot, git", "Debera hacerse cargo de un proyecto entero sin documentacion alguna", "Muchos", 0);

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
            }
            else{
                return null;
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