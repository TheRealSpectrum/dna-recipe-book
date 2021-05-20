<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class CategoryController extends Controller
{
    function index()
    {
        return View::view("Category/Index");
    }
    function create()
    {
        return View::view("Category/CreateCategory");
    }
    function store()
    {
        // 
    }
    function show()
    {
        return View::view("Category/ShowCategory");
    }
    function edit()
    {
        return View::view("Category/EditCategory");
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