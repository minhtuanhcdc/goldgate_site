<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InputInfoController;
//use App\Http\Controllers\Admin\InputResultController;
//use App\Http\Controllers\Admin\ResultController;
//use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\InfoLaboController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\Postcontroller;
use App\Http\Controllers\Admin\UpdateCustommerController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\ReportController;
//use App\Http\Controllers\Admin\ImagethinController;

use App\Http\Controllers\Admin\CheckCodeController;
use App\Http\Controllers\Admin\ExportexcelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/backup', function(){
    Storage::disk('google')->put('example.txt','hello the world');
});
Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');
Route::middleware(['auth', 'verified'])
->prefix('dashboard')
->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('/inputinfo','InputInfoController');
    Route::post('/multidelete','InputInfoController@multidelete')->name('multidelete');
    Route::post('/updatebill','InputInfoController@updatebill')->name('updatebill');
    Route::get('/getOuread','InputInfoController@getOuread')->name('getOuread');

    Route::resource('/eurolab','EurolabController');
    //Route::get('/inputresult',[InputResultController::class,'index'])->name('inputresult');
    Route::get('/infolabo',[InfoLaboController::class,'index'])->name('infolabo');
    //Route::get('/results',[ResultController::class,'index'])->name('results');

    Route::get('/student',[StudentController::class,'index'])->name('student');
    Route::get('/search',[StudentController::class,'search'])->name('search');
    Route::delete('/destroystudent/{student}',[StudentController::class,'destroy'])->name('destroystudent');
    Route::delete('/massdetroy/{students}',[StudentController::class,'massdetroy'])->name('');

    Route::get('/classes',[ClassesController::class,'getClass'])->name('classes');
    Route::get('/post',[PostController::class,'index'])->name('posts');
    Route::get('/show/{id}',[PostController::class,'show'])->name('show');

    Route::resource('/menus','MenuController');
    Route::resource('/chilemenus','ChilemenuController');
    Route::resource('/menupermision','MenuPermisionController');
    Route::resource('/users','UserController');
    Route::put('/useredit','UserController@updateEdit');
    Route::resource('/roles','RoleController');

    Route::resource('/permissions','PermissionController');
    Route::resource('/addresses','AddressController');

    //Route::get('/users',[UserController::class,'index'])->name('users');
    Route::resource('/setting','SettingController');
    Route::post('/setting-about','SettingController@saveAbout')->name('setting.about');
    Route::post('/setting-contact','SettingController@saveContact')->name('setting.contact');

    Route::resource('/categories','CategoriesController');
    Route::resource('/articles','ArticleController');
    Route::resource('/ousents','OusentController');

    Route::resource('/labogroups','LabogroupController');
    Route::resource('/testnames','TestnameController');
    Route::resource('/testelements','TestelementController');
    Route::resource('/testunits','TestunitController');

    Route::resource('/custommers','CustommerController');


    Route::resource('/importProvince','ProvinceController');
    //Route::get('/custommers','CustommerController@index')->name('custommerindex');
    Route::resource('/results','ResultController');
    Route::resource('/doctors','DoctorController');
    Route::get('/formsaigon','FormController@formsaigon')->name('formsaigon');
    Route::get('/formtudu','FormController@formtudu')->name('formtudu');
    Route::get('/formvigor','FormController@formvigor')->name('formvigor');

    Route::get('/print','PrintController@printOne')->name('print');
    Route::get('/printview',[PrintController::class,'showPrint'])->name('printview');


    //Route::post('/updatecustommer',[updateCusBill::class,'updatecustommer'])->name('updatecustommer');
    // Route::post('/importprovince',[ImportController::class,'importProvince'])->name('importprovince');
    Route::post('/importdistrict',[ImportController::class,'importDistrict'])->name('importdistrict');
    Route::post('/importWard',[ImportController::class,'importWard'])->name('importWard');

    Route::post('/importcustommers',[ImportController::class,'importcustommers'])->name('importcustommers');
    Route::post('/importResult',[ImportController::class,'importResult'])->name('importResult');
    Route::post('/importOusent',[ImportController::class,'importOusent'])->name('importOusent');

    Route::post('/importProvince',[ImportController::class,'importProvince'])->name('importProvince');
    Route::post('/importDistrict',[ImportController::class,'importDistrict'])->name('importDistrict');
    Route::post('/importWard',[ImportController::class,'importWard'])->name('importWard');

    Route::resource('/images','UploadImageController');
    Route::post('/imageleft','UploadImageController@store')->name('imageleft');
    Route::post('/imagesright','UploadImageController@storeRight')->name('imagesright');

    Route::get('/imagethins','ImagethinController@index')->name('imagethins');



    Route::resource('/oureads','OureadController');
    Route::resource('/inputhpv','InputHpvController');


    Route::get('/tranbillids',[PDFController::class,'TransBillId'])->name('TransBillId');
    Route::get('/downloadPDF',[PDFController::class,'downloadPDF'])->name('downloadPDF');
    Route::get('/checkcodeoureads',[CheckCodeController::class,'checkcodeouread'])->name('checkcodeoureads');

    Route::get('/printThinprep',[PrintController::class,'printThinprep'])->name('printThinprep');
    Route::get('/printHpv',[PrintController::class,'printHpv'])->name('printHpv');
    Route::get('/printMutiThin',[PrintController::class,'printMutiThin'])->name('printMutiThin');
    Route::get('/printMutiHpv',[PrintController::class,'printMutiHpv'])->name('printMutiHpv');
    Route::get('/printCode',[PrintController::class,'printCode'])->name('printCode');
    Route::get('/printThin',[PrintController::class,'printThin'])->name('printThin');


    Route::get('/exportbill',[ExportexcelController::class,'reportBill'])->name('exportbill');
    Route::get('/exportDS',[ExportexcelController::class,'exportDS'])->name('exportDS');
    Route::get('/exportDsThin',[ExportexcelController::class,'exportDsThin'])->name('exportDsThin');


    Route::get('/hpvexport',[ExportexcelController::class,'hpvexport'])->name('hpvexport');
    Route::get('/ousentexport',[ExportexcelController::class,'ousentexport'])->name('ousentexport');

    Route::get('/reports',[ReportController::class,'Index'])->name('reports');
    Route::get('/reporthpvs',[ReportController::class,'IndexHpv'])->name('reporthpvs');
    Route::get('/reportthinpreps',[ReportController::class,'IndexThinprep'])->name('reportthinpreps');

    Route::delete('/deletelogo/{id}','OusentController@deleteLogo')->name('deletelogo');
    Route::delete('/deleteheader/{id}','OusentController@deleteHeader')->name('deleteheader');
    Route::delete('/deletefooter/{id}','OusentController@deleteFooter')->name('deletefooter');



});