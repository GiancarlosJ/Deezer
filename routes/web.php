<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/album/{id}', function ($id) {
    $response = Http::get('https://api.deezer.com/album/' . $id);
    return $response->json();
});

Route::get('/artist/{id}', function ($id) {
    $response = Http::get('https://api.deezer.com/artist/' . $id);
    return $response->json();
});


Route::get('/search', function () {
    $keyword = request('q');
    $response = Http::get('https://api.deezer.com/search?q=' . $keyword);
    return $response->json();
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    // Esta página solo será accesible para usuarios autenticados.
    return view('dashboard');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
