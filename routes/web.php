<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\Api\UserController;
use App\Http\Controllers\Auth\Api\RoleController;
use App\Http\Controllers\Auth\Api\ProjectController;
use App\Http\Controllers\Auth\Api\AuthController;
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

//Route::get('/', [StaterkitController::class, 'home'])->name('home');
//Route::get('home', [StaterkitController::class, 'home'])->name('home');
//// Route Components
//Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
//Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
//Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
//Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
//Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');
//
//
//// locale Route
//Route::get('lang/{locale}', [LanguageController::class, 'swap']);
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//
//
//
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
//$this->post('login', 'Auth\LoginController@login');
//$this->post('logout', 'Auth\LoginController@logout')->name('logout');
//
//// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
//
//// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset');
