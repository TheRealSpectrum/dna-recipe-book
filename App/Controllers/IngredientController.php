<?php 

namespace App\Controllers;

use \App\Core\Controller;
use App\Core\Request;
use App\Core\Response\RedirectResponse;
use App\Models\Ingredient;

class IngredientController extends Controller {
    
    public function store(Request $request) 
    {
        $newIngredient = Ingredient::create([
            "name" => $request->getParameter("ingredient_title"),
            "quantity" => $request->getParameter("ingredient_quantity"),
            "recipe_id" => 
        ]);

        $newIngredient->store();

    }

    public function destroy($id)
    {
        Ingredient::query("DELETE FROM `ingredients` WHERE id = $id");
    }
}