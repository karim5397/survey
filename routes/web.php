<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\QuestionController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\auth\RegisterController;
use App\Http\Controllers\backend\QuestionnaireController;
use App\Http\Controllers\backend\auth\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'backend-admin','middleware'=>'guest','as'=>'admin.'],function(){
    Route::get('login',[AuthenticationController::class,'loginForm'])->name('login.form');
    Route::post('login',[AuthenticationController::class,'login'])->name('login');
    Route::get('register',[RegisterController::class,'registerForm'])->name('register.form');
    Route::post('register',[RegisterController::class,'register'])->name('register');

});


Route::group(['prefix'=>'backend-admin','as'=>'admin.','middleware'=>['auth']],function(){
    Route::get('logout',[AuthenticationController::class,'logout'])->name('logout');
    // //role route
    Route::resource('questionnaire', QuestionnaireController::class);
    Route::post('questionnaire/change/status',[QuestionnaireController::class,'status'])->name('questionnaire.status');

    Route::get('question/add/{questionnaire_id}',[QuestionController::class,'index'])->name('question.index');
    Route::post('question/store',[QuestionController::class,'store'])->name('question.store');
    Route::get('question/delete/{id}' , [QuestionController::class , 'destroy'])->name('question.destroy');

});