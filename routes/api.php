<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewResourceController;
use App\Http\Controllers\ManageResourceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('resources',ViewResourceController::class)->only(['index','show']);
Route::resource('resources',ManageResourceController::class)->only(['store','update','destroy']);
