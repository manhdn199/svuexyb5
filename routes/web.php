<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\ProjectController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\ReportController;
use App\Http\Controllers\Auth\StatisticController;

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'getLogin']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login-demo');

Auth::routes(['verify'=> true]);

Route::middleware('checkLogin')->group(function (){
    Route::middleware('verified')->group(function (){
        Route::get('/Profile', [EmployeeController::class, 'showProfile'])->name('showProfile');

        Route::get('/home', [StatisticController::class, 'StatisticProject'])->name('statistic');
        Route::post('/profile', [EmployeeController::class, 'editProfile'])->name('editProfile');
// Permission User
        Route::middleware('PerUser')->group(function (){
            Route::prefix('users')->group(function () {
                Route::get('/', [UserController::class, 'users'])->name('users');
                Route::get('/addUser', [UserController::class, 'viewAdd'])->name('viewAddUser');
                Route::post('/addUser1', [UserController::class, 'add'])->name('addUser');
                Route::get('/edit/{id}', [UserController::class, 'viewEdit'])->name('edit');
                Route::post('/edit/{id}', [UserController::class, 'edit'])->name('editUser');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
            });
        });
// Permission Project
        Route::middleware('PerProject')->group(function () {
            Route::prefix('projects')->group(function () {
                Route::get('/', [ProjectController::class, 'projects'])->name('projects');
                Route::get('/add', [ProjectController::class, 'viewAdd'])->name('viewAddProject');
                Route::post('/add', [ProjectController::class, 'add'])->name('addProject');
                Route::get('/edit/{id}', [ProjectController::class, 'viewEdit'])->name('viewEditProject');
                Route::post('/edit/{id}', [ProjectController::class, 'edit'])->name('editProject');
                Route::get('/delete/{id}', [ProjectController::class, 'delete'])->name('deleteProject');
            });
        });
// Permission Role
        Route::middleware('loginByAdmin')->group(function () {
            Route::prefix('roles')->group(function () {
                Route::get('/', [RoleController::class, 'roles'])->name('roles');
                Route::get('/add', [RoleController::class, 'viewAdd'])->name('viewAddRole');
                Route::post('/add', [RoleController::class, 'add'])->name('addRole');
                Route::get('/edit/{id}', [RoleController::class, 'viewEdit'])->name('viewEditRole');
                Route::post('/edit/{id}', [RoleController::class, 'edit'])->name('editRole');
                Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('deleteRole');
            });
        });
// Permission User has Role
        Route::middleware('PerUserHasRole')->group(function () {
            Route::get('/addRole', [UserController::class, 'viewAddRole'])->name('viewAddUserHasRole');
            Route::post('/addRole', [UserController::class, 'addRole'])->name('addUserHasRole');
            Route::get('/userHasRole', [UserController::class, 'userHasRole'])->name('userHasRole');
            Route::get('/userHasRole/{id}', [UserController::class, 'viewEditRole']);
            Route::post('/userHasRole/{id}', [UserController::class, 'editHasRole'])->name('editHasRole');
            Route::get('/userHasRole/delete/{id}', [UserController::class, 'deleteHasRole'])->name('deleteHasRole');
        });
// Permission User has Project
        Route::middleware('PerUserHasProject')->group(function () {
            Route::get('/addProject', [UserController::class, 'viewAddUserHasProject'])->name('viewAddUserHasProject');
            Route::post('/addProject', [UserController::class, 'addProject'])->name('addUserHasProject');
            Route::get('/userHasProject', [UserController::class, 'userHasProject'])->name('userHasProject');
            Route::get('/projects/{id}', [UserController::class, 'groupProject']);
            Route::get('/userHasProject/{id}', [UserController::class, 'viewEditHasProject']);
            Route::post('/userHasProject/{id}', [UserController::class, 'editHasProject'])->name('editHasProject');
            Route::get('/userHasProject/delete/{id}', [UserController::class, 'deleteHasProject'])->name('deleteHasProject');
        });
// Permission Reports
        Route::middleware('PerReports')->group(function () {
            Route::get('/reports', [ReportController::class, 'index'])->name('reports');
            Route::get('/reports/{id}', [ReportController::class, 'edit'])->name('acceptReport');
        });
// Permission employee
        Route::middleware('loginByMember')->group(function () {
            Route::prefix('employee')->group(function () {
                Route::get('/reports/add', [EmployeeController::class, 'showFormReport'])->name('showFormAddReport');
                Route::post('/reports/add', [EmployeeController::class, 'addReport'])->name('addReport');
                Route::get('/employee_report', [EmployeeController::class, 'showReports'])->name('reportsEmployee');
                Route::get('/reports/edit/{id}', [EmployeeController::class, 'showEditReport'])->name('showFormEditReport');
                Route::post('/reports/edit/{id}', [EmployeeController::class, 'editReport'])->name('editReport');
                Route::get('/reports/delete/{id}', [EmployeeController::class, 'deleteReport'])->name('deleteReport');
            });
        });
    });

});
