<div class="lg:w-4/6 mx-auto">
    <div class="rounded-lg h-64 overflow-hidden">
        <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/1200x500">
    </div>
    <div class="flex flex-col sm:flex-row mt-10">
        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
            <div class="flex flex-col items-center text-center justify-center">
                <h2 class="font-medium title-font mt-2 text-white text-3xl"><?= $title ?></h2>
                <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
                <p class="text-base text-gray-400 mb-3"><?= $description ?></p>
                <p class="text-base text-gray-200">Preparation time: <?= $preparationTime ?> Minutes</p>
                <p class="text-base text-gray-200">Cooking time: <?= $cookingTime ?> Minutes</p>
                <p class="text-base text-gray-200">Servings: <?= $numServings ?> Persons</p>
                <ul class="font-medium title-font mt-4 mb-2 text-white text-2xl">Ingredients:
                <?php foreach($ingredients as $ingredient) {
                     echo '<li class="text-base text-gray-200">' . $ingredient->quantity . " " . $ingredient->name .  '</li>';
                } 
                ?>
                </ul>    
            </div>
        </div>
        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-800 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
        <?php foreach($steps as $step) {
             echo '<p class="leading-relaxed text-xl text-gray-200">Step ' . ($step->index + 1) .  ": " . $step->title . '</p>'
                . '<p class="leading-relaxed text-lg mb-4 text-gray-400">' . $step->description . '</p>'; 
        }
        ?>
        </div>
    </div>
</div>