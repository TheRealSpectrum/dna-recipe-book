<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;
use \App\Core\Request;

use \App\Core\Response\RedirectResponse;

use \App\Models\User;

class UserController extends Controller
{
    function index()
    {
        return View::view("User/Index", [
            "users" => User::query("SELECT * FROM `users`"),
        ], "Main");
    }

    function create()
    {
        return View::view("User/CreateUser", [], "Main");
    }
    function store(Request $request)

    {
        $newUser = User::create([
            "name" => $request->getParameter("name"),
            "password" => password_hash($request->getParameter("password"), PASSWORD_BCRYPT),
            "isAdmin" => $request->getParameter("isAdmin") === "1" ? 1 : 0,
        ]);

        $newUser->store();

        return new RedirectResponse("/users");
    }

    function show($id)
    {
        return View::view("User/ShowUser", [
            "user" => User::query("SELECT * FROM `users` WHERE `id` = $id LIMIT 1")[0],
        ], "Main");
    }

    function edit($id)
    {
        return View::view("User/EditUser", [
            "user" => User::query("SELECT * FROM `users` WHERE `id` = $id LIMIT 1")[0],
        ], "Main");
    }

    function update(Request $request, $id)
    {
        $toEdit = User::query("SELECT * FROM `users` WHERE `id` = $id LIMIT 1")[0];

        $name = $request->getParameter("name");
        $password = $request->getParameter("password");
        $isAdmin = $request->getParameter("isAdmin");

        if ($name !== null) {
            $toEdit->name = $name;
        }

        if ($password !== null) {
            $toEdit->password = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($isAdmin !== null) {
            $toEdit->isAdmin = $isAdmin === "1" ? 1 : 0;
        }

        $toEdit->store();

        return new RedirectResponse("/users/{$toEdit->id}");
    }

    function destroy($id)
    {
        User::query("DELETE FROM `users` WHERE id = $id");
        return new RedirectResponse("/users");
    }
}
