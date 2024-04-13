<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//All listings
Route::get('/', [ListingController::class, 'index']);

//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create']);

//Show Create Form
Route::post('/listings', [ListingController::class, 'store']);

//Single listing -> this route must be at the bottom because of the
//wildcard {{listing}}
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Common Resource Routes:
// index - Show all listings
// show - Show single listing
//create - Show form to create new listing
//store -cStore new listing
//edit - Show form to edit listing
//update -Update listing
//destroy - Delete listing