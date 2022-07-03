<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/',[StudentController::class, 'index']);
Route::post('/loadtable',[StudentController::class, 'loadtable']);

Route::get('/edit/{id}',[StudentController::class, 'edit']);
Route::post('/add',[StudentController::class, 'store']);
Route::post('/update',[StudentController::class, 'update']);
Route::post('/delete',[StudentController::class, 'delete']);
// Route::get('add','StudentController@store');


// php artisan route:clear