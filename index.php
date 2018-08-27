
<?php

/**
 * returns Users from a file as an Associative Array
 *
 * includes the chosen formats .php file which contains the get_Users function for that format
 * and then executes it
 *
 *
 * @param  mixed $ext The format of the file to load
 *
 * @return Array
 *
 */
function get_Users($ext="json")
{
    include $ext.".php";
    $func="get_Users_".$ext;
    return $func();
}
/**
 * displays Users as json
 *
 * @param array  $users  Array containing the users
 *
 * @param  int    $limit  The maximum amount of users to displays
 **
 * @param  int    $offset The staring number to display Users
 **
 * @param  string $filter Users need to contain this string in either their first
 *                        or last name to be displayed
 *
 * @return void
 *
 */
function display_users($users,$limit=20,$offset=0,$filter="")
{

    $display=[];
    $i=$offset;
    $count=0;
    while ($i<=count($users) && $count<$limit) {
        $user = $users[$i];
        $first_name=$user["firstname"];
        $last_name=$user["lastname"];
        if($filter==""||strpos($first_name, $filter) !==false || strpos($last_name, $filter) !==false) {
            array_push(
                $display, array (
                "userId"=>$i,
                "firstName"=>$first_name,
                "lastName"=>$last_name
                )
            );
            $count++;
        }
        $i++;

    }
    echo json_encode($display);

}
/**
 *
 * displays one User as json
 *
 * @param  array $users   Array containing the users
 **
 * @param  int   $user_id Id of the user to be displayed
 *
 * @return void
 *
 */
function display_user($users,$user_id)
{
    $display=array("userId"=>$user_id);
    foreach ($users[$user_id] as $key => $value) {
        $display[$key]=$value;
    }
    echo json_encode($display);
}
//loads config file
$config = parse_ini_file("config.ini");
//retrieves users according to format
$users=get_Users($config["format"]);
//removes the GET parameters
$uri = explode("?", $_SERVER['REQUEST_URI']);
$url_array=explode("/", $uri[0]);

if ($url_array[2]=="users") {
    //Ensure that the variables from the get parameters are not null
    $limit=empty($_GET["limit"]) ? 20 : $_GET["limit"] ;
    $offset=empty($_GET["offset"]) ? 0 : $_GET["offset"];
    $filter=empty($_GET["name"])? "" : $_GET["name"];

    //Sanitization and filtering of the inputs
    $filter=filter_var($filter, FILTER_SANITIZE_STRING);
    if (filter_var($limit, FILTER_VALIDATE_INT)===false) {
        echo "Invalid limit value \"".$limit."\"";
    } else if (filter_var($offset, FILTER_VALIDATE_INT)===false) {
        echo "Invalid offset value \"".$offset."\"";
    } else
    {
        // A bit of formatting to make everything look better
        echo '<pre style="word-wrap: break-word; white-space: pre-wrap;">';
        display_users($users, $limit, $offset, $filter);
        echo "</pre>";
    }
}
if ($url_array[2]=="user") {
    $user_id=$url_array[3];
    //Filtering of the input data
    if (filter_var($user_id, FILTER_VALIDATE_INT)!==false) {
        // Again formatting
        echo '<pre style="word-wrap: break-word; white-space: pre-wrap;">';
        display_user($users, $user_id);
        echo "</pre>";
    }else { echo "User with id ".$user_id." does not exist";
    }
}

?>
