<?php 

declare(strict_types=1);

namespace App\Controllers;

use \App\Core\Controller;
use App\Core\Request;
use App\Core\Response\RedirectResponse;
use App\Models\Ingredient;

class IngredientController extends Controller {
    
    public function store(Request $request) 
    {
        $recipe_id = $request->getParameter("recipe_id");
        $newIngredient = Ingredient::create([
            "name" => $request->getParameter("ingredient_title"),
            "quantity" => $request->getParameter("ingredient_quantity"),
            "recipe_id" => $recipe_id,
        ]);

        $newIngredient->store();

        return new RedirectResponse("/recipes/$recipe_id/edit/");

    }

    public function destroy($id)
    {
        Ingredient::query("DELETE FROM `ingredients` WHERE id = $id");
    }
}