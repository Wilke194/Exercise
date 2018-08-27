<?php
/**
 * returns the Users loaded from a json file
 *
 * @return Array
 */
function get_Users_json()
{
    $config =parse_ini_file("config.ini");
    $file=file_get_contents($config["json_User"]);
    $users = json_decode($file, true);
    return $users;
}
?>
