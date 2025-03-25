<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['default_controller'] = 'EmployeeController';
$route['default_controller'] = 'AuthController/login';

$route['login'] = 'AuthController/login';
$route['login/authenticate'] = 'AuthController/authenticate';
$route['logout'] = 'AuthController/logout';

$route['register'] = 'AuthController/register';
$route['register/store'] = 'AuthController/store';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// $route['about'] = 'Welcome/demo';
// $route['blog/(:any)'] = 'DemoC/blog/$1';

$route['employee'] = 'EmployeeController/index';
$route['employee/getEmployees'] = 'EmployeeController/getEmployees';
$route['employee/add'] = 'EmployeeController/create';
$route['employee/store'] = 'EmployeeController/store';
$route['employee/edit/(:num)'] = 'EmployeeController/edit/$1';
$route['employee/update/(:num)'] = 'EmployeeController/update/$1';
$route['employee/delete/(:num)'] = 'EmployeeController/delete/$1';

$route['blogs'] = 'BlogController/index';
$route['blogs/create'] = 'BlogController/create';
$route['blogs/store'] = 'BlogController/store';
$route['blogs/edit/(:num)'] = 'BlogController/edit/$1';
$route['blogs/update/(:num)'] = 'BlogController/update/$1';
$route['blogs/delete/(:num)'] = 'BlogController/delete/$1';

$route['location/getCities'] = 'LocationController/getCities';


