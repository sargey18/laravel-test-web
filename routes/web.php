<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;


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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'abouts', 'images'));
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

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);

Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);

Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);

/// For Brand Route 
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);

Route::post('/brand/update/{id}', [BrandController::class, 'Update']);

Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

// multi image route 
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');

Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');


//admin all route 
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

//Home about all Route 
Route::get('/home/About', [AboutController::class, 'HomeAbout'])->name('home.about');

Route::get('/add/About', [AboutController::class, 'AddAbout'])->name('add.about');

Route::post('/store/About', [AboutController::class, 'StoreAbout'])->name('store.about');

Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

//portfolio page route 
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');


//admin contact page route 
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('add.message');




//home contact page route 
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');

Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // look in the models 
    // then we need to compact and pass the users data

    // $users = User::all();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

// change password and user profile route 

Route::get('/user/password', [ChangePass::class, 'CPassword'])->name('change.password');


//User Profile 

Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
