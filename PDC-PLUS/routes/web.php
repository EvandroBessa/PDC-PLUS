<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/','hlogin');

use App\Http\Controllers\RegistroController;

Route::get('/registro', [RegistroController::class, 'index']);
// Route::post('/registro', [RegistroController::class, 'create']);
Route::post('/registro', [RegistroController::class, 'store']);
    


// Route::get('/registro', function () {
//     return view('registro');
// });

Route::get('/', function () {
    return view('login');
});


