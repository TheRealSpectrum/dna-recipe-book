<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;
use \App\Models\Recipe;

class RecipeController extends Controller
{
    function index()
    {
        return View::view(
            "Recipe/Index",
            [
                "recipes" =>
                Recipe::query("SELECT * FROM `recipes`")
            ],
            "Main"
        );
    }
    function create()
    {
        return View::view("Recipe/CreateRecipe", [], "Main");
    }
    function store()
    {
        // return View::view("Recipes");
    }
    function show()
    {
        return View::view("Recipe/ShowRecipe", [], "Main");
    }
    function edit()
    {
        return View::view("Recipe/EditRecipe", [], "Main");
    }
    function update()
    {
        // return View::view("Recipes");
    }
    function destroy()
    {
        return View::view("Recipe/DeleteRecipe", [], "Main");
    }
}
