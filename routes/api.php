<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->namespace('v1')->prefix('v1')->group(function () {

    Route::prefix('user')->group(function() {
        Route::get('/all', 'UserController@index')->name('user.all');
        Route::get('/show/{uuid}', 'UserController@show')->name('user.byId');
        Route::post('/add', 'UserController@store')->name('user.add');
        Route::put('/update/{uuid}', 'UserController@update')->name('user.edit');
        Route::delete('/delete/{uuid}', 'UserController@destroy')->name('user.delete');
    });

    Route::prefix('country')->group(function() {
        Route::get('/all', 'CountryController@index')->name('country.all');
        Route::get('/list', 'CountryController@list')->name('country.list');
        Route::get('/show/{uuid}', 'CountryController@show')->name('country.byId');
        Route::post('/add', 'CountryController@store')->name('country.add');
        Route::put('/update/{uuid}', 'CountryController@update')->name('country.edit');
        Route::delete('/delete/{uuid}', 'CountryController@destroy')->name('country.delete');
    });

    Route::prefix('state')->group(function() {
        Route::get('/all', 'StateController@index')->name('state.all');
        Route::get('/list', 'StateController@list')->name('state.list');
        Route::get('/show/{uuid}', 'StateController@show')->name('state.byId');
        Route::post('/add', 'StateController@store')->name('state.add');
        Route::put('/update/{uuid}', 'StateController@update')->name('state.edit');
        Route::delete('/delete/{uuid}', 'StateController@destroy')->name('state.delete');
    });

    Route::prefix('city')->group(function() {
        Route::get('/all', 'CityController@index')->name('city.all');
        Route::get('/list', 'CityController@list')->name('city.list');
        Route::get('/show/{uuid}', 'CityController@show')->name('city.byId');
        Route::post('/add', 'CityController@store')->name('city.add');
        Route::put('/update/{uuid}', 'CityController@update')->name('city.edit');
        Route::delete('/delete/{uuid}', 'CityController@destroy')->name('city.delete');
    });

    Route::prefix('contract-service')->group(function() {
        Route::get('/all', 'ContractServiceController@index')->name('contract-service.all');
        Route::get('/show/{uuid}', 'ContractServiceController@show')->name('contract-service.byId');
        Route::post('/add', 'ContractServiceController@store')->name('contract-service.add');
        Route::put('/update/{uuid}', 'ContractServiceController@update')->name('contract-service.edit');
        Route::delete('/delete/{uuid}', 'ContractServiceController@destroy')->name('contract-service.delete');
    });

    Route::prefix('newsletter')->group(function() {
        Route::get('/all', 'NewsletterController@index')->name('newsletter.all');
        Route::get('/show/{uuid}', 'NewsletterController@show')->name('newsletter.byId');
        Route::post('/add', 'NewsletterController@store')->name('newsletter.add');
        Route::put('/update/{uuid}', 'NewsletterController@update')->name('newsletter.edit');
        Route::delete('/delete/{uuid}', 'NewsletterController@destroy')->name('newsletter.delete');
    });

    Route::prefix('contact-us')->group(function() {
        Route::get('/all', 'ContactUsController@index')->name('contact-us.all');
        Route::get('/show/{uuid}', 'ContactUsController@show')->name('contact-us.byId');
        Route::post('/add', 'ContactUsController@store')->name('contact-us.add');
        Route::put('/update/{uuid}', 'ContactUsController@update')->name('contact-us.edit');
        Route::delete('/delete/{uuid}', 'ContactUsController@destroy')->name('contact-us.delete');
    });

    Route::prefix('most-viewed-product')->group(function() {
        Route::get('/all', 'MostViewedProductController@index')->name('most-viewed-product.all');
        Route::get('/show/{uuid}', 'MostViewedProductController@show')->name('most-viewed-product.byId');
        Route::post('/add', 'MostViewedProductController@store')->name('most-viewed-product.add');
        Route::delete('/delete/{uuid}', 'MostViewedProductController@destroy')->name('most-viewed-product.delete');
    });

    Route::prefix('person')->group(function() {
        Route::get('/all', 'PersonController@index')->name('person.all');
        Route::get('/show/{uuid}', 'PersonController@show')->name('person.show');
        Route::get('/loged-user', 'PersonController@logedUser')->name('person.loged-user');
    });

    Route::prefix('supermarket-chain')->group(function() {
        Route::get('/all', 'SupermarketChainController@index')->name('supermarket-chain.all');
        Route::get('/list', 'SupermarketChainController@list')->name('supermarket-chain.list');
        Route::get('/show/{uuid}', 'SupermarketChainController@show')->name('supermarket-chain.byId');
        Route::post('/add', 'SupermarketChainController@store')->name('supermarket-chain.add');
        Route::put('/update/{personUuid}', 'SupermarketChainController@update')->name('supermarket-chain.edit');
        Route::delete('/delete/{personUuid}', 'SupermarketChainController@destroy')->name('supermarket-chain.delete');
    });

    Route::prefix('supermarket-chain-zip-code')->group(function() {
        Route::get('/all', 'SupermarketChainZipCodeController@index')->name('supermarket-chain-zip-code.all');
        Route::get('/find-between-zip-code-range', 'SupermarketChainZipCodeController@findBetweenZipCodeRange')->name('supermarket-chain-zip-code.findBetweenZipCodeRange');
        Route::get('/show/{uuid}', 'SupermarketChainZipCodeController@show')->name('supermarket-chain-zip-code.byId');
        Route::post('/add', 'SupermarketChainZipCodeController@store')->name('supermarket-chain-zip-code.add');
        Route::put('/update/{uuid}', 'SupermarketChainZipCodeController@update')->name('supermarket-chain-zip-code.edit');
        Route::delete('/delete/{uuid}', 'SupermarketChainZipCodeController@destroy')->name('supermarket-chain-zip-code.delete');
    });

    Route::prefix('collaborator')->group(function() {
        Route::get('/all', 'CollaboratorController@index')->name('collaborator.all');
        Route::get('/show/{uuid}', 'CollaboratorController@show')->name('collaborator.byId');
        Route::post('/add', 'CollaboratorController@store')->name('collaborator.add');
        Route::put('/update/{personUuid}', 'CollaboratorController@update')->name('collaborator.edit');
        Route::delete('/delete/{personUuid}', 'CollaboratorController@destroy')->name('collaborator.delete');
    });

    Route::prefix('shopper')->group(function() {
        Route::get('/all', 'ShopperController@index')->name('shopper.all');
        Route::get('/show/{uuid}', 'ShopperController@show')->name('shopper.byId');
        Route::post('/add', 'ShopperController@store')->name('shopper.add');
        Route::put('/update/{personUuid}', 'ShopperController@update')->name('shopper.edit');
        Route::delete('/delete/{personUuid}', 'ShopperController@destroy')->name('shopper.delete');
    });

    Route::prefix('conductor')->group(function() {
        Route::get('/all', 'ConductorController@index')->name('conductor.all');
        Route::get('/show/{uuid}', 'ConductorController@show')->name('conductor.byId');
        Route::post('/add', 'ConductorController@store')->name('conductor.add');
        Route::put('/update/{personUuid}', 'ConductorController@update')->name('conductor.edit');
        Route::delete('/delete/{personUuid}', 'ConductorController@destroy')->name('conductor.delete');
    });

    Route::prefix('customer')->group(function() {
        Route::get('/all', 'CustomerController@index')->name('customer.all');
        Route::get('/show/{uuid}', 'CustomerController@show')->name('customer.byId');
        Route::get('/show-any-fields', 'CustomerController@showByAnyFields')->name('customer.byAnyFields');
        Route::post('/add', 'CustomerController@store')->name('customer.add');
        Route::put('/update/{personUuid}', 'CustomerController@update')->name('customer.edit');
        Route::delete('/delete/{personUuid}', 'CustomerController@destroy')->name('customer.delete');
    });

    Route::prefix('nearby-store')->group(function() {
        Route::get('/all', 'NearbyStoreController@index')->name('nearby-store.all');
        Route::get('/show/{uuid}', 'NearbyStoreController@show')->name('nearby-store.byId');
        Route::post('/add', 'NearbyStoreController@store')->name('nearby-store.add');
        Route::put('/update/{uuid}', 'NearbyStoreController@update')->name('nearby-store.edit');
        Route::delete('/delete/{uuid}', 'NearbyStoreController@destroy')->name('nearby-store.delete');
    });

    Route::prefix('vehicle-type')->group(function() {
        Route::get('/all', 'VehicleTypeController@index')->name('vehicle-type.all');
        Route::get('/show/{uuid}', 'VehicleTypeController@show')->name('vehicle-type.byId');
        Route::post('/add', 'VehicleTypeController@store')->name('vehicle-type.add');
        Route::put('/update/{uuid}', 'VehicleTypeController@update')->name('vehicle-type.edit');
        Route::delete('/delete/{uuid}', 'VehicleTypeController@destroy')->name('vehicle-type.delete');
    });

    Route::prefix('vehicle-brand')->group(function() {
        Route::get('/all', 'VehicleBrandController@index')->name('vehicle-brand.all');
        Route::get('/show/{uuid}', 'VehicleBrandController@show')->name('vehicle-brand.byId');
        Route::post('/add', 'VehicleBrandController@store')->name('vehicle-brand.add');
        Route::put('/update/{uuid}', 'VehicleBrandController@update')->name('vehicle-brand.edit');
        Route::delete('/delete/{uuid}', 'VehicleBrandController@destroy')->name('vehicle-brand.delete');
    });

    Route::prefix('vehicle')->group(function() {
        Route::get('/all', 'VehicleController@index')->name('vehicle.all');
        Route::get('/show/{uuid}', 'VehicleController@show')->name('vehicle.byId');
        Route::post('/add', 'VehicleController@store')->name('vehicle.add');
        Route::put('/update/{uuid}', 'VehicleController@update')->name('vehicle.edit');
        Route::delete('/delete/{uuid}', 'VehicleController@destroy')->name('vehicle.delete');
    });

    Route::prefix('conductor-vehicle-event')->group(function() {
        Route::get('/all', 'ConductorVehicleEventController@index')->name('conductor-vehicle-event.all');
        Route::get('/associated', 'ConductorVehicleEventController@associated')->name('conductor-vehicle-event.associated');
        Route::get('/show/{uuid}', 'ConductorVehicleEventController@show')->name('conductor-vehicle-event.byId');
        Route::post('/add', 'ConductorVehicleEventController@store')->name('conductor-vehicle-event.add');
        Route::put('/update/{uuid}', 'ConductorVehicleEventController@update')->name('conductor-vehicle-event.edit');
        Route::delete('/delete/{uuid}', 'ConductorVehicleEventController@destroy')->name('conductor-vehicle-event.delete');
    });

    Route::prefix('conductor-supermarket-chain')->group(function() {
        Route::get('/all', 'ConductorSupermarketChainController@index')->name('conductor-supermarket-chain.all');
        Route::get('/associated', 'ConductorSupermarketChainController@associated')->name('conductor-supermarket-chain.associated');
        Route::get('/show/{uuid}', 'ConductorSupermarketChainController@show')->name('conductor-supermarket-chain.byId');
        Route::post('/add', 'ConductorSupermarketChainController@store')->name('conductor-supermarket-chain.add');
        Route::put('/update/{uuid}', 'ConductorSupermarketChainController@update')->name('conductor-supermarket-chain.edit');
        Route::delete('/delete/{uuid}', 'ConductorSupermarketChainController@destroy')->name('conductor-supermarket-chain.delete');
    });

     Route::prefix('institutional-supermarket-chain')->group(function() {
        Route::get('/all', 'InstitutionalSupermarketChainController@index')->name('institutional-supermarket-chain.all');
        Route::get('/show/{uuid}', 'InstitutionalSupermarketChainController@show')->name('institutional-supermarket-chain.byId');
        Route::post('/add', 'InstitutionalSupermarketChainController@store')->name('institutional-supermarket-chain.add');
        Route::put('/update/{uuid}', 'InstitutionalSupermarketChainController@update')->name('institutional-supermarket-chain.edit');
        Route::delete('/delete/{uuid}', 'InstitutionalSupermarketChainController@destroy')->name('institutional-supermarket-chain.delete');
    });

    Route::prefix('category-product')->group(function() {
        Route::get('/all', 'CategoryProductController@index')->name('category-product.all');
        Route::get('/show/{uuid}', 'CategoryProductController@show')->name('category-product.byId');
        Route::post('/add', 'CategoryProductController@store')->name('category-product.add');
        Route::put('/update/{uuid}', 'CategoryProductController@update')->name('category-product.edit');
        Route::delete('/delete/{uuid}', 'CategoryProductController@destroy')->name('category-product.delete');
    });

    Route::prefix('site-filter-home-category')->group(function() {
        Route::get('/all', 'SiteFilterHomeCategoryController@index')->name('site-filter-home-category.all');
        Route::get('/show/{uuid}', 'SiteFilterHomeCategoryController@show')->name('site-filter-home-category.byId');
        Route::post('/add', 'SiteFilterHomeCategoryController@store')->name('site-filter-home-category.add');
        Route::put('/update/{uuid}', 'SiteFilterHomeCategoryController@update')->name('site-filter-home-category.edit');
        Route::delete('/delete/{uuid}', 'SiteFilterHomeCategoryController@destroy')->name('site-filter-home-category.delete');
    });

    Route::prefix('department')->group(function() {
        Route::get('/all', 'DepartmentController@index')->name('department.all');
        Route::get('/show/{uuid}', 'DepartmentController@show')->name('department.byId');
        Route::post('/add', 'DepartmentController@store')->name('department.add');
        Route::put('/update/{uuid}', 'DepartmentController@update')->name('department.edit');
        Route::delete('/delete/{uuid}', 'DepartmentController@destroy')->name('department.delete');
    });

    Route::prefix('product-brand')->group(function() {
        Route::get('/all', 'ProductBrandController@index')->name('product-brand.all');
        Route::get('/show/{uuid}', 'ProductBrandController@show')->name('product-brand.byId');
        Route::post('/add', 'ProductBrandController@store')->name('product-brand.add');
        Route::put('/update/{uuid}', 'ProductBrandController@update')->name('product-brand.edit');
        Route::delete('/delete/{uuid}', 'ProductBrandController@destroy')->name('product-brand.delete');
    });

    Route::prefix('product')->group(function() {
        Route::get('/all', 'ProductController@index')->name('product.all');
        Route::get('/find-all-join-paginate', 'ProductController@findAllJoinPaginate')->name('product.findAllJoinPaginate');
        Route::get('/all-available', 'ProductController@allAvailable')->name('product.all-available');
        Route::get('/all-product-person-id-supermarket-chain', 'ProductController@allProductByPersonIdSupermarketChain')->name('product.all-product-supermarket-chain');
        Route::get('/show/{uuid}', 'ProductController@show')->name('product.byId');
        Route::get('/find-by-uuid/{uuid}', 'ProductController@findByUuid')->name('product.findByUuid');
        Route::post('/add', 'ProductController@store')->name('product.add');
        Route::put('/update/{uuid}', 'ProductController@update')->name('product.edit');
        Route::delete('/delete/{uuid}', 'ProductController@destroy')->name('product.delete');
    });

    Route::prefix('product-stock')->group(function() {
        Route::get('/all', 'ProductStockController@index')->name('product-stock.all');
        Route::get('/show/{uuid}', 'ProductStockController@show')->name('product-stock.byId');
        Route::post('/add', 'ProductStockController@store')->name('product-stock.add');
        Route::put('/update/{uuid}', 'ProductStockController@update')->name('product-stock.edit');
        Route::delete('/delete/{uuid}', 'ProductStockController@destroy')->name('product-stock.delete');
    });

    Route::prefix('order')->group(function() {
        Route::get('/all', 'OrderController@index')->name('order.all');
        Route::get('/order-with-and-without-shoppers', 'OrderController@findOrderWithAndWithoutShoppers')->name('order.findOrderWithAndWithoutShoppers');
        Route::get('/order-with-and-without-routes', 'OrderController@findOrderWithAndWithoutRoutes')->name('order.findOrderWithAndWithoutRoutes');
        Route::get('/order-with-and-without-conductors', 'OrderController@findOrderWithAndWithoutConductors')->name('order.findOrderWithAndWithoutConductors');
        Route::get('/doesnt-destination', 'OrderController@doesntHaveDestination')->name('order.doesntDestination');
        Route::get('/show/{uuid}', 'OrderController@show')->name('order.byId');
        Route::post('/add', 'OrderController@store')->name('order.add');
        Route::put('/update/{uuid}', 'OrderController@update')->name('order.edit');
        Route::delete('/delete/{uuid}', 'OrderController@destroy')->name('order.delete');
    });

    Route::prefix('order-event')->group(function() {
        Route::get('/all', 'OrderEventController@index')->name('order-event.all');
        Route::get('/show/{uuid}', 'OrderEventController@show')->name('order-event.byId');
        Route::post('/add', 'OrderEventController@store')->name('order-event.add');
        Route::put('/update/{uuid}', 'OrderEventController@update')->name('order-event.edit');
        Route::delete('/delete/{uuid}', 'OrderEventController@destroy')->name('order-event.delete');
    });

    Route::prefix('order-box-quantity')->group(function() {
        Route::get('/all', 'OrderBoxQuantityController@index')->name('order-box-quantity.all');
        Route::get('/show/{uuid}', 'OrderBoxQuantityController@show')->name('order-box-quantity.byId');
        Route::post('/add', 'OrderBoxQuantityController@store')->name('order-box-quantity.add');
        Route::put('/update/{uuid}', 'OrderBoxQuantityController@update')->name('order-box-quantity.edit');
        Route::delete('/delete/{uuid}', 'OrderBoxQuantityController@destroy')->name('order-box-quantity.delete');
    });

    Route::prefix('order-address')->group(function() {
        Route::get('/all', 'OrderAddressController@index')->name('order-address.all');
        Route::get('/show/{uuid}', 'OrderAddressController@show')->name('order-address.byId');
        Route::post('/add', 'OrderAddressController@store')->name('order-address.add');
        Route::put('/update/{uuid}', 'OrderAddressController@update')->name('order-address.edit');
        Route::delete('/delete/{uuid}', 'OrderAddressController@destroy')->name('order-address.delete');
    });

    Route::prefix('route')->group(function() {
        Route::get('/all', 'RouteController@index')->name('route.all');
        Route::get('/show/{uuid}', 'RouteController@show')->name('route.byId');
        Route::post('/add', 'RouteController@store')->name('route.add');
        Route::put('/update/{uuid}', 'RouteController@update')->name('route.edit');
        Route::delete('/delete/{uuid}', 'RouteController@destroy')->name('route.delete');
    });

    Route::prefix('route-destination')->group(function() {
        Route::get('/all', 'RouteDestinationController@index')->name('route-destination.all');
        Route::get('/multiple', 'RouteDestinationController@multipleById')->name('route-destination.multiple');
        Route::get('/show/{uuid}', 'RouteDestinationController@show')->name('route-destination.byId');
        Route::post('/add', 'RouteDestinationController@store')->name('route-destination.add');
        Route::post('/add-many', 'RouteDestinationController@storeMany')->name('route-destination.add-many');
        Route::put('/update/{uuid}', 'RouteDestinationController@update')->name('route-destination.edit');
        Route::delete('/delete/{uuid}', 'RouteDestinationController@destroy')->name('route-destination.delete');
    });

    Route::prefix('route-destination-event')->group(function() {
        Route::get('/all', 'RouteDestinationEventController@index')->name('route-destination-event.all');
        Route::get('/show/{uuid}', 'RouteDestinationEventController@show')->name('route-destination-event.byId');
        Route::post('/add', 'RouteDestinationEventController@store')->name('route-destination-event.add');
        Route::put('/update/{uuid}', 'RouteDestinationEventController@update')->name('route-destination-event.edit');
        Route::delete('/delete/{uuid}', 'RouteDestinationEventController@destroy')->name('route-destination-event.delete');
    });

    Route::prefix('route-event')->group(function() {
        Route::get('/all', 'RouteEventController@index')->name('route-event.all');
        Route::get('/event-by-route', 'RouteEventController@eventByRouteId')->name('route-event.eventByRouteId');
        Route::get('/show/{uuid}', 'RouteEventController@show')->name('route-event.byId');
        Route::post('/add', 'RouteEventController@store')->name('route-event.add');
        Route::put('/update/{uuid}', 'RouteEventController@update')->name('route-event.edit');
        Route::delete('/delete/{uuid}', 'RouteEventController@destroy')->name('route-event.delete');
    });

    Route::prefix('conductor-route')->group(function() {
        Route::get('/all', 'ConductorRouteController@index')->name('conductor-route.all');
        Route::get('/associated', 'ConductorRouteController@associated')->name('conductor-route.associated');
        Route::get('/show/{uuid}', 'ConductorRouteController@show')->name('conductor-route.byId');
        Route::post('/add', 'ConductorRouteController@store')->name('conductor-route.add');
        Route::put('/update/{uuid}', 'ConductorRouteController@update')->name('conductor-route.edit');
        Route::delete('/delete/{uuid}', 'ConductorRouteController@destroy')->name('conductor-route.delete');
    });

    Route::prefix('shopper-supermarket-chain')->group(function() {
        Route::get('/all', 'ShopperSupermarketChainController@index')->name('shopper-supermarket-chain.all');
        Route::get('/associated', 'ShopperSupermarketChainController@associated')->name('shopper-supermarket-chain.associated');
        Route::get('/show/{uuid}', 'ShopperSupermarketChainController@show')->name('shopper-supermarket-chain.byId');
        Route::post('/add', 'ShopperSupermarketChainController@store')->name('shopper-supermarket-chain.add');
        Route::put('/update/{uuid}', 'ShopperSupermarketChainController@update')->name('shopper-supermarket-chain.edit');
        Route::delete('/delete/{uuid}', 'ShopperSupermarketChainController@destroy')->name('shopper-supermarket-chain.delete');
    });

    Route::prefix('shopper-order')->group(function() {
        Route::get('/all', 'ShopperOrderController@index')->name('shopper-order.all');
        Route::get('/associates', 'ShopperOrderController@associates')->name('shopper-order.associates');
        Route::get('/show/{uuid}', 'ShopperOrderController@show')->name('shopper-order.byId');
        Route::post('/add', 'ShopperOrderController@store')->name('shopper-order.add');
        Route::put('/update/{uuid}', 'ShopperOrderController@update')->name('shopper-order.edit');
        Route::delete('/delete/{uuid}', 'ShopperOrderController@destroy')->name('shopper-order.delete');
    });

    Route::prefix('shopper-order-product')->group(function() {
        Route::get('/all', 'ShopperOrderProductController@index')->name('shopper-order-product.all');
        Route::get('/associates', 'ShopperOrderProductController@associates')->name('shopper-order-product.associates');
        Route::get('/show/{uuid}', 'ShopperOrderProductController@show')->name('shopper-order-product.byId');
        Route::post('/add', 'ShopperOrderProductController@store')->name('shopper-order-product.add');
        Route::post('/add-with-barcode', 'ShopperOrderProductController@storeWithBarcode')->name('shopper-order-product.storeWithBarcode');
        Route::put('/update/{uuid}', 'ShopperOrderProductController@update')->name('shopper-order-product.edit');
        Route::delete('/delete/{uuid}', 'ShopperOrderProductController@destroy')->name('shopper-order-product.delete');
    });

    Route::prefix('site-menu')->group(function() {
        Route::get('/all', 'SiteMenuController@index')->name('site-menu.all');
        Route::get('/all-category-id-is-null', 'SiteMenuController@allCategoryIdIsNull')->name('site-menu.allCategoryIdIsNull');
        Route::get('/find-parent-menu', 'SiteMenuController@findParentMenuWithChildrens')->name('site-menu.findParentMenuWithChildrens');
        Route::get('/show/{uuid}', 'SiteMenuController@show')->name('site-menu.byId');
        Route::post('/add', 'SiteMenuController@store')->name('site-menu.add');
        Route::put('/update/{uuid}', 'SiteMenuController@update')->name('site-menu.edit');
        Route::delete('/delete/{uuid}', 'SiteMenuController@destroy')->name('site-menu.delete');
    });

    Route::prefix('site-area')->group(function() {
        Route::get('/all', 'SiteAreaController@index')->name('site-area.all');
        Route::get('/show/{uuid}', 'SiteAreaController@show')->name('site-area.byId');
        Route::post('/add', 'SiteAreaController@store')->name('site-area.add');
        Route::put('/update/{uuid}', 'SiteAreaController@update')->name('site-area.edit');
        Route::delete('/delete/{uuid}', 'SiteAreaController@destroy')->name('site-area.delete');
    });

    Route::prefix('site-home-setting')->group(function() {
        Route::get('/all', 'SiteHomeSettingController@index')->name('site-home-setting.all');
        Route::get('/show/{uuid}', 'SiteHomeSettingController@show')->name('site-home-setting.byId');
        Route::post('/add', 'SiteHomeSettingController@store')->name('site-home-setting.add');
        Route::put('/update/{uuid}', 'SiteHomeSettingController@update')->name('site-home-setting.edit');
        Route::delete('/delete/{uuid}', 'SiteHomeSettingController@destroy')->name('site-home-setting.delete');
        Route::get('/all-banner-site-area', 'SiteHomeSettingController@findAllBannerSiteArea')->name('site-home-setting.all-banner-site-area');
        Route::get('/all-product-site-area', 'SiteHomeSettingController@findAllProductSiteArea')->name('site-home-setting.all-product-site-area');
    });

    Route::prefix('site-area-product')->group(function() {
        Route::get('/all', 'SiteAreaProductController@index')->name('site-area-product.all');
        Route::get('/show/{uuid}', 'SiteAreaProductController@show')->name('site-area-product.byId');
        Route::post('/add', 'SiteAreaProductController@store')->name('site-area-product.add');
        Route::put('/update/{uuid}', 'SiteAreaProductController@update')->name('site-area-product.edit');
        Route::delete('/delete/{uuid}', 'SiteAreaProductController@destroy')->name('site-area-product.delete');
    });

    Route::prefix('site-area-banner')->group(function() {
        Route::get('/all', 'SiteAreaBannerController@index')->name('site-area-banner.all');
        Route::get('/show/{uuid}', 'SiteAreaBannerController@show')->name('site-area-banner.byId');
        Route::post('/add', 'SiteAreaBannerController@store')->name('site-area-banner.add');
        Route::put('/update/{uuid}', 'SiteAreaBannerController@update')->name('site-area-banner.edit');
        Route::delete('/delete/{uuid}', 'SiteAreaBannerController@destroy')->name('site-area-banner.delete');
    });

    Route::prefix('base-product')->group(function() {
        Route::get('/all', 'BaseProductController@index')->name('base-product.all');
        Route::get('/show/{uuid}', 'BaseProductController@show')->name('base-product.byId');
        Route::get('/show-min-price/{uuid}', 'BaseProductController@findByIdMinPriceProduct')->name('base-product.show-min-price');
        Route::post('/add', 'BaseProductController@store')->name('base-product.add');
        Route::put('/update/{uuid}', 'BaseProductController@update')->name('base-product.edit');
        Route::delete('/delete/{uuid}', 'BaseProductController@destroy')->name('base-product.delete');
    });

    Route::prefix('banner-category')->group(function() {
        Route::get('/all', 'BannerCategoryController@index')->name('banner-category.all');
        Route::get('/show/{uuid}', 'BannerCategoryController@show')->name('banner-category.byId');
        Route::post('/add', 'BannerCategoryController@store')->name('banner-category.add');
        Route::put('/update/{uuid}', 'BannerCategoryController@update')->name('banner-category.edit');
        Route::delete('/delete/{uuid}', 'BannerCategoryController@destroy')->name('banner-category.delete');
    });

    Route::prefix('banner')->group(function() {
        Route::get('/all', 'BannerController@index')->name('banner.all');
        Route::get('/show/{uuid}', 'BannerController@show')->name('banner.byId');
        Route::post('/add', 'BannerController@store')->name('banner.add');
        Route::put('/update/{uuid}', 'BannerController@update')->name('banner.edit');
        Route::delete('/delete/{uuid}', 'BannerController@destroy')->name('banner.delete');
    });

    Route::prefix('image')->group(function() {
        Route::get('/all', 'ImageController@index')->name('image.all');
        Route::get('/show/{uuid}', 'ImageController@show')->name('image.byId');
        Route::post('/add', 'ImageController@store')->name('image.add');
        Route::put('/update/{uuid}', 'ImageController@update')->name('image.edit');
        Route::delete('/delete/{uuid}', 'ImageController@destroy')->name('image.delete');
    });
});

/**
 * ECOMMERCE
 */
Route::namespace('v1')->prefix('v1')->group(function () {
    Route::prefix('store')->group(function() {

        Route::prefix('state')->group(function() {
            Route::get('/list', 'StateController@list')->name('store.state.list');
        });

        Route::prefix('city')->group(function() {
            Route::get('/list', 'CityController@list')->name('store.city.list');
        });

        Route::prefix('site-home-setting')->group(function() {
            Route::get('/all', 'SiteHomeSettingController@index')->name('store.site-home-setting.all');
            Route::get('/all-banner-site-area', 'SiteHomeSettingController@findAllBannerSiteArea')->name('store.site-home-setting.all-banner-site-area');
            Route::get('/all-product-site-area', 'SiteHomeSettingController@findAllProductSiteArea')->name('store.site-home-setting.all-product-site-area');
        });

        Route::prefix('image')->group(function() {
            Route::get('/all', 'ImageController@index')->name('store.image.all');
        });

        Route::prefix('base-product')->group(function() {
            Route::get('/show-min-price/{uuid}', 'BaseProductController@findByIdMinPriceProduct')->name('store.base-product.show-min-price');
        });

        Route::prefix('product')->group(function() {
            Route::get('/find-by-uuid/{uuid}', 'ProductController@findByUuid')->name('store.product.findByUuid');
            Route::get('/find-all-join-paginate', 'ProductController@findAllJoinPaginate')->name('product.findAllJoinPaginate');
        });

        Route::prefix('customer')->group(function() {
            Route::post('/add', 'CustomerController@store')->name('store.customer.add');
        });

        Route::prefix('site-menu')->group(function() {
            Route::get('/find-parent-menu', 'SiteMenuController@findParentMenuWithChildrens')->name('store.site-menu.findParentMenuWithChildrens');
        });

        Route::prefix('institutional-supermarket-chain')->group(function() {
            Route::get('/all', 'InstitutionalSupermarketChainController@index')->name('store.institutional-supermarket-chain.all');
        });

        Route::prefix('supermarket-chain')->group(function() {
            Route::get('/all', 'SupermarketChainController@index')->name('store.supermarket-chain.all');
            Route::get('/list', 'SupermarketChainController@list')->name('store.supermarket-chain.list');
            Route::get('/show/{uuid}', 'SupermarketChainController@show')->name('store.supermarket-chain.byId');
        });

        Route::prefix('supermarket-chain-zip-code')->group(function() {
            Route::get('/find-between-zip-code-range', 'SupermarketChainZipCodeController@findBetweenZipCodeRange')->name('store.supermarket-chain-zip-code.findBetweenZipCodeRange');
        });

        Route::prefix('newsletter')->group(function() {
            Route::post('/add', 'NewsletterController@store')->name('store.newsletter.add');
        });

        Route::prefix('contact-us')->group(function() {
            Route::post('/add', 'ContactUsController@store')->name('store.contact-us.add');
        });

        Route::prefix('site-filter-home-category')->group(function() {
            Route::get('/all', 'SiteFilterHomeCategoryController@index')->name('store.site-filter-home-category.all');
        });

        Route::prefix('order-address')->group(function() {
            Route::post('/add', 'OrderAddressController@store')->name('store.order-address.add');
        });

    });
});




