<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('api')->group(function () {
    //Recipes
    Route::resource('recipes', RecipeController::class);
    Route::get('/recipes/user/{user}', [RecipeController::class, 'getUserRecipes']);
    Route::get('/recipes/random/{user}/{num}', [RecipeController::class, 'getRandomRecipes']);

    //Ingredients
    Route::resource('ingredients', IngredientController::class);

    //Testing
    Route::get('/test', [RecipeController::class, 'test']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
