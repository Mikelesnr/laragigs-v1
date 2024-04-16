<?php

use App\Http\Controllers\UserController;
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
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//Show Create Form
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth')->middleware('auth');

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//update -Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//delete -Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Single listing -> this route must be at the bottom because of the
//wildcard {{listing}}
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//show register create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create User 
Route::post('/users', [UserController::class, 'store']);

//log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login form
Route::post('/users/authenticate', [UserController::class, 'authenticate']);


//Common Resource Routes:
// index - Show all listings
// show - Show single listing
//create - Show form to create new listing
//store -cStore new listing
//edit - Show form to edit listing
//update -Update listing
//destroy - Delete listing