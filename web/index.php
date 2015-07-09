<?php
/**
 * Created by PhpStorm.
 * User: vagrant
 * Date: 7/9/15
 * Time: 10:33 AM
 */
require_once '../vendor/autoload.php';

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
sfContext::createInstance($configuration)->dispatch();



$m = new MongoClient();
$db = $m->pictureGalleryTest;

$collection = $db->pictures;


/*$pictureData = array( "title" => "Sonnenuntergang", "author" => "Team 42" );
$collection->insert($pictureData);

$pictureData = array( "title" => "Blume", "author" => "Joe" );
$collection->insert($pictureData);*/

$pictureRead = $collection->find();

foreach ($pictureRead as $data) {
    echo $data["title"] . " - " . $data["author"] . "<br />";
}


