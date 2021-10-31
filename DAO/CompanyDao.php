<?php

    namespace DAO;

use Models\Company;

class CompanyDao{

        private $connection;
        private $companyList = array();
        private $tableName = "companies";

        public function Add(Company $company)
        {
            try
            {
                foreach($this->companyList as $company){

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
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }
        
    }



?>