<?php

    namespace Controllers;

    use DAO\CareerDao;
    use DAO\JobOfferDao;
    use DAO\JobPositionDAO;
    use DAO\JobOfferXStudentDao;
    use DAO\CompanyDao;
    use Models\JobOffer;

class JobOfferController{

        private $jobOfferDao;
        private $jobPositionDao;
        private $companyDao;
        private $careerDao;
        private $jobOfferXStudentDao;

        public function __construct()
        {
            $this->jobOfferDao = new JobOfferDao();
            $this->jobPositionDao = new JobPositionDAO();
            $this->companyDao = new CompanyDao();
            $this->careerDao = new CareerDao();
            $this->jobOfferXStudentDao = new JobOfferXStudentDao();
        }

        public function JobOfferListViewAdmin($message = ""){

            $jobOfferController = new JobOfferController();
    
            $jobOfferList = $jobOfferController->GetAll();

            $companyList = $this->companyDao->GetAll();

            $jobPositionList = $this->jobPositionDao->getAll();
            
            $careerList = $this->careerDao->getAll();

            $jobOfferXStudentList = $this->jobOfferXStudentDao->getAll();
    
            require_once(VIEWS_PATH."job-offer-list-admin.php");
        }

        public function JobOfferListViewStudent($jobOfferArray = ""){

            
            
            $jobOfferController = new JobOfferController();

            $jobOfferXStudentController = new JobOfferXStudentController();

            $careerList = $this->careerDao->getAll();

            if($jobOfferArray == ""){
                $jobOfferArray = $this->jobOfferDao->getAll();
            }
            if(empty($jobOfferArray)){
                $jobOfferArray = array();
            }

            $companyList = $this->companyDao->GetAll();

            $jobPositionList = $this->jobPositionDao->getAll();

            require_once(VIEWS_PATH."job-offer-list-student.php");
        }

        public function ShowCreateJobOfferView(){

            $jobPositionList = $this->jobPositionDao->GetAll();
            $companyList = $this->companyDao->GetAll();

            require_once(VIEWS_PATH."create-job-offer.php");

        }

        public function ShowModifyJobOfferView($id){
            $jobOffer = $this->jobOfferDao->getById($id);
            $jobPositionList = $this->jobPositionDao->GetAll();
            $companyList = $this->companyDao->GetAll();
            require_once(VIEWS_PATH."job-offer-modify.php");
        }

        public function RemoveJobOffer($id){
            if($this->remove($id)){
                header("location: ".FRONT_ROOT."JobOffer/JobOfferListViewAdmin");
                echo '<script type="text/javascript"> alert("JobOffer succesfully removed");
                        window.location="Views\job-offer-list-admin.php"
                        </script>';
            }
            else{
                echo '<script type="text/javascript"> alert("Cannot remove Job Offer");
                        window.location="Views\job-offer-list-admin.php"
                        </script>';
            }
        }

        public function CreateJobOffer($title, $requirements, $responsabilities, $profits, $salary, $idJobPosition, $idCompany){

            $this->add($idJobPosition, $idCompany, $title, $requirements, $responsabilities, $profits, $salary);

        }

        public function add($idJobPosition, $idCompany, $title, $requirements, $responsabilities, $profits, $salary){
            
            if(!$this->verifyJobOffer($title, $idCompany)){
                
                $jobOffer = new JobOffer(null, $idJobPosition, $idCompany, $title, $requirements, $responsabilities, $profits, $salary);
                $this->jobOfferDao->add($jobOffer);

                $message = "Create with success";
                $this->JobOfferListViewAdmin($message);
            }
            else{
                $message = "Cannot create because that name it already exists";
                $this->JobOfferListViewAdmin($message);
            }
        }

        public function ModifyJobOffer($jobOfferId, $title, $requirements, $responsabilities, $profits, $salary, $jobPositionId, $idCompany){
            
            $jobOffer = new JobOffer($jobOfferId, $jobPositionId, $idCompany, $title, $requirements, $responsabilities, $profits, $salary);
                if($this->update($jobOffer)){
                    $message = "Modify with success";
                    $this->JobOfferListViewAdmin($message);
                }
            
            else{
                $message = "Cannot modify because that name it already exists";
                $this->JobOfferListViewAdmin($message);
            }
        }

        public function FilterByCareer($filter){

            $jobOfferArray = array();
            if($filter != "Click to select filter parameter"){

                $career = $this->careerDao->GetByDescription($filter);
                $jobOfferList = $this->getAll();
                $jobPositionList = $this->jobPositionDao->GetByCareerId($career->getCareerId());
                foreach($jobPositionList as $jobPosition){
                    foreach($jobOfferList as $jobOffer){
                        if($jobOffer->getJobPositionId() == $jobPosition->getJobPositionId()){
                            if( $jobPosition->getCareerId() == $career->getCareerId()){
                                array_push($jobOfferArray, $jobOffer);
                            }
                        }
                    }
                }
                //sobre escribo $jobOfferList para probar que se muestren bien una vez filtrados
                $this->JobOfferListViewStudent($jobOfferArray);
            }else{
                $this->JobOfferListViewStudent();
            }
            
        }

        public function FilterByJob($filter){

            $jobOfferArray = array();
            if($filter != "Click to select filter parameter"){

                $jobPosition = $this->jobPositionDao->GetByDescription($filter);
                $jobOfferList = $this->getAll();
                foreach($jobOfferList as $jobOffer){
                    if($jobOffer->getJobPositionId() == $jobPosition->getJobPositionId()){
                        array_push($jobOfferArray, $jobOffer);
                    }
                }
                $this->JobOfferListViewStudent($jobOfferArray);
            }else{
                $this->JobOfferListViewStudent();
            }
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

        //Verifica si ya existe un job offer en una empresa con el mismo nombre
        public function verifyJobOffer($title, $idCompany){

            $jobOfferList = $this->jobOfferDao->getAll();
            foreach($jobOfferList as $jobOffer){
                //Verifica el id
                if($idCompany == $jobOffer->getId_company()){
                    //Verifica el titulo
                    if(strcasecmp($jobOffer->getTitle(), $title) == 0){
                        return true;
                    }   
                }
            }
            return false;
        }

        public function verifyJobOfferModify($title, $idCompany, $jobOfferId){

            $jobOffer = $this->jobOfferDao->getById($jobOfferId);
            $jobOfferTitleList = $this->jobOfferDao->getByTitle($title);
            foreach($jobOfferTitleList as $jobOfferTitle){
                if($jobOfferTitle->getId_company() == $idCompany){
                    if(strcasecmp($jobOffer->getTitle(), $title) == 0){
                        return true; //Modifica sin cambiar de empresa
                    }
                }
            }
        return false;
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
                if($this->verifyJobOfferModify
                    ($jobOffer->getTitle(), $jobOffer->getId_company(), $jobOffer->getJobOfferId())){

                    $this->jobOfferDao->update($jobOffer);
                    return true;
                }
                return false;
        }
    }












?>