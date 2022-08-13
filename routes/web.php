<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee', function () {
    return view('employeelist');
})->name('employeelist');

Route::get('/register',
    [AdminController::class, 'CreateEmployeePage']
)->name('register_employee');

Route::post('/add-user',
    [AdminController::class, 'addEmployee']
)->name('add_employee');
