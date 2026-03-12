<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::get('/api/scramble', [\App\Http\Controllers\ScrambleController::class, 'index']);
