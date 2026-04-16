<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::view('/', 'weather');
Route::get('weather',[WeatherController::class,'index'])->name('weather.index');
Route::post('weathersearch',[WeatherController::class,'store'])->name('weather.search');
