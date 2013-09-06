ALTER TABLE `user` ADD `description` TEXT NOT NULL;
ALTER TABLE `user` ADD `nickname` VARCHAR(40) NOT NULL AFTER `password`;
