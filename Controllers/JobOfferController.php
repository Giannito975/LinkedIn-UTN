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

            $companyList = $this->companyDao->GetAll();
            
    
            require_once(VIEWS_PATH."job-offer-list-admin.php");
        }

        public function ShowCreateJobOfferView(){

            $jobPositionList = $this->jobPositionDao->GetAll();
            $companyList = $this->companyDao->GetAll();

            require_once(VIEWS_PATH."create-job-offer.php");

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

        public function CreateJobOffer($title, $requirements, $responsabilities, $profits, $salary, $idJobPosition, $idCompany){

            $this->add($idJobPosition, $idCompany, $title, $requirements, $responsabilities, $profits, $salary);
            header("location: ".FRONT_ROOT."JobOffer/JobOfferListViewAdmin");
        }

        public function add($idJobPosition, $idCompany, $title, $requirements, $responsabilities, $profits, $salary){
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