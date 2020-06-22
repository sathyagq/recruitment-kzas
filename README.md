---
# Kzas | Recruitment Test

## Step 1: DevilBox
*The Devilbox is a modern and highly customisable dockerized PHP stack supporting full LAMP and MEAN and running on
 all major platforms. The main goal is to easily switch and combine any version required for local development.*
 
 **Get the DevilBox**
 
    git clone https://github.com/cytopia/devilbox
 
 **Config DevilBox .env**
 
    cd devilbox
    cp env-example .env
 
 *Edit .env file following this steps:* 
 
    line 140: set TIMEZONE=America/Sao_Paulo
    line 438: set HOST_PATH_HTTPD_DATADIR=./data/www/recruitment-kzas
    line 548: set HTTPD_DOCROOT_DIR=public

 **Start containers**
  
    docker-compose up -d
  
  **Register local DNS**
  
  *Open another terminal and run:*
  
    cd /etc
    sudo vim hosts
  
    ## add this lines:
        127.0.0.1 recruitme.loc
        127.0.0.1 api-php.loc
        
**Try it!**
  
    http://localhost
      
  
## Step 2: Get Projects
*API PHP to store images & Laravel Project to manage companies and their employees.*
     
 **Go to DevilBox directory**
     
    cd devilbox/data/www
     
 **Clone repo**
     
     git clone https://github.com/sathyagq/recruitment-kzas.git

## Step 3: API PHP
*API PHP to store images*
 
 **Get inside php container**
      
      docker exec -it devilbox_php_1 /bin/bash
      
 **API PHP**
 
      cd api-php
      composer install
      exit


## Step 3: RecruitMe
*Laravel Project to manage companies and their employees.*
    
   **Prepare database**
   
    docker exec -it devilbox_mysql_1 /bin/bash
    
    mysql
    
    create database management;
    
    exit
    
  **Get inside php container**
    
    docker exec -it devilbox_php_1 /bin/bash
    
  **Run this...**
    
    cd recruitme 
    
    cp .env.example .env
    
    composer install
    
    php artisan key:generate
       
    php artisan migrate --seed
   
   **Try it!**
    
    http://recruitme.loc  
  
            login: admin@recruitme.com
            senha: recruit123
  *Laravel API routes*
    
    http://recruitme.loc/companies
    
    http://recruitme.loc/companies/{$COMPANY_ID}/employees
    
  
 
 
 

