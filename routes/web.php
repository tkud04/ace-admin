<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Route::get('/', function(){return "<h2 style='color: red;'>Out of service</h2>";});

Route::get('/', 'MainController@getIndex');

Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');
Route::get('register', 'LoginController@getRegister');
Route::post('register', 'LoginController@postRegister');
Route::get('logout', 'LoginController@getLogout');

Route::get('products', 'MainController@getProducts');
Route::get('product', 'MainController@getProduct');
Route::get('add-product', 'MainController@getAddProduct');
Route::post('add-product', 'MainController@postAddProduct');
Route::get('edit-product', 'MainController@getEditProduct');
Route::post('edit-product', 'MainController@postEditProduct');
Route::get('disable-product', 'MainController@getDisableProduct');
Route::get('delete-product', 'MainController@getDeleteProduct');

Route::get('users', 'MainController@getUsers');
Route::get('user', 'MainController@getUser');
Route::post('user', 'MainController@postUser');
Route::get('edu', 'MainController@getManageUserStatus');

Route::get('categories', 'MainController@getCategories');
Route::get('add-category', 'MainController@getAddCategory');
Route::post('add-category', 'MainController@postAddCategory');
Route::get('edit-category', 'MainController@getEditCategory');
Route::post('edit-category', 'MainController@postEditCategory');

Route::get('ads', 'MainController@getAds');
Route::get('new-ad', 'MainController@getAddAd');
Route::post('new-ad', 'MainController@postAddAd');
Route::get('edit-ad', 'MainController@getEditAd');
Route::post('edit-ad', 'MainController@postEditAd');

Route::get('banners', 'MainController@getBanners');
Route::get('new-banner', 'MainController@getAddBanner');
Route::post('new-banner', 'MainController@postAddBanner');
Route::get('edit-banner', 'MainController@getEditBanner');
Route::post('edit-banner', 'MainController@postEditBanner');

Route::get('set-cover-img', 'MainController@getSetCoverImage');
Route::get('delete-img', 'MainController@getDeleteImage');

Route::get('reviews', 'MainController@getReviews');
Route::get('edit-review', 'MainController@getEditReview');
Route::post('edit-review', 'MainController@postEditReview');

Route::get('track', 'MainController@getTrackings');
Route::get('new-tracking', 'MainController@getAddTracking');
Route::post('new-tracking', 'MainController@postAddTracking');

Route::get('orders', 'MainController@getOrders');
Route::get('new-order', 'MainController@getAddOrder');
Route::get('aba', 'MainController@getTestAddOrder');
Route::post('new-order', 'MainController@postAddOrder');
Route::get('edit-order', 'MainController@getEditOrder');
Route::post('edit-order', 'MainController@postEditOrder');
Route::get('delete-order', 'MainController@getDeleteOrder');

Route::get('new-discount', 'MainController@getAddDiscount');
Route::post('new-discount', 'MainController@postAddDiscount');
Route::get('discounts', 'MainController@getDiscounts');
Route::get('edit-discount', 'MainController@getEditDiscount');
Route::post('edit-discount', 'MainController@postEditDiscount');
Route::get('delete-discount', 'MainController@getDeleteDiscount');

Route::get('confirm-payment', 'MainController@getConfirmPayment');

Route::get('carts', 'MainController@getUserCarts');
Route::get('but', 'MainController@getBulkUpdateTracking');
Route::post('but', 'MainController@postBulkUpdateTracking');
Route::get('bcp', 'MainController@getBulkConfirmPayment');
Route::post('bcp', 'MainController@postBulkConfirmPayment');
Route::get('bup', 'MainController@getBulkUpdateProducts');
Route::post('bup', 'MainController@postBulkUpdateProducts');
Route::get('buup', 'MainController@getBulkUploadProducts');
Route::post('buup', 'MainController@postBulkUploadProducts');

Route::get('add-setting', 'MainController@getAddSetting');
Route::get('settings', 'MainController@getSettings');
Route::get('senders', 'MainController@getSenders');
Route::get('add-sender', 'MainController@getAddSender');
Route::post('add-sender', 'MainController@postAddSender');
Route::get('sender', 'MainController@getSender');
Route::post('sender', 'MainController@postSender');
Route::get('remove-sender', 'MainController@getRemoveSender');
Route::get('mark-sender', 'MainController@getMarkSender');

Route::get('gdf', 'MainController@getDeliveryFee');
Route::post('settings-delivery', 'MainController@postSettingsDelivery');
Route::post('settings-sender', 'MainController@postSettingsSender');
Route::post('settings-bank', 'MainController@postSettingsBank');
Route::post('settings-discount', 'MainController@postSettingsDiscount');

Route::get('plugins', 'MainController@getPlugins');
Route::get('add-plugin', 'MainController@getAddPlugin');
Route::post('add-plugin', 'MainController@postAddPlugin');
Route::get('plugin', 'MainController@getPlugin');
Route::post('plugin', 'MainController@postPlugin');
Route::get('remove-plugin', 'MainController@getRemovePlugin');

Route::get('couriers', 'MainController@getCouriers');
Route::get('add-courier', 'MainController@getAddCourier');
Route::post('add-courier', 'MainController@postAddCourier');
Route::get('courier', 'MainController@getCourier');
Route::post('courier', 'MainController@postCourier');
Route::get('remove-courier', 'MainController@getRemoveCourier');

Route::get('analytics', 'MainController@getAnalytics');
Route::post('analytics', 'MainController@postAnalytics');
Route::get('facebook-catalog', 'MainController@getFacebookCatalog');
Route::post('facebook-catalog', 'MainController@postFacebookCatalog');
Route::get('facebook-catalog-add', 'MainController@getFacebookCatalogAdd');
Route::post('facebook-catalog-add', 'MainController@postFacebookCatalogAdd');
Route::get('facebook-catalog-update', 'MainController@getFacebookCatalogUpdate');
Route::post('facebook-catalog-update', 'MainController@postFacebookCatalogUpdate');
Route::get('facebook-catalog-delete', 'MainController@getFacebookCatalogUpdate');
Route::post('facebook-catalog-delete', 'MainController@postFacebookCatalogDelete');

Route::get('apitest', 'MainController@getAPITest');
