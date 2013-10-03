ALTER TABLE `user` ADD `description` TEXT NULL;
ALTER TABLE `user` ADD `nickname` VARCHAR(40) NULL AFTER `password`;
