<?php

    namespace DAO;

use Exception;
use Models\Company;

class CompanyDao{

        private $connection;
        private $companyList = array();
        private $tableName = "companies";

        public function Add(Company $company){
            try
            {
                $query= "INSERT INTO ".$this->tableName."(name, about_us, company_link, email, industry, city, country) VALUES (:name, :about_us, :company_link, :email, :industry, :city, :country)";
    
                $parameters['name'] = $company->getName();
                $parameters['about_us'] = $company->getAbout_us();
                $parameters['company_link'] = $company->getCompany_link();
                $parameters['email'] = $company->getEmail();
                $parameters['industry'] = $company->getIndustry();
                $parameters['city'] = $company->getCity();
                $parameters['country'] = $company->getCountry();
            
                $this->connection =Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters); //el executeNonquery no retorna array, sino la cantidad de datos modificados
               
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetAll(){
            try {
                $query= "SELECT * FROM ".$this->tableName;
    
                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());
    
                foreach($result as $row){
                    $company = new Company(
                    $row['id_company'], 
                    $row['name'], 
                    $row['about_us'], 
                    $row["company_link"],
                    $row['email'], 
                    $row['industry'], 
                    $row["city"],
                    $row["country"]
                    );

                    array_push($this->companyList, $company);
                }
                return $this->companyList;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetById($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE id_company = '".$id."'";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                    
                foreach($result as $row){
                    $company = new Company(
                        $row['id_company'], 
                        $row['name'], 
                        $row['about_us'], 
                        $row["company_link"],
                        $row['email'], 
                        $row['industry'], 
                        $row["city"],
                        $row["country"]
                        );
                }
                return $company;
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByName($name){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE name = '".$name."'";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                    
                foreach($result as $row){
                    $company = new Company(
                        $row['id_company'], 
                        $row['name'], 
                        $row['about_us'], 
                        $row["company_link"],
                        $row['email'], 
                        $row['industry'], 
                        $row["city"],
                        $row["country"]
                        );
                }
                return $company;
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function UpdateCompany(Company $company){
            try
            {
                $query= "UPDATE ".$this->tableName." SET name = :name, about_us = :about_us, company_link = :company_link, email = :email, industry = :industry, city = :city, country = :country 
                WHERE (id_company = :id_company)";

                $parameters['id_company'] = $company->getId_company();
                $parameters['name'] = $company->getName();
                $parameters['about_us'] = $company->getAbout_us();
                $parameters['company_link'] = $company->getCompany_link();
                $parameters['email'] = $company->getEmail();
                $parameters['industry'] = $company->getIndustry();
                $parameters['city'] = $company->getCity();
                $parameters['country'] = $company->getCountry();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function Remove($id_company){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE (id_company = :id_company)";

                $parameters["id_company"] =  $id_company;

                $this->connection = Connection::GetInstance();

                return $count=$this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }
        
    }



?>