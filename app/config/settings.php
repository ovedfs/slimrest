<?php

session_start();

define("BASE_URL", "http://localhost/ejercicioajax/"); // Cambiar ej: http://localhost/proyecto/

define("ROOT_PATH", dirname(dirname(__DIR__)) . "/");

define("APP_PATH", ROOT_PATH . "app/");

define("VIEW_PATH", APP_PATH . "views/");

error_reporting(-1); // Development -> -1   Production -> 0
ini_set('display_errors', '1');
