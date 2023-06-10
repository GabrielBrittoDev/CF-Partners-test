# Test CF Partners Gabriel Leal

## Setup
Execute the following commands in the project folder:
* ``mkdir docker/volumes/mysql`` Creating this folder allows the project to run without the need of a sudo command.
* ``docker-compose up -d`` This command will build, create the containers and run all things necessary for the project.

After these commands, the project will run at this link:
[localhost](http://localhost:3000) 

In case of port conflicts, just need to change the ports inside the docker-compose.yml file.

___

## Technologies used

- Codeigniter 4.3.5
- SmartAdmin 4.5.1
- MySQL 8.0.32
- PHP 8.1
- Nginx 1.19

## Containers

- cfpartners-mysql
    - Port: 30001
- cfpartners-web
    - Port: 30000
- cfpartners-app

