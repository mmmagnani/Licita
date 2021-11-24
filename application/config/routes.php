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

$route['default_controller'] = "login";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['verAtas/(:num)'] = "login/verAtas/$1";
$route['verItens/(:num)'] = "login/verItens/$1";
$route['verAtas2/(:num)'] = "user/verAtas2/$1";
$route['verItens2/(:num)'] = "user/verItens2/$1";
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['biddingListing'] = 'biddings/biddingListing';
$route['ArquivosB'] = 'biddings/ArquivosB';
$route['arquivosB/(:num)'] = "biddings/arquivosB/$1";
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['addNewB'] = "biddings/addNewB";
$route['addNewA/(:num)'] = "biddings/addNewA/$1";
$route['addNewI/(:num)'] = "biddings/addNewI/$1";
$route['addNewArq/(:num)'] = "biddings/addNewArq/$1";
$route['addNewUser'] = "user/addNewUser";
$route['addNewBidding'] = "biddings/addNewBidding";
$route['addNewAta'] = "biddings/addNewAta";
$route['addNewArquivo'] = "biddings/addNewArquivo";
$route['addNewItem'] = "biddings/addNewItem";
$route['uploadResults'] = "biddings/uploadResults";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editOldB'] = "biddings/editOldB";
$route['editOldB/(:num)'] = "biddings/editOldB/$1";
$route['editOldA'] = "biddings/editOldA";
$route['editOldA/(:num)'] = "biddings/editOldA/$1";
$route['editOldI'] = "biddings/editOldI";
$route['editOldI/(:num)'] = "biddings/editOldI/$1";
$route['editOldArq'] = "biddings/editOldArq";
$route['editOldArq/(:num)'] = "biddings/editOldArq/$1";
$route['editUser'] = "user/editUser";
$route['editBidding'] = "biddings/editBidding";
$route['editAta'] = "biddings/editAta";
$route['editItem'] = "biddings/editItem";
$route['editArquivo'] = "biddings/editArquivo";
$route['deleteBidding'] = "biddings/deleteBidding";
$route['deleteUser'] = "user/deleteUser";
$route['activeUser'] = "user/activeUser";
$route['deleteAta'] = "biddings/deleteAta";
$route['deleteItem'] = "biddings/deleteItem";
$route['deleteArquivo'] = "biddings/deleteArquivo";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['biddingsSrp'] = "biddings/biddingsSrp";
$route['atasB'] = "biddings/atasB";
$route['atasB/(:num)'] = "biddings/atasB/$1";
$route['viewB'] = "biddings/viewB";
$route['viewB/(:num)'] = "biddings/viewB/$1";
$route['viewI'] = "biddings/viewI";
$route['viewI/(:num)'] = "biddings/viewI/$1";

$route['loadChangePhoto'] = "user/loadChangePhoto";
$route['changePhoto'] = "user/changePhoto";

$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */
/* Location: ./application/config/routes.php */