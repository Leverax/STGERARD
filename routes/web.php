<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SchoolingController;
use App\Http\Controllers\SchoolingDetailsController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UserController;
use App\Models\SchoolingDetails;
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
// Route for redirect to login page
Route::get('/', function () { return redirect()->route('login.index');});
// Route for show login page
Route::get('/connexion' , [AuthController::class, 'index'])->name('login.index');
// Route for show or not the field to confirm password
Route::get('/verifier/utilisateur/{email}' , [AuthController::class , 'recover_user'])->name('recover_user.email');
// Route for login
Route::post('/connexion' , [AuthController::class, 'login'])->name('login');

// Routes after login 
Route::group(['middleware' => ['auth']] , function(){
    
    // Route for show dashbord
    Route::get('/tableau-de-bord', [HomeController::class, 'index'])->name('home');
    // Route for logout
    Route::get('/deconnexion' , [AuthController::class , 'logout'])->name('logout');

    // Routes for classroom 
    Route::resource('classroom', ClassroomController::class)->except(['show']);
    Route::get('/rechercher/classe/{academic_year_id}/{student_id}' , [ClassroomController::class , 'getClassroom'])->name('classroom.getClassroom');

    // Routes for student 
    Route::resource('student', StudentsController::class)->except(['show']);
    Route::get('/rechercher/apprenant/{academic_year_id}' , [StudentsController::class , 'getStudent'])->name('student.getStudent');

    // Routes for schooling 
    Route::resource('schooling', SchoolingController::class)->except(['show']);
    Route::get('/schooling/generate/invoice', [SchoolingController::class, 'generate_invoice'])->name('schooling.generate_invoice');
    Route::get('/obtenir/rest/{student_id}/{academic_year_id}/{classroom_id}' , [SchoolingController::class, 'get_rest'])->name('schooling.get_rest');

    // Route for schooling details
    Route::resource('schooling_details' , SchoolingDetailsController::class)->except(['show']);
    Route::get('/obtenir/details/{id}' , [SchoolingDetailsController::class , 'index'])->name('schooling_details.index');
    Route::get('/suppression/details/{id}' , [SchoolingDetailsController::class , 'remove'])->name('schooling_details.remove');
    Route::get('/generation/details/{id}' , [SchoolingDetailsController::class , 'generate'])->name('schooling_details.generate');
    Route::get('/telecharger/details/{id}' , [SchoolingDetailsController::class , 'download'])->name('schooling_details.download');
   
    // Routes for recipe 
    Route::resource('recipe', RecipeController::class)->except(['show']);

    // Routes for expense 
    Route::resource('expense', ExpenseController::class)->except(['show']);

    //Route for export
    Route::get('/export/excel/{start_date}/{end_date}' , [SchoolingController::class , 'export_excel'])->name('export.excel');
    Route::get('/export/sort/excel/{academic_year}/{classroom}' , [SchoolingController::class , 'export_sort_excel'])->name('export.sort_excel');

    // Routes for only user ------------------------------------------------------------
    Route::group(['middleware' => ['user']], function(){
        
    });

    //Routes for only admin ------------------------------------------------------------
    Route::group(['middleware' => ['admin']], function(){

        // Routes for user 
        Route::resource('utilisateur', UserController::class)->except(['show']);
        Route::get('/utilisateur/{id}' , [UserController::class, 'state'])->name('utilisateur.state');

        // Routes for student 
        Route::resource('academic_year', AcademicYearController::class)->except(['show']);
        Route::get('/academic_year/{id}' , [AcademicYearController::class, 'state'])->name('academic_year.state');

        // Routes for state
        Route::get('/etat' , [StateController::class , 'index'])->name('etat.index');
        Route::get('/etat/{year_id}' , [StateController::class , 'search'])->name('etat.search');
    });

});
