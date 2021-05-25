<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class CategoryController extends Controller
{
    function index()
    {
        return View::view("Category/Index", [], "Main");
    }
    function create()
    {
        return View::view("Category/CreateCategory", [], "Main");
    }
    function store()
    {
        // 
    }
    function show()
    {
        return View::view("Category/ShowCategory", [], "Main");
    }
    function edit()
    {
        return View::view("Category/EditCategory", [], "Main");
    }
    function update()
    {
        // 
    }
    function destroy()
    {
        //
    }
}
