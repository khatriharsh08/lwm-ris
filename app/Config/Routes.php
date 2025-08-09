<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Front routes
$routes->get('/', 'Front\Home::index');
$routes->get('/front/home', 'Front\Home::index');
$routes->post('get-category-wise-product', 'Front\Home::get_category_wise_product');
$routes->post('sendMessage', 'Front\Home::sendMessage');
$routes->post('/home/getStates', 'Front\Home::getStates');


// Admin login
$routes->get('/login', 'Admin\Login::index');
$routes->post('/login', 'Admin\Login::auth');



// Dashboard
$routes->get('/dashboard', 'Admin\Dashboard::index', ['filter' => 'auth']);

// Logout
$routes->get('/logout', 'Admin\Login::logout', ['filter' => 'auth']);

// Profile
$routes->get('/user/profile', 'Admin\User::index', ['filter' => 'auth']);
$routes->post('/user/update/(:num)', 'Admin\User::update/$1', ['filter' => 'auth']);

// Waste Categories
$routes->match(['get', 'post'],'/wastecategory', 'Admin\Wastecategory::index', ['filter' => 'auth']);
// $routes->get('/wastecategory', 'Admin\Wastecategory::index',['filter' => 'auth']);
$routes->get('/wastecategory/add', 'Admin\Wastecategory::add',['filter' => 'auth']);
$routes->post('/wastecategory/store', 'Admin\Wastecategory::store',['filter' => 'auth']);
$routes->get('/wastecategory/edit/(:num)', 'Admin\Wastecategory::edit/$1',['filter' => 'auth']);
$routes->post('/wastecategory/update/(:num)', 'Admin\Wastecategory::update/$1',['filter' => 'auth']);
$routes->get('/wastecategory/delete/(:num)', 'Admin\Wastecategory::delete/$1',['filter' => 'auth']);
$routes->get('/waste-categories/reset','Admin\Waste_categories::reset',['filter' => 'auth']);   

// Recycling Centers
$routes->match(['get', 'post'],'/recyclingcenter', 'Admin\Recyclingcenter::index', ['filter' => 'auth']);
$routes->get('/recyclingcenter/create', 'Admin\Recyclingcenter::create', ['filter' => 'auth']);
$routes->post('/recyclingcenter/store', 'Admin\Recyclingcenter::store', ['filter' => 'auth']);
$routes->get('/recyclingcenter/edit/(:num)', 'Admin\Recyclingcenter::edit/$1', ['filter' => 'auth']);
$routes->post('/recyclingcenter/update/(:num)', 'Admin\Recyclingcenter::update/$1', ['filter' => 'auth']);
$routes->get('/recyclingcenter/delete/(:num)', 'Admin\Recyclingcenter::delete/$1', ['filter' => 'auth']);



// Events & Seminars
$routes->match(['get', 'post'],'/eventsseminar', 'Admin\Eventsseminar::index', ['filter' => 'auth']);
$routes->get('/eventsseminar/create', 'Admin\Eventsseminar::create', ['filter' => 'auth']);
$routes->post('/eventsseminar/store', 'Admin\Eventsseminar::store', ['filter' => 'auth']);
$routes->get('/eventsseminar/edit/(:num)', 'Admin\Eventsseminar::edit/$1', ['filter' => 'auth']);
$routes->post('/eventsseminar/update/(:num)', 'Admin\Eventsseminar::update/$1', ['filter' => 'auth']);
$routes->get('/eventsseminar/delete/(:num)', 'Admin\Eventsseminar::delete/$1', ['filter' => 'auth']);

// Contact Message
$routes->match(['get', 'post'],'/contactmessage', 'Admin\Contactmessage::index', ['filter' => 'auth']);
$routes->get('/contactmessage/setStatus/(:num)/(:alpha)', 'Admin\Contactmessage::setStatus/$1/$2');