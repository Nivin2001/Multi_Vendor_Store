<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use ILLuminate\Support\Facades\Route;

Route::group([
    'middleware'=>['auth'],
    'as' =>'dashboard.', // name for route
    'prefix' =>'dashboard', // the start of the route


],function(){

Route::get('/dash',function() {
    return view('dashboard');
});

Route::get('/', [DashboardController::class,'index'])

->name('dashboard');

Route::resource('/categories',CategoriesController::class);
});



?>
