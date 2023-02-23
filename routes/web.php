<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Recipe;
use Illuminate\Support\Facades\Request;


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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    
    return Inertia::render('Dashboard', [
        'recipes' => Auth::user()->recipes()->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/recipes', function() {
        return Inertia::render('Recipes', [
            'recipes' => Auth::user()
                            ->recipes()
                            ->when(Request::input('search'), function($query, $search){
                                $query->where('recipe_name', 'like', "%{$search}%");
                            })->paginate(4)
        ]);
    })->name('recipes');

    Route::get('/settings', function() {
        sleep(2);
        return Inertia::render('Settings');
    })->name('settings');
});

require __DIR__.'/auth.php';
