-- WARNING: THIS CAN COMPLETELY RESET THE CURRENT DATABASE.

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `recipes`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `ingredients`;
DROP TABLE IF EXISTS `steps`;
DROP TABLE IF EXISTS `recipe_categories`;

SET FOREIGN_KEY_CHECKS = 1;

-- Create tables
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(30) NOT NULL,
    `password` CHAR(60) CHARACTER SET binary NOT NULL,
    `isAdmin` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`id`)
);

CREATE TABLE `recipes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `author_id` INT NOT NULL,
    `title` VARCHAR(30) NOT NULL DEFAULT '',
    `description` VARCHAR(500) NOT NULL DEFAULT '',
    `preparation_time` INT NOT NULL DEFAULT '0',
    `cooking_time` INT NOT NULL DEFAULT '0',
    `num_servings` INT NOT NULL DEFAULT '0',
    `image` VARCHAR(20) NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `categories` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(30) NOT NULL DEFAULT '',
    `description` VARCHAR(500) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
);

CREATE TABLE `ingredients` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `recipe_id` INT NOT NULL,
    `name` VARCHAR(30) NOT NULL DEFAULT '',
    `quantity` VARCHAR(30) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    FOREIGN KEY (`recipe_id`) REFERENCES `recipes`(`id`)
);

CREATE TABLE `steps` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `recipe_id` INT NOT NULL,
    `title` VARCHAR(30) NOT NULL DEFAULT '',
    `description` VARCHAR(500) NOT NULL DEFAULT '',
    `index` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`recipe_id`) REFERENCES `recipes`(`id`)
);

-- Intersect table
CREATE TABLE `recipe_categories` (
    `recipe_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    PRIMARY KEY (`recipe_id`, `category_id`),
    FOREIGN KEY (`recipe_id`) REFERENCES `recipes`(`id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
);