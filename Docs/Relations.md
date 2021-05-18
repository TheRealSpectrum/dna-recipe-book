# Relations

Database relations are "connections" between 2 database rows.
These rows usually belong to different columns.
However, this is not a strict requirement.

Database relations are implemented using foreign keys.
Given 2 tables, `a` and `b`, it is implemented like this:

- Table `a` has a column `id`, which is guarenteed to be unique for each row.
- Table `b` has a column `a_id`, which is set to the same value of the `id` column in a row in table `a`. 
- Depending on the relation type there might be multiple rows in table `b` with the same `a_id`.

Relations should be defined within a model.
Each model has a number of functions starting with `relation`.
This will automatically handle loading the required models.
The exact meaning and input is defined below.
By design you should create a function with a name representitive of the other side of the relation.
So if you are a user with many posts, the function should be named `posts()`.

It is possible to batch load the models, usually called eager loading.
This will generate a query that retrieves data for a variable number of models.
See [RelationManager::batchLoad](../App/Core/RelationManager.php) for more information.

## relationFromKey

This relation has a key which references a unique id in a designated table.
Because of this it is assumed that at most 1 reference should exist.

- property: property defined in the concrete model.
- referencedTable: name of the table where the key points to.
- id: name of the id column of the `referencedTable`.
- key: name of the key in this model.
- generator: returns a new model that has the correct type for the `referencedTable`.

## relationOne

This relation is almost the same as `relationFromKey`, however in this case the current model has the unique id.
The reference is in the other table.
The result is always limited to 1,
so if this is accedently implemented instead of a one to many relationship it will cause problematic bugs.

- property: property defined in the concrete model.
- referenceTable: name of the table where the key points to.
- id: name of the id column of the `referenceTable`.
- key: name of the key in this model.
- generator: returns a new model that has the correct type for the `referenceTable`.

## relationMany

This relation is almost the same as `relationOne`, but is not limited to 1.
Because of this it will always return an array.

- property: property defined in the concrete model.
- referenceTable: name of the table where the key points to.
- id: name of the id column of the `referenceTable`.
- key: name of the key in this model.
- generator: returns a new model that has the correct type for the `referenceTable`.

## example

This example shows all types of relation.

```php
final class BlogUser extends Model
{
    public coreUser(): CoreUser
    {
        return $this->relationFromKey(
            "coreUserRelation",
            "core_users",
            "id",
            "core_user_id",
            function ()
            {
                return new CoreUser();
            }
        );
    }

    public blogProfile(): BlogProfile
    {
        return $this->relationOne(
            "blogProfileRelation",
            "blog_profiles",
            "id",
            "blog_user_id",
            function ()
            {
                return new BlogProfile();
            }
        );
    }

    public posts(): array
    {
        return $this->relationMany(
            "postsRelation",
            "posts",
            "id",
            "blog_user_id",
            function ()
            {
                return new Post();
            }
        );
    }

    protected ?CoreUser $coreUserRelation = null;
    protected ?BlogProfile $blogProfileRelation = null;
    protected ?array $postsRelation = null;
}
```