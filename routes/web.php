<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\StudentController::class, 'index'])->name('welcome');
Route::get('students/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
Route::post('students/store', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
Route::get('students/edit/{student}', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
Route::PUT('students/update/{student}', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
Route::get('search', [App\Http\Controllers\StudentController::class, 'search'])->name('student.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

