<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class RecipesController extends Controller
{
    function index()
    {
        return View::view("Layout");
    }
    function create()
    {
        return View::view("CreateRecipe");
    }
    function store()
    {
        // return View::view("Recipes");
    }
    function show()
    {
        return View::view("ShowRecipe");
    }
    function edit()
    {
        return View::view("EditRecipe");
    }
    function update()
    {
        // return View::view("Recipes");
    }
    function destroy()
    {
        return View::view("DeleteRecipe");
    }
}