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
                "recipes" => Recipe::query("SELECT * FROM `recipes`")
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
    function show($id)
    {
        return View::view(
            "Recipe/ShowRecipe",
            [
                "recipe" => Recipe::query("SELECT * FROM `recipes` WHERE `id` = $id LIMIT 1")[0]
            ],
            "Main"
        );
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
