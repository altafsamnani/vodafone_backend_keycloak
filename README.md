<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://community.vodafone.nl/legacyfs/online/4266iBA0F575FFE7B9392.png" width="400"></a></p>

## Vodafone Laravel Test

The project is created with
- Laravel
- Mariadb
- Keycloak
- Docker
- Artisan Commands
- Phpunit Testcases

## Installation

## Installation

1. Do  ```make setup``` to install the required libraries. We will be using MakeFile magic to setup.

2. Execute ```make up```, which will create the setup for the assignment and installation for you, If you are setting it up first time, please be patient and it will take some time. For Subsequent make commands it will be quicker.

 Pleae refer MakeFile for detailed commands and docker-composer.yml to understand docker setup, Once docker containers are up, it will be running at 
 http://localhost/ for Laravel Endpoints (using Starwar apis)
 http://localhost:85/auth for Keycloak server

It uses mariadb as a database, nginx as a server and keycloak image for the server. 

It will also run ```php artisan migrate ``` and ```php artisan db:seed``` for migrations and database seeding. 

3. Database will be setup for Laravel and Keycloak and will be available respectively at 3306 and 3307 port.


## Explaination

I have used Laravel which is a ModelViewController Framework and using artisan commands to demonstrate the console commands
There are app varialbes inside an .env file including db connection variables, Since it's a relatively small project and all are console commands, the processing happens inside the Console Commands Files. No services, transformers etc.

We are using keycloak server, after setting up the keycloak resource, scope, permissions and users, Laravel is having a middleware to protect the routes
  - 1 PLEASE REFER config/auth.php
  ``` "api" => [ "driver" => "keycloak", "provider" => "users",],], ```

  - 2 PLEASE REFER routes/api.php```
  ```Route::group(['middleware' => 'auth:api']```

  - 3 Set respective .env variables for following   
  ```return ['realm_public_key' => env('KEYCLOAK_REALM_PUBLIC_KEY', null), 'load_user_from_database' => env('KEYCLOAK_LOAD_USER_FROM_DATABASE', true),'user_provider_custom_retrieve_method' => null,'user_provider_credential' => env('KEYCLOAK_USER_PROVIDER_CREDENTIAL', 'username'),'token_principal_attribute' => env('KEYCLOAK_TOKEN_PRINCIPAL_ATTRIBUTE', 'preferred_username'),'append_decoded_token' => env('KEYCLOAK_APPEND_DECODED_TOKEN', false),'allowed_resources' => env('KEYCLOAK_ALLOWED_RESOURCES', null)];```

Config file vodafone.php is created and which has been used throughout the Console commands so all the constant variables stay at one place and can be used for Testcases, I have  created Model files and have followed repository pattern to introduce extra data layer separate the handling of models.

Retrieving of data happens thorugh the Controller and i have created services to load the data from SWAPI.dev, I also manage to implement offline storing of data for PEOPLE Entity and PRESERVING DATA FOR OFFLINE SERVING FOR NEXT REQUESTS.

### Protected Keycloak Api Endpoints (Also Postman Collection)
1) People
   {{hostUrl}}/api/people
   {{hostUrl}}/api/people/1

2) Planet
   {{hostUrl}}/api/planet
   {{hostUrl}}/api/people/2

3) Species
   {{hostUrl}}/api/species
   {{hostUrl}}/api/species/2


### Populate with console command
I have created command to populate the People offline, this can be also extended for Queueing and can be useful to serve the content without communicating with external service
`make people` and `make planet`


### Test the application
Test cases are written inside the tests folder. I have used repository/model objects to avoid live database modification, could not spend much time due to time constraint
You can run tests through following command
- ```make test```




