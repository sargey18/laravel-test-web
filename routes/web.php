<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;

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

//route method = get 
// / = home directory
// then the function

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});//->middleware('check');
//we name the directory and the the name of the controller then the 
// index method we have to create in the controller 
// this is the laravel 7 format 
//Route::get('/contact', 'ContactController@index');


//this is laravel 8
Route::get('/contact', [ContactController::class, 'index'])->name('ariyan');

//category Controller 
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // look in the models 
    // then we need to compact and pass the users data

    $users = User::all();
    return view('dashboard', compact('users'));
})->name('dashboard');
