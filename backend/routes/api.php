<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/registrations',[RegistrationController::class,"index"])
->name("registrations.index");