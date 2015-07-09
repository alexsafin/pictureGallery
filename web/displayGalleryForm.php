<?php
    echo <<<HTML
    <!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>DisplayImages</title>
    </head>
    <body>
    <form method="GET"  action="getUserImages.php" >
        <h1>Bilder Gallerie</h1>
        <label for="username" >Benutzername:</label><br/>
        <input type="text" value="alfonso" name="username" id="username"/><br/>
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

