<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'guest';
$route['join']                  = 'guest/join';
$route['about']                 = 'guest/about';
$route['contact']               = 'guest/contact';
$route['join_us']               = 'guest/join_us';

$route['lp/(:any)/(:any)']      = 'guest/lp/$1/$2';

$route['login']                 = 'auth/log/in';
$route['do_login']              = 'auth/log/do_login';
$route['logout']                = 'auth/log/out';
$route['register']              = 'auth/register';
$route['reg/(:num)']            = 'auth/reg/$1';

$route['api/get/(:any)/(:any)'] = 'api/get/index/$1/$2';

$route['admin']                 = 'admin/dashboard';
$route['admin/stock/(:any)']    = 'admin/transaction/product_stock/$1';

$route['member']                = 'member/dashboard';

$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;
