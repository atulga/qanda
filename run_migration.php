<?php
require dirname(__FILE__).'/bootstrap.php';

$link = mysql_connect(
    $db_config['hostname'],
    $db_config['username'],
    $db_config['password']
);
mysql_select_db($db_config['database'], $link);

$dir_path = dirname(__FILE__)."/migration/";
$files = scandir($dir_path);
foreach ($files as $file) {
    if (preg_match('/^migrate.+.\.sql$/', $file)){
        $migration = Migration::getByFileName($file);
        if (!($migration instanceof Migration)){
            echo $file."\n"; 
            $sql_content = file_get_contents($dir_path.$file);
            // run each query separately
            $queries = explode(";", $sql_content);
            foreach ($queries as $query) {
                $query = trim($query);
                if ($query){
                    if(!mysql_query($query)) {
                        echo mysql_error()."\n";
                        echo $query()."\n";
                    }
                }
            }
            $migration = new Migration();
            $migration->setFileName($file);
            $em->persist($migration);
            $em->flush();
        }
    }
}
mysql_close($link);
?>
