<?php

use App\Http\Controllers\langController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

// Route::get('/{locale}', function ($locale) {
//     App::setlocale($locale);
//     return view('welcome');
// });
// Route::get('/{$locale}',)
Route::get('/',function(){
    return view('welcome');
});

Route::get('/student',[StudentController::class,'index'])->name('student.index');
Route::post('/add-student',[StudentController::class,'addStudent'])->name('student.add');
Route::get('/student/{id}',[StudentController::class,'getStudentById']);
Route::put('/student',[StudentController::class,'updateStudent'])->name('student.update');
Route::delete('/student/{id}',[StudentController::class,'deleteStudent'])->name('student.delete');
Route::delete('/selected-student',[StudentController::class,'deleteCheckedStudents'])->name('student.deleteSelected');

/// Multi language

Route::get('/lang-change',[langController::class,'langChange'])->name('lang.change');