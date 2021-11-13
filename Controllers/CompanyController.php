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

    public function ShowCompanyList(){
        require_once(VIEWS_PATH."company-list.php");
    }

    public function ShowListView($company)
    {
        $this->Add($company);
        $this->GetAll();
        //$this->companyDao->DeleteCompany(2);
        require_once(VIEWS_PATH."home.php");
    }

    public function ShowModifyCompanyView($id){
        $company = $this->companyDao->GetById($id);
        require_once(VIEWS_PATH."company-modify.php");
    }

     //Vista para user ADMIN
    public function CompanyListViewAdmin(){

        $companyController = new CompanyController();

        $companyList = $companyController->GetAll();

        require_once(VIEWS_PATH."company-list-admin.php");
    }

    public function ModifyCompany($id, $name, $aboutUs, $companyLink, $email, $industry, $city, $country){
        $company = $this->GetById($id);
        if(!$this->verifyName($company->getName())){
            $company = new Company($id, $name, $aboutUs, $companyLink, $email, $industry, $city, $country);
            $this->companyDao->UpdateCompany($company);
        } 
        $this->CompanyListViewAdmin();
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

    public function GetById($companyId){
        if(!empty($this->companyDao->GetById($companyId))){
            $company = $this->companyDao->GetById($companyId);
            return $company;
        }
        return null;
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
            $num = strcasecmp($company->getName(), $name);
            if($num == 0){
                
                return true;
            }
        }
        return false;
    }

    public function ShowCreateCompanyView(){
        require_once(VIEWS_PATH."create-company.php");
    }

    public function ShowCompanyProfile($id = 0){
        if($id != 0){
            $company = $this->companyDao->GetById($id);
        }
        require_once(VIEWS_PATH."company-profile.php");
    }

    //este metodo funciona asi como esta, nos falta hacer la excepcion: se nos rompia todo al joraca
    public function CreateCompany($name, $aboutUs, $companyLink, $email, $industry, $city, $country){
        if(!$this->verifyName($name)){
            $company = new Company(null, $name, $aboutUs, $companyLink, $email, $industry, $city, $country);
            $this->companyDao->Add($company);
        }
        $this->CompanyListViewAdmin();
    }


    public function RemoveCompany($id){
        try{
            $this->companyDao->Remove($id);
            $this->CompanyListViewAdmin();
        }     
        catch(\PDOException $e){
          
              $message = $e->getMessage();
              $this->homeController->CompanyListViewAdmin($message);
        }
    }


}

?>