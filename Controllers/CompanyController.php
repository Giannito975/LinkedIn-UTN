<?php


namespace Controllers;

use Models\Company;
use DAO\CompanyDao;
use DAO\JobOfferDao;

class CompanyController{

    private $companyDao;
    private $jobOfferDao;

    public function __construct()
    {
        $this->companyDao = new CompanyDao();
        $this->jobOfferDao = new JobOfferDao();
    }

    public function ShowCompanyList(){
        require_once(VIEWS_PATH."company-list.php");
    }

    public function ShowModifyCompanyView($id){
        $company = $this->companyDao->GetById($id);
        require_once(VIEWS_PATH."company-modify.php");
    }

     //Vista para user ADMIN
    public function CompanyListViewAdmin($message = ""){

        $companyController = new CompanyController();

        $companyList = $companyController->GetAll();

        require_once(VIEWS_PATH."company-list-admin.php");
    }

    public function ModifyCompany($id, $name, $aboutUs, $companyLink, $email, $industry, $city, $country){
        $company = $this->GetById($id);
        if(!$this->verifyName($name) || (strcasecmp($company->getName(), $name) == 0)){
            
            $company = new Company($id, $name, $aboutUs, $companyLink, $email, $industry, $city, $country);
            $this->companyDao->UpdateCompany($company);
            
            $message = "It was modify successfully ";
            $this->CompanyListViewAdmin($message);
        }else{
            $message = "It cannot be modified because that name is already owned by another company";
            $this->CompanyListViewAdmin($message);
        } 
        $this->CompanyListViewAdmin();
        echo'<script type="text/javascript">
        alert("Successful company modification");
        </script>';
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

            $message = "It was creted successfully ";
            $this->CompanyListViewAdmin($message);
        }else{
            $message = "It cannot be created because that name is already owned by another company";
            $this->CompanyListViewAdmin($message);
        }
        $this->CompanyListViewAdmin();
    }

    // Verifica si una company tiene job offers
    public function verifyJobOfferCompany($id){
        $jobOfferList = $this->jobOfferDao->getAll();
        foreach($jobOfferList as $jobOffer){
            if($jobOffer->getId_company() == $id){
                return true;
            }
        }
        return false;
    }


    public function RemoveCompany($id){
        if(!$this->verifyJobOfferCompany($id)){
            $this->companyDao->Remove($id);
            $message = "It was successfully eliminated";
            $this->CompanyListViewAdmin($message);
        }else{
            $message = "Cannot be removed because you have job offers";
            $this->CompanyListViewAdmin($message);
        }
        
    }


}

?>