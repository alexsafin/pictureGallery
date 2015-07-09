<?php
/**
 * Created by PhpStorm.
 * User: vagrant
 * Date: 7/9/15
 * Time: 10:33 AM
 */
require_once '../vendor/autoload.php';

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors', 1);

//$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
//sfContext::createInstance($configuration)->dispatch();



/**
 * @return string
 */
function getCategoryFromPostForm()
{
    return isset($_POST['category']) ? $_POST['category'] : 'default';
}

function getUserNameFromPostForm()
{
    return isset($_POST['username']) ? $_POST['username'] : 'nouser';
}

/**
 * @param $gridfs
 * @param string $userName
 * @param string $category
 * @return array
 */
function getAllUsersPictures($gridfs, $userName, $category = null)
{
    $realImages = array();
    if (!is_null($category)) {
        $images = $gridfs->find(array('username' => $userName, 'category' => $category));
    } else {
        $images = $gridfs->find(array('username' => $userName));
    }

    while ($images->hasNext()) {
        $realImages[] = $images->getNext();
    }
    return $realImages;
}

if($_POST) {

    $category = getCategoryFromPostForm();
    $userName = getUserNameFromPostForm();
    $m = new MongoClient();
    $gridfs = $m->selectDB('testbilder')->getGridFS();

    $gridfs->storeUpload('pic', array('username' => $userName, 'category' => $category));

    $filename= $_FILES['pic']['name'];
    $fileExtension=pathinfo($filename)['extension'];

//    echo  '####'.$fileExtension;

    $realImages = [];
    $realImages = getAllUsersPictures($gridfs, $userName, $category);


    echo'uploaded';
//    /* @var $realImages MongoGridFSFile[] */
//    foreach ($realImages as $realImage) {
//        $filename = $realImage->getFilename();
//
//        echo '<table>';
//        echo '<tr>';
//        echo '<th>';
//        echo $filename;
//        echo '</th>';
//        echo '<th>';
//        echo $filename;
//        echo '</th>';
//        echo '</tr>';
//        echo '<tr>';
//        echo  '<td>';
//        echo "<img src='image.php?filename=". $filename ."'/>";
//        echo  '</td>';
//        echo '</tr>';
//    }




//$id=208;
//
//
//$gridFS->storeFile("logo.php.png", array("_id" => $id));
//    echo $gridFS->findOne(array("_id" => $id))->getBytes();

} else {
    echo <<<HTML
    <!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Gallery</title>
    </head>
    <body>
    <form method="POST" enctype="multipart/form-data">
        <h1>Bilder Gallerie</h1>
        <label for="username">Benutzername:</label><br/>
        <input type="text" name="username" value="alfonso" id="username"/><br/>
        <br/>
        <label for="pic">Please upload a profile picture:</label><br/>
        <input type="file" name="pic" id="pic"/><br/>
        <br/>
        <select name="category">
            <option value="fun">Witzig</option>
            <option value="bad">Böse</option>
            <option value="nature">Natur</option>
        </select>
        <input type="submit"/><br/>
    </form>
    </body>
    </html>
HTML;
}


