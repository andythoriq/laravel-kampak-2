<?php

use App\Http\Controllers\DefaultPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterClassControl;
use App\Http\Controllers\MasterStudentControl;
use App\Http\Controllers\MasterSubjectControl;
use App\Http\Controllers\MasterTeacherControl;
use App\Http\Controllers\SiswaNilaiControl;
use App\Http\Controllers\TrxMengajarControl;
use App\Http\Controllers\TrxNilaiControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;

Route::middleware('admin')->group(function () {
    Route::controller(MasterTeacherControl::class)->prefix('/teacher')->group(function () {
        Route::get('/', 'index')->name('teachers.index');
        Route::get('/create', 'create')->name('teachers.create');
        Route::post('/store', 'store')->name('teachers.store');
        Route::get('/edit/{teacher}', 'edit')->name('teachers.edit');
        Route::put('/update/{teacher}', 'update')->name('teachers.update');
        Route::delete('/delete/{teacher}', 'delete')->name('teachers.destroy');
    });

    Route::controller(MasterClassControl::class)->prefix('/class')->group(function () {
        Route::get('/', 'index')->name('classes.index');
        Route::get('/create', 'create')->name('classes.create');
        Route::post('/store', 'store')->name('classes.store');
        Route::get('/edit/{class}', 'edit')->name('classes.edit');
        Route::put('/update/{class}', 'update')->name('classes.update');
        Route::delete('/delete/{class}', 'delete')->name('classes.destroy');
    });

    Route::controller(MasterStudentControl::class)->prefix('/student')->group(function () {
        Route::get('/', 'index')->name('students.index');
        Route::get('/create', 'create')->name('students.create');
        Route::post('/store', 'store')->name('students.store');
        Route::get('/edit/{student}', 'edit')->name('students.edit');
        Route::put('/update/{student}', 'update')->name('students.update');
        Route::delete('/delete/{student}', 'delete')->name('students.destroy');
    });

    Route::controller(MasterSubjectControl::class)->prefix('/subject')->group(function () {
        Route::get('/', 'index')->name('subjects.index');
        Route::get('/create', 'create')->name('subjects.create');
        Route::post('/store', 'store')->name('subjects.store');
        Route::get('/edit/{subject}', 'edit')->name('subjects.edit');
        Route::put('/update/{subject}', 'update')->name('subjects.update');
        Route::delete('/delete/{subject}', 'delete')->name('subjects.destroy');
    });

    Route::controller(TrxMengajarControl::class)->prefix('/teaching')->group(function () {
        Route::get('/teaching', 'index')->name('teachings.index');
        Route::get('/create', 'create')->name('teachings.create');
        Route::post('/store', 'store')->name('teachings.store');
        Route::get('/edit/{teaching}', 'edit')->name('teachings.edit');
        Route::put('/update/{teaching}', 'update')->name('teachings.update');
        Route::delete('/delete/{teaching}', 'delete')->name('teachings.destroy');
    });
});

Route::middleware('teacher')->controller(TrxNilaiControl::class)->group(function () {
    Route::prefix('/point/{format}')->group(function () {
        Route::get('/create', 'create')->name('points.create');
        Route::post('/store', 'store')->name('points.store');
        Route::get('/edit/{point}', 'edit')->name('points.edit');
        Route::put('/update/{point}', 'update')->name('points.update');
        Route::delete('/delete/{point}', 'delete')->name('points.destroy');
    });
    Route::get('/kelas', 'index')->name('points.index');
    Route::get('/kelas/{format}', 'show_kelas')->name('points.class');
});

Route::middleware('student')->group(function () {
    Route::get('/nilai', SiswaNilaiControl::class)->name('nilai');
});

Route::controller(LoginController::class)->prefix('/login')->group(function () {
    Route::post('/admin', 'login_admin')->name('login.admin');
    Route::post('/student', 'login_student')->name('login.student');
    Route::post('/teacher', 'login_teacher')->name('login.teacher');
});

Route::get('/home', HomeController::class)->name('home');

Route::get('/logout', LogoutController::class)->name('logout');

Route::get('/', DefaultPageController::class)->name('default');
