<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    //Show all ingredients
    public function index()
    {
        $ingredient = Ingredient::all()->toArray();
        return array_reverse($ingredient);      
    }

    //Store new Ingredients
    public function store(Request $request)
    {
        $ingredient = new Ingredient([
            'ingredient_name' => $request->input('ingredient_name'),
            'ingredient_description' => $request->input('ingredient_description'),
            'ingredient_type' => $request->input('ingredient_type')
        ]);
        $ingredient->save();
        return response()->json('Ingredient created!');
    }

    //Show an individual Ingredient
    public function show($id)
    {
        $ingredient = Ingredient::find($id);
        return response()->json($ingredient);
    }

    //Update an ingredient
    public function update($id, Request $request)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->update($request->all());
        return response()->json('Ingredient updated!');
    }

    //Delete an ingredient
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        return response()->json('Ingredient deleted!');
    }
}
