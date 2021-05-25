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

-- Categories
INSERT INTO `categories` (`title`, `description`)
    VALUES ('Italian', 'Traditional!');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Chicken', 'Your favorite white meat.');

INSERT INTO `categories` (`title`, `description`)
    VALUES ('Oven', 'Do not forget to preheat your oven!');

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

-- Recipe category intersect

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (1, 1);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (2, 1);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (1, 2);

INSERT INTO `recipe_categories` (`recipe_id`, `category_id`)
    values (2, 3);
