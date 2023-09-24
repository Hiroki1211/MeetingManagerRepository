<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileController as ProfileOfClientController;
use App\Http\Controllers\ProfileController as ProfileOfAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ClientController;
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
        dd("aa");
        return view('client.dashboard');
    })->middleware(['auth:client', 'verified'])->name('dashboard');

    Route::middleware('auth:client')->group(function () {
        Route::get('/profile', [ProfileOfClientController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfClientController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfClientController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/client.php';
});


Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/profile', [ProfileOfAdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileOfAdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileOfAdminController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/admin.php';
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/meeting', [EventController::class, 'main'])->name('main');
Route::get('/meeting/make', function(){
    return view('/meeting/main-make');
});
Route::get('/meeting/{event}/edit', [EventController::class, 'edit']);
Route::get('/meeting/{event}/decide', [EventController::class, 'decide']);
Route::get('/meeting/delete', [EventController::class, 'delete']);
Route::get('/meeting/{event}/manual', [EventController::class, 'manualClient']);

Route::get('/meeting/member', [UserController::class, 'member'])->name('member');
Route::get('/meeting/member/make', function(){
    return view('/meeting/member-make');
});
Route::get('/meeting/member/delete', [UserController::class, 'pass']);
Route::get('/meeting/client/member', [ClientController::class, 'member'])->name('client');
Route::get('/meeting/client/member/make', function(){
    return view('/meeting/client-member-make');
});
Route::get('/meeting/client/member/delete', [ClientController::class, 'pass']);
Route::get('/meeting/member/tag', [TagController::class, 'tag']);
Route::get('/meeting/member/tag/make', function () {
    return view('/meeting/member-tag-make');
});
Route::get('/meeting/member/tag/enchant', [UserController::class, 'enchant']);
Route::get('/meeting/member/tag/delete', [TagController::class, 'search']);
Route::get('/meeting/client/member/tag', [TagController::class, 'clientTag']);
Route::get('/meeting/client/member/tag/make', function(){
    return view('/meeting/client-member-tag-make');
});
Route::get('/meeting/client/member/tag/enchant', [ClientController::class, 'enchant']);
Route::get('/meeting/client/member/tag/delete', [TagController::class, 'clientSearch']);

Route::post('/meeting/delete', [EventController::class, 'checkDelete']);
Route::post('/meeting/delete/check', [EventController::class, 'completeDelete']);
Route::post('/meeting/{event}/manual', [EventController::class, 'manualAble']);
Route::post('/meeting/{event}/manual/able', [EventController::class, 'manualSave']);
Route::post('/meeting/{event}/decide', [EventController::class, 'result']);
Route::post('/meeting/member/tag', [TagController::class, 'make']);
Route::post('/meeting/member/tag/enchant', [UserController::class, 'saveTag']);
Route::post('/meeting/member/make', [UserController::class, 'make']);
Route::post('/meeting/client/member/make', [ClientController::class, 'make']);
Route::post('/meeting/client/member/tag', [TagController::class, 'clientMake']);
Route::post('/meeting/client/member/tag/enchant', [ClientController::class, 'saveTag']);
Route::post('/meeting/make', [EventController::class, 'make']);
Route::post('/meeting/make/able', [EventController::class, 'member']);
Route::post('/meeting/make/able/member', [EventController::class, 'saveEvent']);

Route::put('/meeting/{event}/edit', [EventController::class, 'updateAble']);
Route::put('/meeting/{event}/edit/able', [EventCOntroller::class, 'updateMember']);
Route::put('/meeting/{event}/edit/able/member', [EventCOntroller::class, 'update']);

Route::delete('/meeting/member/delete', [UserController::class, 'delete']);
Route::delete('/meeting/member/tag', [TagController::class, 'delete']);
Route::delete('/meeting/client/member/delete', [ClientController::class, 'delete']);
Route::delete('/meeting/client/member/tag', [TagController::class, 'clientDelete']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
