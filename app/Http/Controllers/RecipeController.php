<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;

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
}
