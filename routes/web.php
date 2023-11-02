<?php

use App\Http\Controllers\Admin\FarmFactorController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CommodityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\FpoController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OtherController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\Admin\PopController;
use App\Http\Controllers\Admin\ProcessCapabilityController;
use App\Http\Controllers\Admin\ProcessMethodController;
use App\Http\Controllers\Admin\ProcessorController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubDistrictController;
use App\Http\Controllers\Admin\TraderController;
use App\Http\Controllers\Admin\VarietyController;
use App\Http\Controllers\Admin\VillageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ServiceAllocationController;
use App\Http\Controllers\Admin\WarehouseTypeController;
use App\Http\Controllers\Admin\UserPrivilegeController;
use App\Http\Controllers\Admin\RoleMasterController;
use App\Http\Controllers\Controller;

use App\Models\ProcessMethod;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controller::class, 'index'])->name('index');
Route::get('/contact', [Controller::class, 'contact'])->name('contact');
Route::get('/about', [Controller::class, 'about'])->name('about');
Route::get('/our-services', [Controller::class, 'services'])->name('services');

Route::get('/package-details/{id}', [Controller::class, 'packagedetail'])->name('packagedetail');
Route::get('/blogs', [Controller::class, 'blogs'])->name('blogs');
Route::get('/blog-details/{id}', [Controller::class, 'blogdetail'])->name('blogdetail');
Route::get('/service-details/{id}', [Controller::class, 'servicedetail'])->name('servicedetail');
Route::get('/page/{slug}', [Controller::class, 'staticpage'])->name('staticpage');

Route::get('/our-packages', [Controller::class, 'packages'])->name('packages');
Route::get('/admin', [AuthController::class, 'adminLogin'])->name('admin-login');

Route::post('/send-enquiry', [Controller::class, 'sendEnquiry'])->name('sendEnquiry-123');


Route::group(['middleware' => ['auth','permissions']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('change-password', [DashboardController::class, 'changepassword'])->name('changepassword');


    Route::post('/change-password1', [DashboardController::class, 'updatePassword'])->name('update-password');

    
    
    //users
    Route::resource('farmers', FarmerController::class);
    Route::resource('fpos', FpoController::class);
    Route::resource('traders', TraderController::class);
    Route::resource('processors', ProcessorController::class);

    Route::get('/plan-featured/{id}', [ProcessorController::class, 'featured'])->name('featured');
  

    //kycs
    Route::get('farmer-kyc', [FarmerController::class, 'farmerKycList'])->name('farmer_kyc');
    Route::post('get-farmer-kyc-details', [FarmerController::class, 'getFarmerKycById'])->name('get_farmer_kyc_by_id');
    Route::post('update-farmer-kyc-status', [FarmerController::class, 'updateFarmerKycStatus'])->name('update_farmer_kyc_status');

    Route::get('fpo-kyc', [FpoController::class, 'fpoKycList'])->name('fpo_kyc');
    Route::post('get-fpo-kyc-details', [FpoController::class, 'getFpoKycById'])->name('get_fpo_kyc_by_id');
    Route::post('update-fpo-kyc-status', [FpoController::class, 'updateFpoKycStatus'])->name('update_fpo_kyc_status');

    Route::get('trader-kyc', [TraderController::class, 'traderKycList'])->name('trader_kyc');
    Route::post('get-trader-kyc-details', [TraderController::class, 'getTraderKycById'])->name('get_trader_kyc_by_id');
    Route::post('update-trader-kyc-status', [TraderController::class, 'updateTraderKycStatus'])->name('update_trader_kyc_status');

    Route::get('processor-kyc', [ProcessorController::class, 'processorKycList'])->name('processor_kyc');



    Route::post('get-processor-kyc-details', [ProcessorController::class, 'getProcessorKycById'])->name('get_processor_kyc_by_id');
    Route::post('update-processor-kyc-status', [ProcessorController::class, 'updateProcessorKycStatus'])->name('update_processor_kyc_status');

    Route::resource('farm-factors', FarmFactorController::class);
  
    Route::resource('process-capabilities', ProcessCapabilityController::class);
    Route::resource('process-methods', ProcessMethodController::class);
    Route::resource('warehouse-types', WarehouseTypeController::class);
    Route::resource('varieties', VarietyController::class);

    Route::resource('commodities', CommodityController::class);

    Route::resource('equipments', EquipmentController::class);

    Route::resource('news', NewsController::class);

    Route::resource('sections', SectionController::class);

    Route::resource('pops', PopController::class);

    Route::get('trades', [OtherController::class, 'getAllTrades'])->name('trades');
    Route::get('trade-details/{trade_id?}', [OtherController::class, 'getTradeDetails'])->name('trade-details');

    /**
     * Location routes
     */

    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);
    Route::resource('pincodes', PincodeController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('sub-districts', SubDistrictController::class);
    Route::resource('villages', VillageController::class);
    Route::post('sub-district', [SubDistrictController::class, 'getSubDistrict']);
    Route::post('village/fetch', [SubDistrictController::class, 'getVillage']);
    Route::post('state/fetch', [SubDistrictController::class, 'getState']);
    Route::post('district/fetch', [SubDistrictController::class, 'getDistrict']);
    Route::post('cities/fetch', [SubDistrictController::class, 'getCity']);
    Route::post('pincodes/fetch', [SubDistrictController::class, 'getPincode']);


    /**
     * Service routes
     */
    Route::resource('services', ServiceController::class);
    Route::resource('service-allocations', ServiceAllocationController::class);

    //Report
    Route::get('procurement-report', [ReportController::class, 'index'])->name('procurement_report');
    Route::post('procurement-filter', [ReportController::class, 'filter'])->name('procurement_filter');

    Route::get('feedbacks', [ReportController::class, 'feedbackList'])->name('feedbacks');

    //Marketing & Promo
    Route::resource('marketings', MarketingController::class);

    //role master
    Route::get('all-roles',[RoleMasterController::class,'index'])->name('all-roles');
    Route::any('add-role',[RoleMasterController::class,'create'])->name('add-role');
    Route::any('edit-role/{id}',[RoleMasterController::class,'edit'])->name('edit-role');

    // user privileges
    Route::get('user-privileges',[UserPrivilegeController::class,'index'])->name('user_privileges');;
    Route::post('update-role',[UserPrivilegeController::class,'updaterole'])->name('update-role');
    Route::any('add-admin',[UserPrivilegeController::class,'add'])->name('add-admin');
});


require __DIR__ . '/auth.php';
