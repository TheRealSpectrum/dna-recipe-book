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
        ], 
        "Main");
    }
    function store(Request $request)
    {
        $newRecipe = Recipe::create([
            "title" => $request->getParameter("recipe_title"),
            "description" => $request->getParameter("recipe_description"),
            "num_servings" => $request->getParameter("recipe_servings"),
            "preparation_time" => $request->getParameter("recipe_prep_time"),
            "cooking_time" => $request->getParameter("recipe_cooking_time"),
            "author_id" => $request->getParameter("recipe_author"),
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
    function edit($id)
    {
        $recipe = Recipe::query("SELECT * FROM `recipes` WHERE `id` = $id LIMIT 1")[0];
        $recipe_categories = array_map(function($category) {
            return $category->id;
        }, $recipe->categories());
        return View::view("Recipe/EditRecipe", [
            "recipe" => $recipe,
            "authors" => User::query("SELECT * FROM `users`"),
            "categories" => Category::query("SELECT * FROM `categories`"),
            "recipe_categories" => $recipe_categories,
        ], "Main");
    }
    function update(Request $request, $id)
    {
        $toEdit = Recipe::query("SELECT * FROM `recipes` WHERE `id` = $id LIMIT 1")[0];

        $title = $request->getParameter("recipe_title");
        $description = $request->getParameter("recipe_description");
        $num_servings = $request->getParameter("recipe_servings");
        $preparation_time = $request->getParameter("recipe_prep_time");
        $cooking_time = $request->getParameter("recipe_cooking_time");
        $author_id = $request->getParameter("recipe_author");

        if ($title !== null) {
            $toEdit->title = $title;
        }
        if ($description !== null) {
            $toEdit->description = $description;
        }
        if ($num_servings !== null) {
            $toEdit->num_servings = (int)$num_servings;
        }
        if ($preparation_time !== null) {
            $toEdit->preparation_time = (int)$preparation_time;
        }
        if ($cooking_time !== null) {
            $toEdit->cooking_time = (int)$cooking_time;
        }
        if ($title !== null) {
            $toEdit->author_id = (int)$author_id;
        }


        $toEdit->store();

        return new RedirectResponse("/recipes/{$toEdit->id}");
    }
    function destroy()
    {
        return View::view("Recipe/DeleteRecipe", [], "Main");
    }
}
