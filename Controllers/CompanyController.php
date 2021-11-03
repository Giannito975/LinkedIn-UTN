<?php

namespace Controllers;

use Models\Company;
use DAO\CompanyDao;

class CompanyController{

    private $companyDao;

    public function __construct()
    {
        $this->companyDao = new CompanyDao();
    }

    public function ShowListView($company)
    {
        $this->Add($company);
        $this->GetAll();
        //$this->companyDao->DeleteCompany(2);
        require_once(VIEWS_PATH."home.php");
    }

    public function Add(Company $company){
        $companyList = $this->GetAll();
        if(empty($companyList)){
            $this->companyDao->Add($company);
        }
        elseif(!$this->verifyName($company->getName())){
            $this->companyDao->Add($company);
        }
    }

    public function GetAll(){
        try{
            $companyList = $this->companyDao->GetAll();
            
            $newCompanyList = array();
            foreach($companyList as $company){
                array_push($newCompanyList, $company);
            }
            return $newCompanyList;
        }

        catch(\PDOException $e){
            
            $message = $e->getMessage();
            $this->homeController->StudentView($message);
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
        $companyList = $this->GetAll();
        foreach($companyList as $company){
            if($company->getId_company() == $id){
                
                return true;
            }
        }
        return false;
    }

    public function verifyName($name){
        $companyList = $this->GetAll();
        foreach($companyList as $company){
            if($company->getName() == $name){
                
                return true;
            }
        }
        return false;
    }

}


?>