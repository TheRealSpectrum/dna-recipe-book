<?php

declare(strict_types=1);

?>

<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->
<!-- Content -->
<section class="flex-grow text-gray-400 body-font bg-gray-900">
  <a href="/recipes">
    <p class="container px-5 pt-5 text-xl mx-auto">Back to recipes without saving</p>
  </a>
  <form class="mx-auto w-full max-w-lg my-4" method="POST" action="/recipes/<?= $recipe->id ?>">
    <input type="hidden" name="_method" value="PATCH">
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-100 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="recipe_title">
          Title
        </label>
        <input class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-2 px-2 mb-3 leading-tight text-sm focus:outline-none focus:bg-white" name="recipe_title" type="text" value="<?= $recipe->title ?>">
        <p class="text-red-500 text-xs italic">Please fill out this field.</p>
      </div>
      <div class="w-full md:w-100 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="recipe_description">
          Description
        </label>
        <textarea class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 mb-3 leading-tight text-sm focus:outline-none focus:bg-white" name="recipe_description"><?= $recipe->description ?></textarea>
      </div>
      <div class="w-full md:w-100 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="recipe_author">
          Author
        </label>
        <select class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 mb-3 leading-tight text-sm focus:outline-none focus:bg-white" name="recipe_author" type="text">
          <?php foreach ($authors as $author) {
            echo '<option value="' . $author->id . "\" " . ($author->id === $recipe->author_id ? "selected" : "") .  '>' . $author->name . '</option>';
          };
          ?>
        </select>
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="recipe_servings">
          Servings
        </label>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 mb-3 leading-tight text-sm focus:outline-none focus:bg-white" name="recipe_servings" type="number" value="<?= $recipe->num_servings ?>">
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="recipe_servings">
          Categories
        </label>
        <select class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 mb-3 leading-tight text-sm focus:outline-none focus:bg-white" name="recipe_categories" multiple>
          <?php foreach ($categories as $category) {
            echo '<option value="' . $category->id . '" ' .  (in_array($category->id, $recipe_categories) ? "selected" : "") .  '>' . $category->title . '</option>';
          };
          ?>
        </select>
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="recipe_prep_time">
          Preparation Time
        </label>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 mb-3 leading-tight text-sm focus:outline-none focus:bg-white" name="recipe_prep_time" type="number" value="<?= $recipe->preparation_time ?>">
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="recipe_cooking_time">
          Cooking Time
        </label>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 mb-3 leading-tight text-sm focus:outline-none focus:bg-white" name="recipe_cooking_time" type="number" value="<?= $recipe->cooking_time ?>">
      </div>
      <div class="w-full md:w-100 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">
          Cover photo
        </label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md mb-3">
          <div class="space-y-1 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="flex text-sm text-gray-400">
              <label for="file-upload" class="relative cursor-pointer bg-gray-200 rounded-md font-medium text-indigo-600 px-1">
                <span>Upload a file</span>
                <input id="file-upload" name="file-upload" type="file" class="sr-only">
              </label>
              <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">
              PNG, JPG, GIF up to 10MB
            </p>
          </div>
        </div>
      </div>
      <div class="px-4 py-3  text-right">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Edit Recipe
        </button>
      </div>
    </div>
  </form>
  <form class="mx-auto w-full max-w-lg my-4" method="POST" action="/ingredients">
    <div class="flex flex-wrap -mx-3 mb-2">
      <div class="w-full md:w-1/2 px-3  md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Ingredient name</label>
        <input type="text" name="recipe_id" value="<?= $ingredients[0]->recipe_id ?>" hidden>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2  leading-tight text-sm focus:outline-none focus:bg-white" type="text" name="ingredient_title">
      </div>
      <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Ingredient Quantity</label>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2  leading-tight text-sm focus:outline-none focus:bg-white" type="text" name="ingredient_quantity">
      </div>
      <div class="px-4 py-3  text-right">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Add ingredient
        </button>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
      <div class="w-full md:w-1/2 px-3 md:mb-0">
          
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Ingredient name</label>
        <input type="text" name="recipe_id" value="<?= $ingredients[0]->recipe_id ?>" hidden>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2  leading-tight text-sm focus:outline-none focus:bg-white" type="text" name="ingredient_title">
        
      </div>
      <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Ingredient Quantity</label>
        <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2  leading-tight text-sm focus:outline-none focus:bg-white" type="text" name="ingredient_quantity">
      </div>
    </div>


  </form>
</section>