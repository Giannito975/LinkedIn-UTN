<?php

    namespace DAO;

use Exception;
use Models\Career;
    use Models\JobPosition;

    class JobPositionDAO
    {
        private $connection;
        private $jobPositionList = array();
        private $tableName = "jobPositions";
        private $tableName2 = "Careers";

        public function add()
        {
            try {

                $jobPositionList = $this->retrieveJobPositionJson();

                foreach($this->jobPositionList as $jobPosition){

                    $query = "INSERT INTO " . $this->tableName . "(jobPositionId, careerId, description) VALUES (:jobPositionId, :careerId, :description)";

                    $parameters['jobPositionId'] = $jobPosition->getJobPositionId();
                    $parameters['careerId'] = $jobPosition->getCareerId();
                    $parameters['description'] = $jobPosition->getDescription();

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }

            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function retrieveJobPositionJson(){
            $options = array(
                'http' => array(
                'method'=>"GET",
                'header'=>"x-api-key: 4f3bceed-50ba-4461-a910-518598664c08")
            );

            $context = stream_context_create($options);

            $json = file_get_contents('https://utn-students-api.herokuapp.com/api/JobPosition', false, $context);

            $arrayToDecode = ($json) ? json_decode($json, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $jobPosition = new JobPosition(
                    $valuesArray['jobPositionId'], 
                    $valuesArray['careerId'], 
                    $valuesArray['description']);
                    
                array_push($this->jobPositionList, $jobPosition);
            }
            return $this->jobPositionList;
        }

        function getAll()
        {
            try {
                $query= "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array());

                if (!empty($result)) {

                    foreach($result as $row){
                        $jobPosition = new JobPosition(
                            $row['jobPositionId'], 
                            $row['careerId'], 
                            $row['description']
                        );

                        array_push($this->jobPositionList, $jobPosition);
                    }
                }
                return $this->jobPositionList;

            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        function GetByCareerId($careerId){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE careerId = '".$careerId."'";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array());//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($result as $row){
                    $jobPosition = new JobPosition(
                        $row['jobPositionId'], 
                        $row['careerId'], 
                        $row['description']
                        );
                }
                return $jobPosition;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        function GetByDescription($description){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE description = '".$description."'";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                    
                foreach($result as $row){
                    $jobPosition = new JobPosition(
                        $row['jobPositionId'], 
                        $row['careerId'], 
                        $row['description']
                        );
                }
                return $jobPosition;
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        function remove($jobPositionId)
        {
            try {
                $query = "DELETE FROM " . $this->tableName . " WHERE (jobPositionId = :jobPositionId)";

                $parameters["jobPositionId"] = $jobPositionId;

                $this->connection = Connection::GetInstance();

                return $count = $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }
    }


?>