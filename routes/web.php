<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TasksController;
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

Route::get('/', function () {
    return view('tasks.index');
})->middleware('auth');


//Route::middleware(['auth', 'role:admin'])->group(function () {
//    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
//});

Route::middleware(['auth', 'role:Admin'])->group(function (){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/dashboard/manage-users',[AdminController::class,'usersList'])->name('admin.users.list');
    Route::get('/dashboard/manage-users/create-user',[AdminController::class,'createUser'])->name('admin.create-user');
    Route::post('/dashboard/manage-users/users',[AdminController::class,'storeUser'])->name('admin.store-user');
    Route::get('/dashboard/manage-users/{user}/edit',[AdminController::class,'editUser'])->name('admin.edit-user');
    Route::put('/dashboard/manage-users/{user}',[AdminController::class,'updateUser'])->name('admin.update-user');
    //   Task Region
    Route::get('/dashboard/manage-tasks',[AdminController::class,'tasksList'])->name('admin.tasks.list');
    Route::get('/dashboard/manage-tasks/create-task',[TasksController::class,'create'])->name('admin.create-task');



});

Route::middleware(['auth', 'role:Manager'])->group(function (){
    Route::get('manager/dashboard',[ManagerController::class,'index'])->name('manager.dashboard');
    Route::get('manager/dashboard/manage-tasks', function () {
        return view('admin.manage_tasks');
    })->name('manager.manage-tasks');
});
Route::resource('tasks', TasksController::class);

Route::post('/tasks/{task}/complete', [TasksController::class, 'completeTask'])->name('tasks.complete');
Route::post('/tasks/{task}/in_progress', [TasksController::class, 'triggerToInProgress'])->name('tasks.in_progress');

## Auth region
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
