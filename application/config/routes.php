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
$route['default_controller'] = 'home';

$req_uri = $_SERVER['REQUEST_URI'];     // $req_uri = /myproject/backend
$req_uri = explode('/', $req_uri);
if(isset($req_uri[2])){
    $req_uri = $req_uri[2];
}

if($req_uri == 'admin'){
    $route['404_override'] = 'admin404';
}else{
    $route['404_override'] = 'admin404';
}

$route['translate_uri_dashes'] = FALSE;

$route['service-provider']='service_provider';
$route['reviews-single']='reviews_single';
$route['become-contractor']='become_contractor';
$route['buy-seller']='buy_seller';
$route['about-us']='about_us';
$route['privacy-policy']='privacy_policy';
$route['getCallSetting']='admin/api/getCallSetting';
$route['getSource']='admin/api/getSource';
$route['addARBProfile/(:any)/(:any)/(:any)']='admin/api/addARBProfile/$1/$2/$3';
$route['savelead']='admin/api/savelead';
$route['getBatch/(:any)/(:any)/(:any)']='admin/api/getBatch/$1/$2/$3';
$route['updatepolicystatus']='admin/api/updatepolicystatus';