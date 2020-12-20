<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;



//home 
Route::view('/', 'home');
Route::get('/members_data', [MemberController::class,'index'] );

//create
Route::post('/create-user', [MemberController::class,'create_user'] );
//update
Route::get('/edit-form/{id}', [MemberController::class,'edit_form'] );

Route::post('/update-user', [MemberController::class,'update_user'] );

//delete
Route::post('/delete_user/{id}', [MemberController::class,'delete_user'] );

