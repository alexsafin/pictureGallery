<?php
/**
 * Created by PhpStorm.
 * User: vagrant
 * Date: 7/9/15
 * Time: 3:56 PM
 */

$dbName = 'testbilder';
$m = new MongoClient();
$gridfs = $m->selectDB($dbName);
$gridfs->drop();

echo 'Database ' . $dbName . ' flushed.';