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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'IndexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//home
$route['danh-muc/(:any)']['GET']='IndexController/category/$1';
$route['thuong-hieu/(:any)']['GET']='IndexController/brand/$1';
$route['san-pham/(:any)']['GET']='IndexController/product/$1';
$route['gio-hang']['GET']='IndexController/cart';
$route['add-to-cart']['POST']='IndexController/add_to_cart';
$route['delete-item/(:any)']['GET']='IndexController/delete_item/$1';
$route['dang-nhap']['GET']='IndexController/login';
$route['delete-all-cart']['GET']='IndexController/delete_all_cart';
$route['update-cart-item']['POST']='IndexController/update_cart_item';
$route['checkout']['GET']='IndexController/checkout';
$route['confirm-checkout']['POST']='IndexController/confirm_checkout';
$route['dang-xuat']['GET']='IndexController/dang_xuat';
$route['tim-kiem']['GET']='IndexController/tim_kiem';
$route['thanks']['GET']='IndexController/thanks';



//login
$route['login']['GET']='LoginController/index';
$route['login-user']['POST']='LoginController/login';
$route['login-customer']['POST']='IndexController/login_customer';
$route['dang-ky']['POST']='IndexController/dang_ky';


//dashboard
$route['dashboard']['GET']='DashboardController/index';
$route['logout']['GET']='DashboardController/logout';

//Brand
$route['brand/create']['GET']='BrandController/create';
$route['brand/list']['GET']='BrandController/index';
$route['brand/delete/(:any)']['GET']='BrandController/delete/$1';
$route['brand/edit/(:any)']['GET']='BrandController/edit/$1';
$route['brand/update/(:any)']['POST']='BrandController/update/$1';
$route['brand/store']['POST']='BrandController/store';

//Category
$route['category/create']['GET']='CategoryController/create';
$route['category/list']['GET']='CategoryController/index';
$route['category/delete/(:any)']['GET']='CategoryController/delete/$1';
$route['category/edit/(:any)']['GET']='CategoryController/edit/$1';
$route['category/update/(:any)']['POST']='CategoryController/update/$1';
$route['category/store']['POST']='CategoryController/store';

//Product
$route['product/create']['GET']='ProductController/create';
$route['product/list']['GET']='ProductController/index';
$route['product/delete/(:any)']['GET']='ProductController/delete/$1';
$route['product/edit/(:any)']['GET']='ProductController/edit/$1';
$route['product/update/(:any)']['POST']='ProductController/update/$1';
$route['product/store']['POST']='ProductController/store';

//order
$route['order/list']['GET']='OrderController/index';
$route['order/process']['POST']='OrderController/process';
$route['order/view/(:any)']['GET']='OrderController/view/$1';
$route['order/delete/(:any)']['GET']='OrderController/delete_order/$1';

