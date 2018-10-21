<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "home_controller";
$route['scaffolding_trigger'] = "";
$route['home'] = 'home_controller/home';
$route['categories/(:any)'] = 'home_controller/categories/$1';
$route['categories/(:any)/(:num)'] = 'home_controller/categories/$1/$2';
$route['about/(:any)'] = 'home_controller/about/$1';
$route['types/(:any)'] = 'home_controller/types/$1';
$route['types/(:any)/(:num)'] = 'home_controller/types/$1/$2';
$route['sort/(:any)'] = 'home_controller/sort/$1/$2';
$route['(:num)'] = "novus_controller/view_novus/$1";
$route['signout'] = "auth/logout";
$route['auth/(:any)'] = "auth/$1";
$route['signup'] = "home_controller/signup";
$route['new'] = "novus_controller/start_new_novus";
$route['new/(:any)'] = "novus_controller/start_new_novus/$1";
$route['page/(:num)'] = "home_controller/home/$1";


$route['(my|account|password|profile|settings)'] = 'author_controller/my/$1';
//exclude these controllers when building URIs

$route['(home_controller|view|novus_controller|redux_controller|author_controller|bit_controller|login|feedback_controller|friendinvites|about|auth|showlogin)(.*)'] = '$1$2';
 
//Anything that isnt accounted for pushes to the alias check

$route['[a-zA-Z0-9-]|[a-zA-Z0-9-]/(:num)'] = 'author_controller/view_author';


$route['invite_friends'] = 'author_controller/invite_friends';



//$route['[a-zA-Z0-9]+/(add|edit)'] = 'author_controller/view_author/$1';
//$route['[a-zA-Z0-9]+'] = 'users/profile';






/* End of file routes.php */
/* Location: ./system/application/config/routes.php */