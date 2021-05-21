<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class RecipeController extends Controller
{
    function index()
    {
        return View::view("Recipe/Index");
    }
    function create()
    {
        return View::view("Recipe/CreateRecipe");
    }
    function store()
    {
        // return View::view("Recipes");
    }
    function show()
    {
        return View::view("Recipe/ShowRecipe");
    }
    function edit()
    {
        return View::view("Recipe/EditRecipe");
    }
    function update()
    {
        // return View::view("Recipes");
    }
    function destroy()
    {
        return View::view("Recipe/DeleteRecipe");
    }
}