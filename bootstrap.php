<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
require_once "local_settings.php";

$isDevMode = true;

// database configuration parameters
$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => $db_config['username'],
    'password' => $db_config['password'],
    'dbname'   => $db_config['database'],
    'host'     => $db_config['hostname'],
    'charset'  => 'utf8',
    'driverOptions' => array(1002=>'SET NAMES utf8'),
);

// obtaining the entity manager

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/models"), $isDevMode);

$em = EntityManager::create($conn, $config);

