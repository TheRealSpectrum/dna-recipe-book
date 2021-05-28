<div class="w-full md:w-3/5 px-3 mb-6 md:mb-2">
    <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Ingredient name</label>
    <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 leading-tight text-sm focus:outline-none focus:bg-white" type="text" value="<?= $ingredient->name ?>" readonly>
</div>
<div class="w-full md:w-1/5 px-3 mb-6 md:mb-2">
    <label class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2" for="ingredient_title">Quantity</label>
    <input class="block w-full bg-gray-200 text-gray-700 border rounded py-2 px-2 leading-tight text-sm focus:outline-none focus:bg-white" type="text" value="<?= $ingredient->quantity ?>" readonly>
</div>
<form class="grid w-full md:w-1/5 px-3 mb-6 md:mb-2 content-end" action="/ingredients/<?= $ingredient->id ?>" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="text" name="recipe_id" value="<?= $ingredient->recipe_id ?>" hidden>
    <button type="submit" class="w-full bg-red-700 p-1 m-1 rounded-lg text-gray-100">Delete</button>
</form>