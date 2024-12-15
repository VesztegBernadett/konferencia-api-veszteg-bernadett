<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/registrations',[RegistrationController::class,"index"])
->name("registrations.index");
Route::get('/registrations/{id}',[RegistrationController::class,"show"])
->name("registrations.show")->whereNumber("id");
Route::delete('/registrations/{id}',[RegistrationController::class,"destroy"])
->name("registrations.destroy")->whereNumber("id");
Route::get('/registrations/count',[RegistrationController::class,"count"])
->name("registrations.count");