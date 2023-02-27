<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\joinTableController;

Route::get('/',[PostController::class,'home'])->name('post#home');
Route::post('post/create',[PostController::class,'create'])->name('post#create');
Route::get('post/delete/{id}',[PostController::class,'delete'])->name('post#delete');
Route::get('post/read/{id}',[PostController::class,'read'])->name('post#read');
Route::get('post/edit/{id}',[PostController::class,'edit'])->name('post#edit');
Route::post('post/update/{id}',[PostController::class,'update'])->name('post#update');

Route::get('joinTable',[joinTableController::class,'joinTable'])->name('joinTable');
