<?php
require_once 'libs/Router.php';
require_once 'api/api.product.controller.php';

//creo el router
$router = new Router();

//tabla de ruteo
$router->addRoute('products', 'GET', 'ApiProductController', 'getAll');
$router->addRoute('products/:ID', 'GET', 'ApiProductController', 'get');
$router->addRoute('products/:ID', 'DELETE', 'ApiProductController', 'remove');

//rutea
$resourse = $_GET['resourse'];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resourse, $method);