# Recipe Book: design

## Routes

- Home
- List (filtered?, pagination)
- Recipe CRUD
- Category admin CRUD (List route used for filtering)
- Admin login/logout

## Controllers

*CRUD:
- Index
- Show
- Create
- Store
- Edit
- Update
- Destroy

__Actual controllers:__

- Home
  - Index
- Recipe
  - *CRUD
- Category
  - *CRUD
- Auth
  - Login
  - Logout
- User
  - *CRUD

## Database

```mermaid
erDiagram

  RECIPE ||--|{ INGREDIENT : has 
  RECIPE ||--|{ STEP : has
  CATEGORY }|--|{ RECIPE: categorizes
  USER }|--|| RECIPE: authors

  CATEGORY {
    INT id
    TEXT_30 title
    TEXT_500 description
  }

  USER {
    INT id
    TEXT_30 name
    VARCHAR password
    BOOL isAdmin
  }

  RECIPE {
    INT id
    TEXT_30 title
    TEXT_500 description
    INT author_id
    INT preparation_time
    INT cooking_time
    INT num_servings
    VARCHAR_20 image
  }

  INGREDIENT {
    INT id
    INT recipe_id
    TEXT_30 name
    TEXT_30 quantity
  }

  STEP {
    INT id
    TEXT_30 title
    TEXT_500 description
    INT index
    INT recipe_id
  }

```

- Recipe
  - id
  - Title
  - Description
  - Author
  - Preparation time
  - Cooking time
  - Servings
  - Image
- Ingredient
  - id
  - Recipe id
  - name
  - quantity
- Step
  - title
  - description
  - index
  - Recipe id
- Category
  - id
  - title
  - description
- Category pivot
  - Category id
  - Recipe id
- User
  - id
  - name
  - password
  - isAdmin
