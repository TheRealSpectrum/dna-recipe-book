<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;
use \App\Core\Request;
use \App\Core\Response\RedirectResponse;

use \App\Models\Category;

class CategoryController extends Controller
{
    function index()
    {
        return View::view("Category/Index", [
            "categories" => Category::query("SELECT * FROM `categories`"),
        ], "Main");
    }

    function create()
    {
        return View::view("Category/CreateCategory", [], "Main");
    }

    function store(Request $request)
    {
        $newCategory = Category::create([
            "title" => $request->getParameter("title"),
            "description" => $request->getParameter("description"),
        ]);

        $newCategory->store();

        return new RedirectResponse("/categories");
    }

    function show($id)
    {
        return View::view("Category/ShowCategory", [
            "category" => Category::query("SELECT * FROM `categories` WHERE `id` = $id LIMIT 1")[0],
        ], "Main");
    }

    function edit($id)
    {
        return View::view("Category/EditCategory", [
            "category" => Category::query("SELECT * FROM `categories` WHERE `id` = $id LIMIT 1")[0],
        ], "Main");
    }

    function update(Request $request, $id)
    {
        $toEdit = Category::query("SELECT * FROM `categories` WHERE `id` = $id LIMIT 1")[0];

        $title = $request->getParameter("title");
        $description = $request->getParameter("description");

        if ($title !== null) {
            $toEdit->title = $title;
        }

        if ($description !== null) {
            $toEdit->description = $description;
        }

        $toEdit->store();

        return new RedirectResponse("/categories/{$toEdit->id}");
    }

    function destroy($id)
    {
        Category::query("DELETE FROM `categories` WHERE id = $id");
        return new RedirectResponse("/categories");
    }
}
