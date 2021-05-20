<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class RecipesController extends Controller
{
    function index()
    {
        return View::view("Recipes/Recipes");
    }
    function create()
    {
        return View::view("Recipes/CreateRecipe");
    }
    function store()
    {
        // return View::view("Recipes");
    }
    function show()
    {
        return View::view("Recipes/ShowRecipe");
    }
    function edit()
    {
        return View::view("Recipes/EditRecipe");
    }
    function update()
    {
        // return View::view("Recipes");
    }
    function destroy()
    {
        return View::view("Recipes/DeleteRecipe");
    }
}