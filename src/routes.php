<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signin');

$router->get('/cursos/aula/{id}', 'CursosController@aula');
$router->get('/cursos/{id}', 'CursosController@index');
$router->get('/cursos', 'CursosController@index');

$router->get('/logout', 'LoginController@logout');