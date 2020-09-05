# Closed on Sundays Game Front End Site
## Requirements
In order to build and test this framework you will need Docker Engine 18 or higher and Docker Compose 1.25 or higher. It may work on older versions but is untested. 

## Usage
1. Clone the repo.
1. Navigate to the cloned repo copy .env.example to create a .env file.
1. Open a terminal and navigate to the cloned Repo. Run `docker-compose up -d`. This will start the required container and detach from it. 
1. Run the command `docker-compose exec laravel_frontend php artisan key:generate` to create an application key. This will only need to be done the first time you run the application.
1. Open up a browser and go to localhost:8080, the site should then display.
