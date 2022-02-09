## PHP 7.4 with Apache
This docker runs Symfony applications through apache and php-7.4

## Docker and docker-compose install
First, you'll need docker and docker-compose:
- [Install Docker](https://docs.docker.com/install/)
- [Install docker compose](https://docs.docker.com/compose/install/)

## How to install a new Symfony web application

1. Clone this repo: ```git clone git@github.com:paulopmt1/docker-symfony-environment.git```
2. Enter on the folder: ```cd docker-symfony-environment```
3. Start the environment: ```sudo docker-compose up -d```
4. Login on the container with ```sudo docker exec -it dev_apache_php74 /bin/bash```
5. Run: ```composer create-project symfony/website-skeleton:"^4.4" /var/www/html/``` (4.4 is the latest LTS symfony version)
