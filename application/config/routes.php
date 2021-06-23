<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
// $route['default_controller'] = 'welcome';
$route['default_controller'] = 'Login/showLogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
// Authentication routes

$route['admin/login'] = 'Login/showLogin';
$route['admin/login.submit'] = 'Login/dologin';
$route['admin/logout'] = 'Login/logout';

$route['admin/login/updateadminprofile'] = 'Login/updateadminprofile';
$route['admin/admin_profile'] = 'Login/admin_profile';

$route['admin/dashboard'] = 'Dashboard';
$route['admin/dashboard/DeleteData'] = 'Dashboard/DeleteData';
$route['admin/user'] = 'User';
$route['admin/user/insert'] = 'User/InsertUpdateUser';
$route['admin/user/edit/(:any)'] = 'User/InsertUpdateUser/$1';

$route['admin/users/list'] = 'User';
$route['admin/view/user/(:any)'] = 'User/view_user';
$route['admin/user/showUserList'] = 'User/showUserList';

$route['admin/country/list'] = 'Country';
$route['admin/country/showCountryList'] = 'Country/showCountryList';
$route['admin/country/CheckExistCountry'] = 'Country/CheckExistCountry';
$route['admin/country/addUpdateCountry'] = 'Country/addUpdateCountry';

$route['admin/media/list'] = 'Media';
$route['admin/media/ViewAddMedia'] = 'Media/ViewAddEditMedia';
$route['admin/media/ViewEditMedia/(:any)'] = 'Media/ViewAddEditMedia/$1';
$route['admin/media/addUpdateMedia'] = 'Media/addUpdateMedia';
$route['admin/media/changeMediaStatus'] = 'Media/changeMediaStatus';
$route['admin/media/insert'] = 'Media/InsertUpdateMedia';
$route['admin/media/edit/(:any)'] = 'Media/InsertUpdateMedia/$1';
$route['admin/media/showMediaList'] = 'Media/showMediaList';
$route['admin/media/ViewMedia/(:any)'] = 'Media/ViewMedia/$1';

$route['admin/media/comment/list'] = 'Media/viewListComment';
$route['admin/media/comment/showMediaCommentList'] = 'Media/showMediaCommentList';
$route['admin/media/comment/addUpdateMediaComment'] = 'Media/addUpdateMediaComment';

$route['admin/gift/list'] = 'Gift';
$route['admin/gift/showGiftList'] = 'Gift/showGiftList';
$route['admin/gift/addUpdateGift'] = 'Gift/addUpdateGift';
$route['admin/gift/category/list'] = 'Gift/viewListGiftCategory';
$route['admin/gift/category/showGiftCategoryList'] = 'Gift/showGiftCategoryList';
$route['admin/gift/category/CheckExistGiftCategory'] = 'Gift/CheckExistGiftCategory';
$route['admin/gift/category/addUpdateGiftCategory'] = 'Gift/addUpdateGiftCategory';

$route['admin/coin_package/list'] = 'CoinPackage';
$route['admin/coin_package/showCoinPackageList'] = 'CoinPackage/showCoinPackageList';
$route['admin/coin_package/addUpdateCoinPackage'] = 'CoinPackage/addUpdateCoinPackage';
$route['admin/coin_package/branding_image/list'] = 'CoinPackage/viewListBrandingImage';
$route['admin/coin_package/branding_image/showBrandingImageList'] = 'CoinPackage/showBrandingImageList';
$route['admin/coin_package/branding_image/addUpdateBrandingImage'] = 'CoinPackage/addUpdateBrandingImage';
$route['admin/coin_package/offer/list'] = 'CoinPackage/viewListCoinOffer';
$route['admin/coin_package/offer/showCoinOfferList'] = 'CoinPackage/showCoinOfferList';
$route['admin/coin_package/offer/addUpdateCoinOffer'] = 'CoinPackage/addUpdateCoinOffer';

$route['admin/settings'] = 'Settings';
$route['admin/settings/addUpdateAdmob'] = 'Settings/addUpdateAdmob';
$route['admin/settings/addUpdateFacebook'] = 'Settings/addUpdateFacebook';
$route['admin/settings/addUpdateOther'] = 'Settings/addUpdateOther';

$route['admin/notification'] = 'Notification/viewSendNotification';
$route['admin/notification/sendNotification'] = 'Notification/sendNotification';

$route['admin/campaign/list'] = 'Campaign';
$route['admin/campaign/ViewAddCampaign'] = 'Campaign/ViewAddEditCampaign';
$route['admin/campaign/ViewEditCampaign/(:any)'] = 'Campaign/ViewAddEditCampaign/$1';
$route['admin/campaign/addUpdateCampaign'] = 'Campaign/addUpdateCampaign';
$route['admin/campaign/changeCampaignStatus'] = 'Campaign/changeCampaignStatus';
$route['admin/campaign/insert'] = 'Campaign/InsertUpdateCampaign';
$route['admin/campaign/edit/(:any)'] = 'Campaign/InsertUpdateCampaign/$1';
$route['admin/campaign/showCampaignList'] = 'Campaign/showCampaignList';
$route['admin/campaign/ViewCampaign/(:any)'] = 'Campaign/ViewCampaign/$1';

$route['admin/chat/profile/list'] = 'Chat/ViewListProfile';
$route['admin/chat/profile/showChatProfileList'] = 'Chat/showChatProfileList';
$route['admin/chat/profile/CheckExistChatProfile'] = 'Chat/CheckExistChatProfile';
$route['admin/chat/profile/addUpdateChatProfile'] = 'Chat/addUpdateChatProfile';
$route['admin/chat/message/list'] = 'Chat/ViewListMessage';
$route['admin/chat/message/showChatMessageList'] = 'Chat/showChatMessageList';
$route['admin/chat/message/addUpdateChatMessage'] = 'Chat/addUpdateChatMessage';