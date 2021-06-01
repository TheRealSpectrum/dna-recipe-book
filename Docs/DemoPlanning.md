# Demo

## Introduction

- Social bullshit

## Explanation

- Blueprint cooking = recipe site
- Supports
  - recipes
  - categories
  - users
- First iteration
  - backend implemented

## Demonstration

- Home
  - 6 recipes
- Recipes
  - Show recipe
- Categories
  - Show category
  - navigate to recipe
- Users
  - edit user
  - delete user
  - create user
- Create recipe
  - Show edit for ingredient/step
- Login


# Technical demo

## Design

- Big part building core

```mermaid
    graph LR
        client([Client]) -. Request .-> routes
        routes[[Routes.php]] --> Controller
        Controller --> Model
        Model -. Query .-> db[(DataBase)]
        db -.-> Model
        Model --> Controller
        Controller --> View
        View -- HTML --> Controller
        Controller -. Response .-> client
```
```mermaid
    graph TB
        load[View] --> hasl{Has layout?}
        hasl -- yes --> loadl[Layout]
        hasl -- no --> ret([Return HtmlResponse])
        loadl --> ret

        loadc[Component] --> retc([Return string])
```
```mermaid
    classDiagram
        class Response {
            +apply()
            #applyProduction()*
            #applyDevelopment()*
        }
        class HtmlResponse {
            -$content
        }
        class RedirectResponse {
            -$uri
        }
        class ExceptionResponse {
            -$exception
        }

        Response <|-- HtmlResponse
        Response <|-- RedirectResponse
        Response <|-- ExceptionResponse
```
## Code

- `Routes.php`
  - GET
  - RESOURCE 
- `UserController.php (Open right split)`
  - index
  - update
- `User` model
  - columns / table
  - relation to other table
- `User/index` view
  - variable available
  - saved in result

## Workflow

- Design / ER diagram
- GitHub
  - Issue
  - PR
- Naming conventions
- Documentation

# Questions

