CREATE DATABASE co_coworking;

CREATE TABLE `co_coworking`.`customers` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
    `first_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `last_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `phone` VARCHAR(20) NOT NULL ,
    `email` VARCHAR(255) NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`phone`),
    UNIQUE (`email`)
);

CREATE TABLE `co_coworking`.`employees` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
    `auth_token` VARCHAR(255) NULL DEFAULT NULL,
    `first_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `last_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `phone` VARCHAR(20) NOT NULL ,
    `email` VARCHAR(255) NULL DEFAULT NULL,
    `password` VARCHAR(255) NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`phone`),
    UNIQUE (`email`)
);

CREATE TABLE `co_coworking`.`rooms` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `capacity` INT NOT NULL ,
    `type` ENUM('individual','group') NOT NULL ,
    PRIMARY KEY (`id`)
);

CREATE TABLE `co_coworking`.`reservations` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
    `start` DATETIME NOT NULL ,
    `end` DATETIME NOT NULL ,
    `room_id` BIGINT(20) NOT NULL ,
    `user_id` BIGINT(20) NOT NULL ,
    `seat_number` INT NULL DEFAULT NULL ,
    `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `type` ENUM('individual','group') NOT NULL ,
    `price` INT NOT NULL ,
    PRIMARY KEY (`id`),
    UNIQUE (`start`, `end`, `room_id`, `seat_number`),
    CONSTRAINT `reservation_user`
    FOREIGN KEY (`user_id`) REFERENCES `customers`(`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT `reservation_room`
    FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE `co_coworking`.`pricing` (
    `amount` INT NOT NULL ,
    `type` ENUM('individual','group') NOT NULL ,
    `room_id` BIGINT(20) NOT NULL ,
    PRIMARY KEY (`type`, `room_id`),
    CONSTRAINT `pricing_room`
    FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
