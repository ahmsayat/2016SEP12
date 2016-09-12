<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'first';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;


//$route['get'] = 'first/get';
$route['login'] = 'first/login';
$route['logout'] = 'first/logout';
//$route['signup'] = 'first/signup';
//$route['article(/)?(.*)'] = 'first/article/$1';
//$route['newsstand'] = 'first/newsstand';
//$route['send'] = 'first/send_mail';
//$route['change_password'] = 'first/change_password'; 
//$route['retrieve_password'] = 'first/retrieve_password'; 
$route['get_started'] = 'first/get_started';
$route['publish'] = 'first/publish';
$route['reset'] = 'first/reset';
$route['pdf/(.*)'] = 'first/pdf/$1';
$route['report_news'] = 'first/report_news';
$route['read'] = 'first/read_news';
$route['rss'] = 'first/rss';
$route['test'] = 'first/run_unit_testing';
$route['feed'] = 'first/feed';
$route['get_news'] = 'first/get_news';
$route['latest'] = 'first/get_latest_articles';
$route['get_articles'] = 'first/get_articles';
$route['check_logins'] = 'first/check_logins';
$route['unpublish/(.*)'] = 'first/unpublish/$1';
$route['article/(.*)'] = 'first/article/$1';
$route['download_as_pdf/(.*)'] = 'first/download_as_pdf/$1';
$route['verify/(.*)/(.*)'] = 'first/verify/$1/$2';
$route['complete_registration'] = 'first/complete_registration';
//$route['(.*)'] = 'first/index';
//$route['(.*)'] = 'first/$1';
//$route['(.*)'] = 'first/more/$1';
