<?php
/**
 * returns the Users loaded from a csv file
 *
 * @return Array
 */
function get_file_as_assoc_array($path)
{
    //csv to associative array from https://stackoverflow.com/a/41942299
    $rows = array_map('str_getcsv', file($path));
    $header = array_shift($rows);
    $users = array();
    foreach ($rows as $row) {
        $users[] = array_combine($header, $row);
    }
    return $users;
}

?>
