<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/', [TaskController::class, 'index'])->name('home');
Route::post('summarize/text', [TaskController::class, 'summarizeText'])->name('summarizeText');
Route::post('summarize/Document', [TaskController::class, 'summarizeDocument'])->name('summarizeDocument');
