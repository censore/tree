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

$stm = $db->pdo->query("SHOW TABLES");

$stm->execute();
$tables = $stm->fetchAll(\PDO::FETCH_ASSOC);

foreach($tables as $table){
    $tab = $db->pdo->query('SHOW CREATE TABLE ' . $table['Tables_in_family']);
    $tab->execute();
    $create = $tab->fetch(\PDO::FETCH_ASSOC)['Create Table'];
    $migrateData = [];
    $migrateData[] = "<?php\n\n\n/*-----Migration table `{$table['Tables_in_family']}`------*/\n\n\n\n";
    $migrateData[] = '$queryCreate[] = <<<QUERY'."\n".$create."\n\n"."QUERY;";
    $migrateData[] = "\n\n\n\n/*-----Migration table `{$table['Tables_in_family']}` END------*/";
    file_put_contents($current . '/migrate/' . $table['Tables_in_family'] . '_migration.php', implode("\n", $migrateData));
}