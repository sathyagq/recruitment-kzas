---
#Kzas | Recruitment Test

##Step 1: DevilBox
*The Devilbox is a modern and highly customisable dockerized PHP stack supporting full LAMP and MEAN and running on
 all major platforms. The main goal is to easily switch and combine any version required for local development.*
 
 **Get the DevilBox**
 
    git clone https://github.com/cytopia/devilbox
 
 **Config DevilBox .env**
 
    cd devilbox
    cp env-example .env
    
    line 140: set TIMEZONE=America/Sao_Paulo
    line 548: set HTTPD_DOCROOT_DIR=public

 **Start containers**
  
    docker-compose up -d
  
  **Register local DNS**
  
    cd /etc
    sudo vim hosts
  
    ## add this lines:
        127.0.0.1 recruitme.loc
        127.0.0.1 api-php.loc
        
**Try it!**
  
    http://localhost
  
  
##Step 2: API PHP
*API PHP to store images.*
     
 **Go to DevilBox directory**
     
    cd devilbox/data/www
     
 **Clone project**
     
     git clone COLOCA A URL DO GIT AQUI
     
     composer install
     
 **Ready!**
      
      http://api-php.loc


##Step 3: RecruitMe
*Laravel Project to manage companies and their employees.*
   
   **Go to DevilBox directory**
   
    cd devilbox/data/www
   
   **Clone recruitme project**
   
    git clone COLOCA A URL DO GIT AQUI
    
   **Prepare database**
   
    docker exec -it devilbox_mysql_1 /bin/bash
    
    mysql
    
    create database management;
    
   **Run this...**
    
    cp env-example .env
    
    php artisan key:generate
    
    composer install
   
    php artisan migrate --seed
   
   **Try it!**
    
    http://recruitme.loc  
  
            login: admin@recruitme.com
            senha: recruit123
    
  
 
 
 

