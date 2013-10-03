CREATE TABLE IF NOT EXISTS `migration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_name` (`file_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

INSERT INTO `migration` (`id`, `file_name`) VALUES
(27, 'migrate_01_initial_database.sql'),
(12, 'migrate_02_add_user_id_field.sql'),
(28, 'migrate_03_user_table_name_field_unique.sql'),
(29, 'migrate_04_user_table_alter_field.sql'),
(30, 'migrate_I80.sql');
