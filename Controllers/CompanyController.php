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

    public function ModifyCompany($name, $aboutUs, $companyLink, $email, $industry, $city, $country){
        try{
            if(!$this->VerifyName($name)){
                $company = new Company($name, $aboutUs, $companyLink, $email, $industry, $city, $country);
                $this->CineDAO->ModifyCine($Cine);
             }else{
                throw new Exception("Error, Ya se encuentra un cine con ese nombre");
            }
        }catch(Exception $ex){
            $message=$ex->getMessage();
            $_SESSION['errorMessage']=$message;
            header("location: ".FRONT_ROOT."Home/indexAdmin");
        }
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

    //agregar los atributos de la company aca
    public function Middleware($name, $adress, $id){
            if(empty($id)){
                $this->Add($name, $adress);
            } else {
                $this->Update($id, $name, $adress);
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

    public function Remove($id) //revisar esto con dante san
        {
            try{

                //$this->validateRoomShow($id); ver de validar que exista antes la company, x ahi ni lo hacemos XD
                $this->companyDAO->Remove($id);
                $this->homeController->CompanyListViewAdmin();
            }     
            catch(\PDOException $e){
          
                $message = $e->getMessage();
                $this->homeController->CompanyListViewAdmin($message);
            }
        }


}


?>