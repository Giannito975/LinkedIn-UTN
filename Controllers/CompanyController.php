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
        if(!$this->verifyName($name)){
            $company = new Company($id, $name, $aboutUs, $companyLink, $email, $industry, $city, $country);
            $this->companyDao->UpdateCompany($company);
        } 
        $this->CompanyListViewAdmin();
        echo'<script type="text/javascript">
        alert("Successful company modification");
        </script>';
    }

    public function Add(Company $company){
        $companyList = $this->GetAll();
        if(!$this->verifyName($company->getName())){
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

    /*
    //agregar los atributos de la company aca
    public function Middleware($name, $adress, $id){
            if(empty($id)){
                $this->Add($name, $adress);
            } else {
                $this->Update($id, $name, $adress);
            }

    }*/

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
            $num = strcmp($company->getName(), $name);
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
       //try{
           if(!$this->verifyName($name)){
                $company = new Company(null, $name, $aboutUs, $companyLink, $email, $industry, $city, $country);
                $this->companyDao->Add($company);
           }
           require_once(VIEWS_PATH."Company/CompanyListViewAdmin");
       //}
       /*catch(Exception $ex){
            echo"estas rompiendo todo bro";
            //$message=$ex->getMessage();
            //$_SESSION['errorMessage']=$message;
            require_once(VIEWS_PATH."/CompanyListViewAdmin");
       }*/
    }


    public function RemoveCompany($id = 0){
        try{
            if($id != 0){
                $this->companyDao->Remove($id);
                $this->CompanyListViewAdmin();
                echo'<script type="text/javascript">
        alert("Success: company has been removed");
        </script>';
            }
        }     
        catch(\PDOException $e){
          
              $message = $e->getMessage();
              $this->homeController->CompanyListViewAdmin($message);
        }
    }


}

?>