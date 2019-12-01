<?php



defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['promotion/request'] = 'promotion'; // sama aja ke func index
$route['promotion/report'] = 'promotion';
$route['promotion/(:any)/form'] = 'promotion/form'; // controller promotion, func form, ada 2 mode (request, report)
$route['promotion/(:any)/form/(:any)'] = 'promotion/form/(:any)'; // promotion/any/form/2

$route['retirement/request'] = 'retirement';
$route['retirement/report'] = 'retirement';
$route['retirement/(:any)/form'] = 'retirement/form';
$route['retirement/(:any)/form/(:any)'] = 'retirement/form/(:any)';