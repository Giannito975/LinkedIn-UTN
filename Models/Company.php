<?php

namespace Models;

    // ver que onda el tema de la herencia
    class Company{
        
        private $id_company;
        private $name;
        private $about_us;
        private $company_link; //string, descripción al area que pertenece
        private $email;
        private $industry;
        private $city;
        private $country;

        public function __construct($id_company, $name, $about_us, $company_link, $email, $industry, $city, $country)
        {
                $this->id_company = $id_company;
                $this->name = $name;
                $this->about_us = $about_us;
                $this->company_link = $company_link;
                $this->email = $email;
                $this->industry = $industry;
                $this->city = $city;
                $this->country = $country;
        }

      
        public function getName() {
                return $this->name;
        }

        public function setName($name) {
                $this->name = $name;
        }
        
        public function getId_company() {
                return $this->id_company;
        }
    
        public function setId_company($id_company) {
                $this->id_company = $id_company;
        }

        public function getAbout_us(){
                return $this->about_us;
        }
     
        public function setAbout_us($about_us) {
                $this->about_us = $about_us;
        }

        public function getCompany_link(){
                return $this->company_link;
        }
     
        public function setCompany_link($company_link) {
                $this->company_link = $company_link;
        }

        public function getEmail(){
                return $this->email;
        }
     
        public function setEmail($email) {
                $this->email = $email;
        }

        public function getIndustry(){
                return $this->industry;
        }
     
        public function setIndustry($industry) {
                $this->industry = $industry;
        }

        public function getCity(){
                return $this->city;
        }
     
        public function setCity($city) {
                $this->city = $city;
        }

        public function getCountry(){
                return $this->country;
        }
     
        public function setCountry($country) {
                $this->country = $country;
        }
    }

?>