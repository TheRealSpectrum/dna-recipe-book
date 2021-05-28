-- Seed database.
-- IMPORTANT: Does not work unless database has been freshly created using `create.sql`.

-- Users
INSERT INTO `users` (`name`, `password`, `isAdmin`)
    VALUES ('Damy', '$2y$10$tIU6zMikquirHx7GBWwnNeCyAkEIN0VD8nl8P8E5Gt6etVCE26HES', 1);

INSERT INTO `users` (`name`, `password`, `isAdmin`)
    VALUES ('Niels', '$2y$10$0FzpmmdYmhsDpUWiRxEdIeBdG8K7.z6G2kac8TJ1z/AR2Q5dnwVS6', 1);

INSERT INTO `users` (`name`, `password`)
    VALUES ('Ian', '$2y$10$VlHnQgpk8Dhwbiz7AvTaM.kOXlx6e1j7Ps.woLPwpsRzOOIJ3kf66');

INSERT INTO `users` (`name`, `password`)
    VALUES ('Rik', '$2y$10$q9QltzjN4NnnVNgPE5Mjc.bfs/G6F/uVuLL.O2xyTV9Vtx8j2gt8i');

-- Recipes
INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        1,
        'Pasta Pesto',
        'Simple pasta recipe using traditional style pesto!',
        30,
        20,
        4
    );

INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        2,
        'Lasgna',
        'If you put lasgna on another lasagna you only have 1 lasagna.',
        40,
        60,
        6
    );

INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        1,
        'Mac and cheese',
        'Too much cheese? There is no such thing.',
        30,
        30,
        4
    );

INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        2,
        'Chicken soup',
        'https://based.cooking/chicken-soup.html',
        30,
        120,
        8
    );

INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        3,
        'Banana muffins with chocolate',
        'https://based.cooking/banana-muffins-with-chocolate.html',
        15,
        30,
        12
    );

INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        4,
        'Spicy mayo',
        'https://based.cooking/spicy-mayo.html',
        3,
        0,
        1
    );

INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        2,
        'Baked salmon',
        'https://based.cooking/baked-salmon.html',
        5,
        19,
        1
    );

INSERT INTO `recipes` (`author_id`, `title`, `description`, `preparation_time`, `cooking_time`, `num_servings`)
    VALUES (
        1,
        'Cheesy pasta bake',
        'https://based.cooking/cheesy-pasta-bake.html',
        15,
        60,
        4
    );

-- Categories
INSERT INTO `categories` (`title`, `description`)
    VALUES ('Italian', 'Traditional!');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Chicken', 'Your favorite white meat.');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Oven', 'Do not forget to preheat your oven!');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Quick', 'Not enough time? no need to worry!');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Cheese', 'Say cheese!');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Pasta', 'Always a good idea!');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Vegetarian', 'No meat');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Desert', 'Just deserts!');

-- Ingredients
-- Recipe 1 (Pasta Pesto)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (1, 'Spaghetti', '400g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (1, 'Basil', '1 plant');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (1, 'Pine nuts', '150g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (1, 'Olive oil', 'Variable');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (1, 'Grana padano', '180g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (1, 'Cubed chicken', '400g');

-- Recipe 2 (Lasagna)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Lasagna noodles', '600g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Tomato paste', '100g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Tomatoes', '6 pieces');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Courgette', '1 piece');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Leek', '1 piece');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Ground beef', '600g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Grana padano', '200g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (2, 'Cheddar', '200g');

-- Recipe 3 (Mac and cheese)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (3, 'Cheddar', '300g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (3, 'Grana padano', '300g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (3, 'milk', '500ml');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (3, 'butter', '30g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (3, 'flour', '4 pinches');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (3, 'macaroni', '500g');

-- Recipe 4 (Chicken soup)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (4, 'Chicken breasts', '2');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (4, 'Onion', '1');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (4, 'carrots', '2');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (4, 'Celery stalks', '2');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (4, 'Chicken stock', '900ml');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (4, 'pasta', '');

-- Recipe 5 (Banana muffins with chocolate)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'bananas', '3');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'butter', '100g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'sugar', '150g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'eggs', '2');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'cooking powder', '1 1/2 table spoons');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'wheat flour', '260g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'dark chocolate', '50g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'milk chocolate', '50g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (5, 'vanialla sugar (optional)', 'some');

-- Recipe 6 (Spicy mayo)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (6, 'Chili sauce', '');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (6, 'Mayonnaise', '');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (6, 'Sesame oil', '');

-- Recipe 7 (Baked salmon)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (7, 'Salmon steaks', '');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (7, 'Red pepper flakes', '');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (7, 'Lemon juice', '');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (7, 'Butter', '');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (7, 'Cooking oil', '');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (7, 'Aluminium foil', '');

-- Recipe 8 (Cheesy pasta bake)
INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (8, 'Pasta', '400g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (8, 'Butter', '50g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (8, 'Flour', '100g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (8, 'Milk', '200ml');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (8, 'Cheddar cheese', '400g');

INSERT INTO `ingredients` (`recipe_id`, `name`, `quantity`)
    VALUES (8, 'Rashers of bacon (optional)', '6');

-- Steps
-- Recipe 1 (Pasta pesto)
INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        1,
        'Toast pine nuts',
        'Toast pine nuts in a pan with no oil or butter. Wait until golden brown.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        1,
        'Rasp grana gadano',
        'Rasp grana padano in a food mixer.',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        1,
        'Mix ingredients',
        'Mix the rest of the ingredients in the food mixer.',
        2
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        1,
        'Cook pasta',
        'Cook pasta using manufacturers instructions.',
        3
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        1,
        'Cook chicken',
        'Cook chicken to preference. Tip, use an italian herb/spice mix.',
        4
    );

-- Recipe 2 (Lasagna)

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        2,
        'Remove skin from tomatoes',
        'Cut a cross at the bottom of each tomato. Put them in boiling water of 2 minutes. Quickly put tomatoes in cold water bath. The skin should come right off.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        2,
        'Cut veggetables',
        'Cut the leak into rings. Cut the Cut the cougette into querter rings. Dice the tomato.',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        2,
        'Cook the sauce',
        'Cook the leak, cougette, tomatoes, tomato paste and ground beef in some sort of pan.',
        2
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        2,
        'Assemly the lasagna',
        'Start with a greased oven dish. Assamble in this order: sauce, cheese, lasagna noodle. End with a cheese layer. You can put extra cheese on the top layer if you prefer.',
        3
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        2,
        'Oven',
        'Put the lasagna in the oven for 30 minutes at 200 degrees c.',
        4
    );

-- Recipe 3 (Mac and cheese)
INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        3,
        'Cook macaroni',
        'Cook macaroni as short as allowed.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        3,
        'Grate cheeses',
        'Grate both types of cheese',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        3,
        'Butter and flour',
        'Put butter and flour in a sauce pan.',
        2
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        3,
        'Milk',
        'Add milk to sauce pan',
        3
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        3,
        'Cheeses',
        'Add grated cheeses to sauce pan',
        4
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        3,
        'Assemly',
        'Put the cooked macaroni in a greased oven dish. Then poor the cheese sauce over it.',
        5
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        3,
        'Bake',
        'Bake in preheated oven.',
        6
    );

-- Recipe 4 (Chicken soup)
INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        4,
        'Cook',
        'Cook chicken breasts, shred, and set aside in a bowl.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        4,
        'Cut vegetables',
        'Cut up carrots and celery, place in pot and saute.',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        4,
        'Add stock',
        'Add in chicken and stock or broth and mix together well. Season with salt, pepper, hot sauce, whatever you desire',
        2
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        4,
        'Simmer',
        'Allow it to simmer on low heat for 2 hours mixing every so often.',
        3
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        4,
        'Pasta',
        'If adding noodles, add in pasta and allow pasta to cook until al dente.',
        4
    );

-- Recipe 5 (Banana muffins with chocolate)
INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        5,
        'Peel bananas',
        'Peel the bananas and mush them together.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        5,
        'Whip',
        'Whip the two eggs and mix them with the sugar.',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        5,
        'Butter',
        'Melt the butter, cut the chocolate into smaller pieces, and whip the eggs.',
        2
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        5,
        'Mix',
        'Pour the butter into the bananas, then add the flour, then the cooking powder, the chocolate, the whipped eggs and sugar, and the optional vanilla sugar; stirring it all the time.',
        3
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        5,
        'Pour',
        'Pour the mass into your muffin dish.',
        4
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        5,
        'Bake',
        'Heat up the oven to 160 °C / 320 °F and bake the muffins for around 20-30 minutes at 170 °C / 340 °F.',
        5
    );

-- Recipe 6 (Spicy mayo)
INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        6,
        'Mayo and chili',
        'Add 2 parts mayonnaise to 1 part chili sauce in a bowl.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        6,
        'Sesame oil',
        'Add 1 tbsp of sesame oil for every cup of mayonnaise you use.',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        6,
        'Mix',
        'Mix all of the ingredients together, and taste test it for more chili sauce or mayonnaise.',
        2
    );

-- Recipe 7 (baked salmon)
INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        7,
        'Season',
        'Season salmon with salt, black pepper, and red pepper to taste.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        7,
        'Prepare salmon',
        'Spray or rub in cooking oil on aluminum foil and place on cookie sheet or in baking pan.',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        7,
        'Butter and lemon',
        'Squeeze lemon juice and place a teaspoon of butter on each salmon steak.',
        2
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        7,
        'Bake',
        'Bake at 400°F / 200°C for 19 mins.',
        3
    );

-- Recipe 8 (Cheesy pasta bake)
INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Grate',
        'Grate the cheese.',
        0
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Chop bacon',
        'Chop up the bacon into roughly 2cm x 2cm squares.',
        1
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Cook pasta',
        'Start cooking the pasta.',
        2
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Melt butter',
        'Start melting the butter in another saucepan.',
        3
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Add flour',
        'Once melted, add flour and mix until the mixture forms a paste that does not stick to the sides. The quantity of flour required may vary.',
        4
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Add milk',
        'Now start adding the milk slowly, while mixing, as to avoid lumps.',
        5
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Heat',
        'Heat on low heat while stirring until the sauce becomes thick. If unsure, taste the sauce, and if you cannot taste the flour, it is ready for the next step.',
        6
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Add cheese',
        'Add 80% of the cheese and stir until melted in.',
        7
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Drain pasta',
        'Drain the pasta and add to baking dish.',
        8
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Add sauce',
        'Add the sauce and mix in.',
        9
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Add bacon',
        'If using bacon, fry it up and mix into the dish, making sure to include any fat that comes out of the bacon for extra flavour.',
        10
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Cover with cheese',
        'Use the rest of the cheese to cover the top.',
        11
    );

INSERT INTO `steps` (`recipe_id`, `title`, `description`, `index`)
    VALUES (
        8,
        'Bake',
        'Bake at gas mark 6 for about 30 minutes.',
        12
    );

-- Recipe category intersect

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (1, 1);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (2, 1);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (8, 1);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (1, 2);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (4, 2);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (2, 3);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (7, 3);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (8, 3);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (1, 4);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (5, 4);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (6, 4);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (3, 5);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (8, 5);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (1, 6);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (2, 6);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (8, 6);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (1, 7);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (3, 7);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (5, 7);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (6, 7);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (8, 7);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (5, 8);
