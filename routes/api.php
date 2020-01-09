<?php

use Illuminate\Http\Request;

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
use App\User ;
use App\Notifications\CongeNotification;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['employer' => 'API\EmployerController']);

Route::apiResources(['conge' => 'API\CongeController']);

Route::apiResources(['RecruitData' => 'RecruitController']);

Route::apiResources(['absences' => 'AbsenceController']);


Route::get('profiles' , 'API\EmployerController@AfficheP');

Route::get('Charts' , 'API\EmployerController@Vuechardata');
Route::get('RecruitData' , 'RecruitController@getdata');
Route::get('finduser' , 'API\EmployerController@search');
Route::put('profiles' , 'API\EmployerController@UpdateProfile');

Route::post('conge' , 'API\CongeController@store' , function(){
    $user = Auth::User();
    $admin = User::where('id' , '=' , '1')->findOrFail() ;
    $admin->notify(new CongeNotification(1));
});
Route::get('conge' , 'API\CongeController@index');
Route::get('ChartsConge' , 'API\CongeController@ChartConge');
Route::get('CongeAccepter' , 'API\CongeController@CongeAccepter');
Route::get('congeAdmin' , 'API\CongeController@indexAdmin');
Route::get('CongeAccepter' , 'API\CongeController@CongeAccepter');
Route::post('modifier' , 'API\CongeController@modif');  


//Route::put('conge' , 'API\CongeController@updateAccept');


Route::post('/Recruit' , 'RecruitController@store');
Route::post('Recruit' , 'RecruitController@updateinsert');
Route::get('RecruitAccepter' , 'RecruitController@RecruitAccepte');
Route::get('RecrutChart' , 'RecruitController@ChartRecruit');



Route::post('/Justifier' , 'AbsenceController@store');
Route::post('/NoNJustifier' , 'AbsenceController@NonJustifier');
Route::get('/ConsultAbsences' , 'AbsenceController@AbsenceJustifier');
Route::get('/update' , 'AbsenceController@update');
Route::get('/stat' , 'AbsenceController@AbsenceNonJustifier') ;
Route::get('/AbsenceJustifier' , 'AbsenceController@AbsenceJustifier') ;


