Custom weather-api project

Installation:

* Download dependencies: composer install
* Entry point: /public/index.php - Web root
* File saved in: /storage/app/ folder

Routes:

* '/' - For check installation, you just see message: Laravel start page
* '/weather' - Save file method, need use get request:

* example response string: "File will be create, check storage folder"

* file format can be changed in env, search FILE_FORMAT key.
* Can use sync, redis or rabbitmq driver for queue