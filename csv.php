<?php
/**
 * returns the Users loaded from a csv file
 *
 * @return Array
 */
function get_Users_csv()
{
    $config =parse_ini_file("config.ini");
    //csv to associative array from https://stackoverflow.com/a/41942299
    $rows = array_map('str_getcsv', file($config["csv_User"]));
    $header = array_shift($rows);
    $users = array();
    foreach ($rows as $row) {
        $users[] = array_combine($header, $row);
    }
    return $users;
}

?>
