<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileController as ProfileOfClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


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

Route::prefix('client')->name('client.')->group(function(){
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->middleware(['auth:client', 'verified'])->name('dashboard');

    Route::middleware('auth:client')->group(function () {
        Route::get('/profile', [ProfileOfClientController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfClientController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfClientController::class, 'destroy'])->name('profile.destroy');
    });

    // require __DIR__.'/client.php';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/meeting', [EventController::class, 'main'])->name('main');
Route::get('/meeting/make', function(){
    return view('/meeting/main-make');
});
Route::get('/meeting/{event}/edit', [EventController::class, 'edit']);
Route::get('/meeting/delete', [EventController::class, 'delete']);

Route::get('/meeting/member', [UserController::class, 'member'])->name('member');
Route::get('/meeting/member/make', function(){
    return view('/meeting/member-make');
});
Route::get('/meeting/member/delete', [UserController::class, 'pass']);
Route::get('/meeting/member/tag', [TagController::class, 'tag']);
Route::get('/meeting/member/tag/make', function () {
    return view('/meeting/member-tag-make');
});
Route::get('/meeting/member/tag/enchant', [UserController::class, 'enchant']);
Route::get('/meeting/member/tag/delete', [TagController::class, 'search']);

Route::post('/meeting/delete', [EventController::class, 'checkDelete']);
Route::post('/meeting/delete/check', [EventController::class, 'completeDelete']);
Route::post('/meeting/member/tag', [TagController::class, 'make']);
Route::post('/meeting/member/tag/enchant', [UserController::class, 'saveTag']);
Route::post('/meeting/member/make', [UserController::class, 'make']);
Route::post('/meeting/make', [EventController::class, 'make']);
Route::post('/meeting/make/able', [EventController::class, 'member']);
Route::post('/meeting/make/able/member', [EventController::class, 'saveEvent']);

Route::put('/meeting/{event}/edit', [EventController::class, 'updateAble']);
Route::put('/meeting/{event}/edit/able', [EventCOntroller::class, 'updateMember']);
Route::put('/meeting/{event}/edit/able/member', [EventCOntroller::class, 'update']);

Route::delete('/meeting/member/delete', [UserController::class, 'delete']);
Route::delete('/meeting/member/tag', [TagController::class, 'delete']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
