<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::signin');
$routes->post('/login', 'Home::signin');
$routes->get('/signout', 'Home::signout');

$routes->get('/logs', 'Home::logs');
$routes->post('/logs', 'Home::logs');

$routes->get('/profile', 'Home::profile');

$routes->get('/get_attendance', 'Attendance::getAttendanceData');
$routes->get('/attendance', 'Attendance::attendance');
$routes->post('/attendance', 'Attendance::attendance');

$routes->get('/attendancee', 'Attendance::attendancee');
$routes->post('/attendancee', 'Attendance::attendancee');

$routes->get('/myattendance', 'Attendance::my_attendance');
$routes->post('/myattendance', 'Attendance::my_attendance');

$routes->get('/meetings', 'Attendance::meetings');
$routes->post('/meetings', 'Attendance::meetings');

$routes->get('/report', 'Attendance::personalReport');
$routes->get('/reports', 'Attendance::reports');
$routes->post('/reports', 'Attendance::reports');

$routes->get('/users', 'Users::users');
$routes->get('/add_user', 'Users::add_user');
$routes->post('/add_user', 'Users::add_user');

$routes->get('edit_user/(:num)', 'Users::edit_user/$1');
$routes->post('/edit_user/(:num)', 'Users::edit_user/$1');
$routes->post('/disable_user/(:num)', 'Users::disable_user/$1');
$routes->post('/enable_user/(:num)', 'Users::enable_user/$1');

$routes->get('/reset_password', 'Users::reset_password');
$routes->post('/reset_password', 'Users::reset_password');

$routes->get('/forgot_password', 'Users::forgot_password');
$routes->post('/forgot_password', 'Users::forgot_password');

$routes->post('/search_staff', 'Attendance::search_staff');

