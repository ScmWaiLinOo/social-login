<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| Google Login URL
|--------------------------------------------------------------------------
 */
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);


/*
|--------------------------------------------------------------------------
| facebook Login URL
|--------------------------------------------------------------------------
 */
Route::get('auth/github', [GithubController::class, 'redirectToGithub'])->name('auth.github');
Route::get('auth/github/callback', [GithubController::class, 'handleGithubCallback']);
