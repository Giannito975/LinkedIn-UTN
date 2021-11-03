<?php

    namespace Controllers;

    use DAO\JobPositionDAO;
    use Models\JobPosition;

    class JobPositionController{

        private $jobPositionDao;

        public function __construct()
        {
            $this->jobPositionDao = new JobPositionDAO();
        }

        public function ShowListView()
        {
            $this->add();

            require_once(VIEWS_PATH."home.php");
        }

        public function add(){
            $jobPositionList = $this->jobPositionDao->retrieveJobPositionJson();
            if($this->verifyGetAll()){
                foreach($jobPositionList as $jobPosition){
                    if(!$this->verifyId($jobPosition->getJobPositionId())){
                        $this->jobPositionDAO->Add();
                    }
                }
            }
        }

        public function GetAll(){
            try{
                
                $jobPositionArray = $this->jobPositionDao->GetAll();
                $newjobPositionArray = array();
                foreach($jobPositionArray as $jobPosition){
                    array_push($newjobPositionArray, $jobPosition);
                }
                return $newjobPositionArray;
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
            $jobPositiontList = $this->GetAll();
            foreach($jobPositiontList as $jobPositiont){
                if($jobPositiont->getJobPositionId() == $id){
                    return true;
                }
            }
            return false;
        }
    }





?>