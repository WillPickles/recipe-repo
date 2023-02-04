<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_name',
        'recipe_servings',
        'recipe_type',
        'prep_time',
        'cook_time',
        'other_information',
        'description',
        'method'
    ];
}
