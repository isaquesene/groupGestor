<?php

use App\Livewire\EconomicGrouplw;
use App\Models\EconomicGroup;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', EconomicGrouplw::class);
