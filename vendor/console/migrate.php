<?php
$_db = $config['depends']['db'];

$class = $_db['class'];

$db = new $class();
$db->setDbname($_db['params']['dbname']);
$db->setHost($_db['params']['host']);
$db->setUsername($_db['params']['username']);
$db->setPassword($_db['params']['password']);
$db->setCharset($_db['params']['charset']);

$db->connect();



if($params[1] == 'replace'){

}
$files = [];
if ($handle = opendir($current . '/migrate/')) {

    while (false !== ($entry = readdir($handle))) {
        if($entry == '.' || $entry == '..') continue;
        $files[] = $current . '/migrate/' . $entry;
    }
    closedir($handle);
}

print("Getting " . count($files) ." migration files\n-----------------------------------\n");

$queryCreate = [];

foreach ($files as $file){
    require_once $file;
}

foreach($queryCreate as $table=>$query){
    print("Try migrate: {$table}... ");
    if($params[1] == 'replace'){
        echo " [drop table enabled] ";
        $query = "DROP TABLE IF EXISTS `{$table}`;\n\n" . $query;
    }
    print("\n\n\n".$query . "\n\n\n");
    $res = $db->query($query);
    $result = $res->execute();
    if(!$result){
        echo " - FAIL\n\n";
        print($query);
    }else{
        echo " - OK\n\n";
    }
}
print("\n\n---------------------------------\n\n");
print('Migrate complete');

