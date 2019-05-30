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

|	example.com/class/method/id/

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

| There area two reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router what URI segments to use if those provided

| in the URL cannot be matched to a valid route.

|

*/



$route['default_controller'] = "home";

$route['404_override'] = 'home';





$route['sign_up']='home/sign_up';

$route['login']='home/login';

$route['contact_us']='home/contact_us';

$route['verify/(.*)/(.*)']='home/verify/$1/$2';

$route['reset_password/(.*)/(.*)']='home/reset_password/$1/$2';

$route['business']='home/business';




$route['search/newest/(.*)/(.*)/(.*)']='search/newest/$1/$2/$3';

$route['search/newest/(.*)/(.*)']='search/newest/$1/$2';

$route['search/newest/(.*)']='search/newest/$1';

$route['search/newest']='search/newest';



$route['search/top/(.*)/(.*)/(.*)']='search/top/$1/$2/$3';

$route['search/top/(.*)/(.*)']='search/top/$1/$2';

$route['search/top/(.*)']='search/top/$1';

$route['search/top']='search/top';



$route['search/in/(.*)/(.*)/(.*)']='search/in/$1/$2/$3';

$route['search/in/(.*)/(.*)']='search/in/$1/$2';

$route['search/in/(.*)']='search/in/$1';





$route['search/(.*)/(.*)']='search/index/$1/$2';

$route['search/(.*)']='search/index/$1';

$route['search']='search/index';



$route['tasks/(.*)/comments']='task/task_detail_comment/$1';



$route['tasks/(.*)/(.*)/(.*)']='task/task_detail/$1/$2/$3';

$route['tasks/(.*)/(.*)']='task/task_detail/$1/$2';

$route['tasks/(.*)']='task/task_detail/$1';

$route['tasks']='map';





$route['tags/(.*)/in/(.*)/(.*)']='category/category_task_in/$1/$2/$3';

$route['tags/(.*)/in/(.*)']='category/category_task_in/$1/$2';





$route['tags/(.*)/(.*)']='category/category_task/$1/$2';

$route['tags/(.*)']='category/category_task/$1';

$route['tags']='category/category_list';



$route['taskers/category/(.*)/(.*)']='worker/category/$1/$2';

$route['taskers/category/(.*)']='worker/category/$1';

$route['taskers/category']='worker/taskers';



$route['how_it_works']='worker/how_it_works';

$route['taskers/(.*)']='worker/taskers/$1';

$route['who-are-the-taskers']='worker';



$route['taskers']='worker/taskers';



$route['new_task']='task/new_task';



$route['user/complete_profile']='user/complete_profile';



$route['user/delete_video/(.*)']='user/delete_video/$1';

$route['customize_profile/(.*)']='user/customize_profile/$1';



$route['user/portfolio_view/(.*)']='user/portfolio_view/$1';

$route['user/upload_portfolio']='user/upload_portfolio';

$route['user/user_video']='user/user_video';



$route['user/upload_photo/(.*)']='user/upload_photo/$1';

$route['user/upload_photo']='user/upload_photo';

$route['user/update_city/(.*)']='user/update_city/$1';

$route['pick_city']='user/pick_city';

$route['customize_profile']='user/customize_profile';

$route['user/un_favorite/(.*)']='user/un_favorite/$1';

$route['user/make_favorite/(.*)']='user/make_favorite/$1';

$route['user/edit']='user/edit';

$route['account/(.*)']='user/my_account/$1';

$route['account']='user/my_account';

$route['dashboard']='user/dashboard';

$route['change_password']='user/change_password';

$route['notifications']='user/notifications';



$route['user/(.*)/reviews/(.*)']='user/reviews/$1/$2';

$route['user/(.*)/reviews']='user/reviews/$1';





$route['user/(.*)/activities/(.*)']='user/activities/$1/$2';

$route['user/(.*)/activities']='user/activities/$1';



$route['user/(.*)/(.*)']='user/profile/$1/$2';

$route['user/(.*)']='user/profile/$1';

/* End of file routes.php */

/* Location: ./application/config/routes.php */