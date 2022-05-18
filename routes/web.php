<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\ProjectController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\ReportController;
use App\Http\Controllers\Auth\StatisticController;

Route::get('/login',[\App\Http\Controllers\LoginController::class,'getLogin']);

Route::post('/login',[\App\Http\Controllers\LoginController::class,'login'])->name('login-demo');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users',[UserController::class,'users'])->name('users');
Route::get('/addUser',[UserController::class,'viewAdd'])->name('viewAddUser');
Route::post('/addUser',[UserController::class,'add'])->name('addUser');
Route::get('/edit/{id}',[UserController::class,'viewEdit'])->name('edit');
Route::post('/edit/{id}',[UserController::class,'edit'])->name('editUser');
Route::get('/delete/{id}',[UserController::class,'delete'])->name('delete');
Route::get('/addRole',[UserController::class,'viewAddRole'])->name('viewAddUserHasRole');
Route::post('/addRole',[UserController::class,'addRole'])->name('addUserHasRole');
Route::get('/userHasRole',[UserController::class,'userHasRole'])->name('userHasRole');
Route::get('/userHasRole/{id}',[UserController::class,'viewEditRole']);
Route::post('/userHasRole/{id}',[UserController::class,'editHasRole'])->name('editHasRole');
Route::get('/userHasRole/delete/{id}',[UserController::class,'deleteHasRole'])->name('deleteHasRole');
Route::get('/addProject',[UserController::class,'viewAddUserHasProject'])->name('viewAddUserHasProject');
Route::post('/addProject',[UserController::class,'addProject'])->name('addUserHasProject');
Route::get('/userHasProject',[UserController::class,'userHasProject']);
Route::get('/projects/{id}',[UserController::class,'groupProject']);
Route::get('/userHasProject/{id}',[UserController::class,'viewEditHasProject']);
Route::post('/userHasProject/{id}',[UserController::class,'editHasProject'])->name('editHasProject');
Route::get('/userHasProject/delete/{id}',[UserController::class,'deleteHasProject'])->name('deleteHasProject');


Route::get('/roles',[RoleController::class,'roles'])->name('roles');
Route::get('/roles/add',[RoleController::class,'viewAdd'])->name('viewAddRole');
Route::post('/roles/add',[RoleController::class,'add'])->name('addRole');
Route::get('/roles/edit/{id}',[RoleController::class,'viewEdit'])->name('viewEditRole');
Route::post('/roles/edit/{id}',[RoleController::class,'edit'])->name('editRole');
Route::get('/roles/delete/{id}',[RoleController::class,'delete'])->name('deleteRole');

Route::get('/projects',[ProjectController::class,'projects'])->name('projects');
Route::get('/add_project',[ProjectController::class,'viewAdd'])->name('viewAddProject');
Route::post('/projects/add',[ProjectController::class,'add'])->name('addProject');
Route::get('/projects/edit/{id}',[ProjectController::class,'viewEdit'])->name('viewEditProject');
Route::post('/projects/edit/{id}',[ProjectController::class,'edit'])->name('editProject');
Route::get('/projects/delete/{id}',[ProjectController::class,'delete'])->name('deleteProject');

Route::get('/employee',[EmployeeController::class,'showProfile'])->name('showProfile');
Route::post('/profile',[EmployeeController::class,'editProfile'])->name('editProfile');
Route::get('/employee/reports/add',[EmployeeController::class,'showFormReport'])->name('showFormAddReport');
Route::post('/employee/reports/add',[EmployeeController::class,'addReport'])->name('addReport');
Route::get('/employee_report',[EmployeeController::class,'showReports'])->name('reportsEmployee');
Route::get('/reports/edit/{id}',[EmployeeController::class,'showEditReport'])->name('showFormEditReport');
Route::post('/reports/edit/{id}',[EmployeeController::class,'editReport'])->name('editReport');
Route::get('/reports/delete/{id}',[EmployeeController::class,'deleteReport'])->name('deleteReport');

Route::get('/reports',[ReportController::class,'index'])->name('reports');
Route::get('/reports/{id}',[ReportController::class,'edit'])->name('acceptReport');

Route::get('/home',[StatisticController::class,'StatisticProject'])->name('statistic');
