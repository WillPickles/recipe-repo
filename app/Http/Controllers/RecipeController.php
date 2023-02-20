<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\User;
use App\Models\DB;

class RecipeController extends Controller
{
    //Recipe index
    public function index()
    {
        $recipe = Recipe::all()->toArray();
        return array_reverse($recipe);      
    }

    //Store a new recipe
    public function store(Request $request)
    {
        $recipe = new Recipe([
            'recipe_name' => $request->input('recipe_name'),
            'description' => $request->input('description'),
            'recipe_servings' => $request->input('recipe_servings'),
            'recipe_type' => $request->input('recipe_type'),
            'prep_time' => $request->input('prep_time'),
            'cook_time' => $request->input('cook_time'),
            'other_information' => $request->input('other_information'),
            'method' => $request->input('method')
        ]);
        $recipe->save();
        return response()->json('Recipe created!');
    }

    //Show a specific recipe
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return response()->json($recipe);
    }

    //Update a recipe
    public function update($id, Request $request)
    {
        $recipe = Recipe::find($id);
        $recipe->update($request->all());
        return response()->json('Recipe updated!');
    }

    //Delete a recipe
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        return response()->json('recipe deleted!');
    }

    //Get Recipes for specific user
    public function getUserRecipes($userId)
    {
        $user = User::findOrFail($userId);

        $recipes = $user->recipes()->get();

        return response()->json($recipes);
    }

    //Get X numbers of random recipes
    public function getRandomRecipes($user, $num)
    {
        //Check number specified is less than the number of array entries
        $user = User::findOrFail($user);

        $recipeList = $user->recipes()->get()->toArray();

        
        if (count($recipeList) < $num){
            return response()->json('Not enough recipes');
        } else {
            $recipe_key = array_rand($recipeList, $num);
            $recipes = [];
            foreach ($recipe_key as $recipe){
                $newRecipe = $recipeList[$recipe];
                array_push($recipes, $newRecipe);
            };
            return response()->json($recipes);
        }
        
        
    }

    public function test(Request $request)
    {
        $recipes = Recipe::paginate(10);
        return response()->json($recipes);
    }
}
