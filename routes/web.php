<?php

use App\Http\Controllers\ExcerciseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\ScheduleController;
use App\Models\Excercise;

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
    return view('welcome');
});

Route::get('/view-roles', [HomeController::class, 'index']);

Route::get('/user-page', [UserPageController::class, 'index']);

Route::get('/course', [StudentCourseController::class, 'index']);
Route::get('/excercise',[ExcerciseController::class, 'index']);
// Route::get('/createExcercise', [StudentCourseController::class, 'createExcercise']);

Route::get('studentcourses/{id}/edit-task', [StudentCourseController::class, 'editTask'])->name('studentcourses.edit-task');
Route::put('studentcourses/{id}/update-task', [StudentCourseController::class, 'updateTask'])->name('studentcourses.update-task');
Route::get('studentcourses/{id}/mark-task', [StudentCourseController::class, 'markTask'])->name('studentcourses.mark-task');
Route::put('studentcourses/{id}/save-mark', [StudentCourseController::class, 'saveMark'])->name('studentcourses.save-mark');




// Route::get('schedules', [ScheduleController::class, 'index']);
Route::resource('schedules',ScheduleController::class);
Route::resource('studentcourses',StudentCourseController::class)->middleware('auth');

// Маршрут для отображения формы редактирования ресурса
// Route::get('studentcourses/{id}/edit-task', 'StudentCourseController@editTask')->name('studentcourses.edit-task');
// Route::name('studentcourses.edit-task')->get('studentcourses/{id}/edit-task', 'StudentCourseController@editTask');


// Маршрут для обновления ресурса
// Route::put('studentcourses/{id}', 'StudentCourseController@updateTask')->name('studentcourses.update-task');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
