# Example

This is an example of how to use the MVC system.

## Route.php

`ConcreteController` extends `Controller`.
The list function goes through a number of possible routes and chooses the first one that matches.

The first argument is the uri.
Normal text is take as is, so the uri `/uri` expects the user to go to `https://<<domain>>/uri`.
Any part that start with `:` is a parameter, and can be *anything*.
For example, the uri `/uri/:param` does match the url `https://<<domain>>/uri/1`.
If the number of parts do not match it will never work.
So the uri `uri/:param` does **not** match `https://<<domain>>/uri/1/2`.
The parse function takes the name of a function as its argument.
So the function `func` will be called.
If this functions defines a variable with the name `$param` it will automatically inject the value of the parameter.
So if the url `http://<domain>/uri/1` is requested the value of `$param` will be set to `"1"`.
Note that this is a string, not a number.

> I am not sure what happens if you set the parameter type to int, feel free to update the documentation.

```php
$controller = new ConcreteController();

Route::list([
        Route::get("/uri/:param", $controller->parse("func")),
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

The `serialize` method must take the data from the fields and put them in an array which will in turn be passed to the SQL database.
The `deSerialize` method does the reverse, and must put the results from an SQL query in the class fields.

For more information on relations see [`Docs/Relations.md`](./Relations.md).

```php
final class ConcreteModel extends Model
{
    protected function serialize(): array
    {
        return [
            "id" => $this->id,
            "thing" => $this->thing,
            "referencedId" => $this->referencedId,
            "oneId" => $this->oneId,
            "manyId" => $this->manyId,
        ];
    }

    public function deSerialize(array $data): void
    {
        $this->id = $data["id"];
        $this->thing = $data["thing"];
        $this->referencedId = $data["referencedId"];
        $this->oneId = $data["oneId"];
        $this->manyId = $data["manyId"];
    }

    public function referenced(): ConcreteModel
    {
        return $this->relationFromKey(
            "referencedRelation",
            "users",
            "id",
            "referencedId",
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
            "oneId",
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
            "manyId",
            function()
            {
                return new ConcreteModel();
            }
        );
    }

    public int $id;
    public string $thing;
    public int $referencedId;
    public int $oneId;
    public int $manyId;

    protected ?ConcreteModel $referencedRelation = null;
    protected ?ConcreteModel $oneRelation = null;
    protected ?array $manyRelation = null;
}
```