<?php

use App\Http\Controllers\Admin\ChurchLeaderController;
use Illuminate\Support\Facades\Route;

Route::get('/church-leaders', [ChurchLeaderController::class, 'index']);
