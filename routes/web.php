<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/main_page', [App\Http\Controllers\PagesController::class, 'main_page'])->name('main_page');


Route::get('/buildings_page', [App\Http\Controllers\PagesController::class, 'buildings_page'])->name('buildings_page');
Route::get('/buildings_table_page',[\App\Http\Controllers\PagesController::class,'buildings_table_page'])->name('buildings_table_page');


Route::get('/resident_main_page', [App\Http\Controllers\PagesController::class, 'resident_main_page'])->name('resident_main_page');
Route::get('/resident_buildings_table_page',[\App\Http\Controllers\PagesController::class,'resident_buildings_table_page'])->name('resident_buildings_table_page');
Route::get('/owner_resident_buildings_table_page',[\App\Http\Controllers\PagesController::class,'owner_resident_buildings_table_page'])->name('owner_resident_buildings_table_page');








Route::get('/buildings_map', [App\Http\Controllers\PagesController::class, 'buildings_map'])->name('buildings_map');

Route::get('building' , [\App\Http\Controllers\BuildindingController::class, 'add_building'])->name('add_building');
Route::get('citizen' , [\App\Http\Controllers\BuildindingController::class, 'add_new_citizen'])->name('add_new_citizen');


//ajax
Route::get('/buildings/delete_one_building',[\App\Http\Controllers\BuildindingController::class,'delete_one_building'])->name('delete_one_building');
Route::get('/buildings/edit_one_building',[\App\Http\Controllers\BuildindingController::class,'edit_one_building'])->name('edit_one_building');

Route::get('/resident/delete_one_resident',[\App\Http\Controllers\BuildindingController::class,'delete_one_resident'])->name('delete_one_resident');
Route::get('/resident/edit_one_resident',[\App\Http\Controllers\BuildindingController::class,'edit_one_resident'])->name('edit_one_resident');


