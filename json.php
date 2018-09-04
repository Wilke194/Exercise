<?php
/**
 * returns the Users loaded from a json file
*
 *@param string $path filepath
 *
 * @return Array
 */
function get_file_as_assoc_array($path)
{
    $users = json_decode($path, true);
    return $users;
}
?>
