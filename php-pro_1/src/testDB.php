<?php
try{
    $dbh = new PDO("mysql:host = db_mysql;dbname = php_pro", "vitor", "pass4vitor");
    $users = $dbh->query("select * from first_table")->fetchAll(PDO::FETCH_ASSOC);
    $banned = $dbh->query("select * from first_table where banned = true");
    $status = $dbh ->query("select * from first_table where status = 1");
    $mark = $dbh->query("select * from first_table where name = 'mark'");
    $name = $banned[0]->getname();
}catch (PDOException $e){
    echo $e->getCode() .":" . $e->getMessage(). ' ('. $e->getLine(). ')' . PHP_EOL;
}