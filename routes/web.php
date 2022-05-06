<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\ProjectController;
use App\Http\Controllers\Auth\EmployeeController;

Route::get('/login',[\App\Http\Controllers\LoginController::class,'getLogin']);

Route::post('/login',[\App\Http\Controllers\LoginController::class,'login'])->name('login-demo');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users',[UserController::class,'users'])->name('users');
Route::get('/add',[UserController::class,'viewAdd'])->name('add');
Route::post('/add1',[UserController::class,'add'])->name('addUser');
Route::get('/edit/{id}',[UserController::class,'viewEdit'])->name('edit');
Route::post('/edit/{id}',[UserController::class,'edit'])->name('editUser');
Route::get('/delete/{id}',[UserController::class,'delete'])->name('delete');
Route::get('/addRole',[UserController::class,'viewAddRole']);
Route::post('/addRole',[UserController::class,'addRole'])->name('addUserHasRole');
Route::get('/userHasRole',[UserController::class,'userHasRole']);
Route::get('/addProject',[UserController::class,'viewAddUserHasProject']);
Route::post('/addProject',[UserController::class,'addProject'])->name('addUserHasProject');
Route::get('/userHasProject',[UserController::class,'userHasProject']);
Route::get('/projects/{id}',[UserController::class,'groupProject']);

Route::get('/roles',[RoleController::class,'roles'])->name('roles');
Route::get('/add',[RoleController::class,'viewAdd']);
Route::post('/add1',[RoleController::class,'add'])->name('addRole');
Route::get('/roles/edit/{id}',[RoleController::class,'viewEdit'])->name('viewEditRole');
Route::post('/roles/edit/{id}',[RoleController::class,'edit'])->name('editRole');
Route::get('/roles/delete/{id}',[RoleController::class,'delete'])->name('delete');


Route::get('/projects',[ProjectController::class,'projects'])->name('projects');
Route::get('/projects/add',[ProjectController::class,'viewAdd'])->name('viewAddProject');
Route::post('/projects/add',[ProjectController::class,'add'])->name('addProject');
Route::get('/projects/edit/{id}',[ProjectController::class,'viewEdit'])->name('viewEditProject');
Route::post('/projects/edit/{id}',[ProjectController::class,'edit'])->name('editProject');
Route::get('/projects/delete/{id}',[ProjectController::class,'delete'])->name('delete');

Route::get('/employee',[EmployeeController::class,'showProfile']);
Route::post('/profile',[EmployeeController::class,'editProfile'])->name('editProfile');
Route::get('/reports/add',[EmployeeController::class,'showFormReport']);
Route::post('/reports/add',[EmployeeController::class,'addReport'])->name('addReport');
Route::get('/reports',[EmployeeController::class,'showReports'])->name('reports');
Route::get('/reports/edit/{id}',[EmployeeController::class,'showEditReport']);
Route::post('/reports/edit/{id}',[EmployeeController::class,'editReport'])->name('editReport');
Route::get('/reports/delete/{id}',[EmployeeController::class,'deleteReport'])->name('deleteReport');

