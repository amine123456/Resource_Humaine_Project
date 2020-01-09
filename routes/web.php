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
use App\Recruit;
use App\User ;
use App\Notifications\CongeNotification;
use App\Notifications\RecrutementNotification;
use Illuminate\Http\Request;

Route::get('/', function () { 
    return view('welcome');
   
});


// Route::get('/ff', function () {
//     $ps = event(new Conge);
//     return $ps;
// });


// Route::get('/test', function () {
//     return Auth::user()->test();
// });




Auth::routes();
Route::get('Recruit' , 'RecruitController@store');
Route::post('/Recruit' , 'RecruitController@store' );
Route::put('/CompleteRecruit' , 'RecruitController@completestore' );
Route::get('/EmployerLogin' , function(){
        return view('auth.login1');
});




Route::get('/noti' , function(){       
    $user = Auth::User();
    User::findOrFail(1)->notify(new CongeNotification($user));

 foreach(Auth::User()->notifications as $notification){
     echo $notification;
 }
});
Route::get('/home', 'HomeController@index')->name('home');
// Route::post('/profile/store' , 'ProfileController@store');

//Route::resource('DemandeConge', 'ConController');


// Route::get('DemandeConge', 'API\CongeController@index');
//Route::get('conge', 'API\CongeController@index');




//Route::get('{path}','HomeController@index')->where('path', '([A-z\d-\/_.]+)?');


