# Example

This is an example of how to use the MVC system.

## Route.php

The run function goes through all routes in order and applies the first one that matches.

The first argument is the uri.
Normal text is take as is, so the uri `/uri` expects the user to go to `https://<<domain>>/uri`.
Any part that start with `:` is a parameter, and can be *anything*.
For example, the uri `/uri/:param` does match the url `https://<<domain>>/uri/1`.
If the number of parts do not match it will never work.
So the uri `uri/:param` does **not** match `https://<<domain>>/uri/1/2`.

The second part expects an array with 2 values.
The first value is the class name of a class which extends Controller.
The second value is the name of a function that will be called.
In this case the function `func` will be called.
If this functions defines a variable with the name of a parameter, in this case it should be `$param`, it will automatically inject the value of the parameter with that name.
So if the url `http://<domain>/uri/1` is requested the value of `$param` will be set to `"1"`.
Note that this is a string, not a number.

> I am not sure what happens if you set the parameter type to int, feel free to update the documentation.

```php
Route::run([
        Route::get("/uri/:param", [ConcreteController::class, "func]),
    ]);
```

## Controller

The `Database::getModels` function returns an array of models.
The first argyment is an SQL query.
The second argument is a callable that returns an instance of the desired model.

The `View::view` function should be returned in order to display it as html.
When a view is returned the status code us always 200 (success).
The first argument is the name of the view.
The second argument is the data passed to the view.
In this examples, the `$models` array will available in the view under the `$models` variable.
Note that this is because of the `"models"` key, not the variable name in this function.

```php
final class ConcreteController extends Controller
{
    function func(string $param)
    {
        $models = Database::getModels("SELECT * `users`", function (){
            return new ConcreteModel();
        });

        return View::view("UserList", [
            "models" => $models;
        ]);
    }
}
```

## Model

`$columns` are the allowed colums.
These are the columns defined in the database.
If an invalid column is filled an exception is thrown.

`$table` is the table in the database which the model is accessing.

`$idColumn` is the unique identifier for this specific model.
It defaults to `"id"`, so it is set unnescesarily in this example.

For more information on relations see [`Docs/Relations.md`](./Relations.md).

```php
final class ConcreteModel extends Model
{
   protected array $columns = ["id", "thing", "referenced_id", "one_id", "many_id"]; 
   protected string $table = "users";
   protected string $idColumn = "id";

    public function referenced(): ConcreteModel
    {
        return $this->relationFromKey(
            "referencedRelation",
            "users",
            "id",
            "referenced_id",
            function()
            {
                return new ConcreteModel();
            }
        );
    }

    public function one(): ConcreteModel
    {
        return $this->relationOne(
            "oneRelation",
            "users",
            "id",
            "one_id",
            function()
            {
                return new ConcreteModel();
            }
        );
    }

    public function many(): array
    {
        return $this->relationMany(
            "manyRelation",
            "users",
            "id",
            "many_id",
            function()
            {
                return new ConcreteModel();
            }
        );
    }

    protected ?ConcreteModel $referencedRelation = null;
    protected ?ConcreteModel $oneRelation = null;
    protected ?array $manyRelation = null;
}
```