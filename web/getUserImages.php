<?php
/**
 * Created by PhpStorm.
 * User: vagrant
 * Date: 7/9/15
 * Time: 3:42 PM
 */

/**
 * @return string
 */
function getCategoryFromGet()
{
    return isset($_GET['category']) ? $_GET['category'] : null;
}

/**
 * @return string
 */
function getUserNameFromGet()
{
    return isset($_GET['username']) ? $_GET['username'] : null;
}

/**
 * @return string
 */
function getFileNameFromGet()
{
    return isset($_GET['filename']) ? $_GET['filename'] : null;
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

    $category = getCategoryFromGet();
    $userName = getUserNameFromGet();

    $m = new MongoClient();
    $gridfs = $m->selectDB('testbilder')->getGridFS();

    $realImages = [];
    $realImages = getAllUsersPictures($gridfs, $userName, $category);

    echo '<h1>'.$category. '</h1>';

    /* @var $realImages MongoGridFSFile[] */
    foreach ($realImages as $realImage) {
        $filename = $realImage->getFilename();


        echo '<table>';
        echo '<tr>';
        echo '<th>';
        echo $filename;
        echo '</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo '<img src="image.php?filename='. $filename .'" height="200"  />';
        echo '</td>';
        echo '</tr>';
    }
