<?php

    namespace DAO;

    use Exception;
    use Models\JobOffer;
    use Models\JobPosition;
    use Models\Company;

    class JobOfferDao{

        private $connection;
        private $jobOfferList = array();
        private $tableName = "JobOffers";

        public function add(JobOffer $jobOffer){
            try{
                $query = "INSERT INTO " . $this->tableName . "(jobPositionId, id_company, title, requirements, responsabilities, profits, salary) VALUES (:jobPositionId , :id_company , :title , :requirements , :responsabilities , :profits , :salary)";

                $parameters['jobPositionId'] = $jobOffer->getJobPositionId();
                $parameters['id_company'] = $jobOffer->getId_company();
                $parameters['title'] = $jobOffer->getTitle();
                $parameters['requirements'] = $jobOffer->getRequirements();
                $parameters['responsabilities'] = $jobOffer->getResponabilities();
                $parameters['profits'] = $jobOffer->getProfits();
                $parameters['salary'] = $jobOffer->getSalary();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (\PDOException $ex) {
                throw $ex;
            }
        }

        function getAll(){
            try {
                $query= "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array());

                if (!empty($result)) {

                    foreach($result as $row){
                        $jobOffer = new JobOffer(
                            $row['jobOfferId'], 
                            $row['jobPositionId'], 
                            $row['id_company'],
                            $row['title'],
                            $row['requirements'],
                            $row['responsabilities'],
                            $row['profits'],
                            $row['salary']
                        );

                        array_push($this->jobOfferList, $jobOffer);
                    }
                }
                return $this->jobOfferList;

            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function getById($jobOfferId){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE jobOfferId = '".$jobOfferId."'";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                    
                foreach($result as $row){
                    $jobOffer = new JobOffer(
                        $row['jobOfferId'], 
                        $row['jobPositionId'], 
                        $row['id_company'],
                        $row['title'],
                        $row['requirements'],
                        $row['responsabilities'],
                        $row['profits'],
                        $row['salary']
                    );
                }
                return $jobOffer;
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByIdArray($jobOfferId){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE jobOfferId = '".$jobOfferId."'";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                
                return $result;
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        function remove($jobOfferId){
            try {
                $query = "DELETE FROM " . $this->tableName . " WHERE (jobOfferId = :jobOfferId)";

                $parameters["jobOfferId"] = $jobOfferId;

                $this->connection = Connection::GetInstance();

                return $count = $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function update(JobOffer $jobOffer){
            try
            {
                $query= "UPDATE ".$this->tableName." SET  jobPositionId = :jobPositionId, id_company = :id_company, title = :title, requirements = :requirements, responsabilities = :responsabilities, profits = :profits, salary = :salary WHERE (jobOfferId = :jobOfferId)";
                
                $parameters['jobOfferId'] = $jobOffer->getJobOfferId();
                $parameters['jobPositionId'] = $jobOffer->getJobPositionId();
                $parameters['id_company'] = $jobOffer->getId_company();
                $parameters['title'] = $jobOffer->getTitle();
                $parameters['requirements'] = $jobOffer->getRequirements();
                $parameters['responsabilities'] = $jobOffer->getResponabilities();
                $parameters['profits'] = $jobOffer->getProfits();
                $parameters['salary'] = $jobOffer->getSalary();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }
    }
















?>