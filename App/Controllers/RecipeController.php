<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\Request;
use \App\Core\Response\RedirectResponse;
use \App\Core\View;
use \App\Models\Recipe;
use \App\Models\User;
use \App\Models\Category;

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
        return View::view("Recipe/CreateRecipe", [
            "authors" => User::query("SELECT * FROM `users`"),
            "categories" => Category::query("SELECT * FROM `categories`"),
        ], "Main");
    }
    function store(Request $request)
    {
        $newRecipe = Recipe::create([
            "title" => $request->getParameter("recipe_title"),
            "description" => $request->getParameter("recipe_description"),
            "numServings" => $request->getParameter("recipe_servings"),
            "categories" => $request->getParameter("recipe_categories"),
            "preparationTime" => $request->getParameter("recipe_servings"),
            "cookingTime" => $request->getParameter("recipe_cooking_time"),
            "author" => $request->getParameter("recipe_author"),
        ]);

        $newRecipe->store();

        return new RedirectResponse("/recipes");
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
