
<?php
include_once 'Users.php';
$users=new Users();
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
        $users.display_users($users, $limit, $offset, $filter);
        echo "</pre>";
    }
}
if ($url_array[2]=="user") {
    $user_id=$url_array[3];
    //Filtering of the input data
    if (filter_var($user_id, FILTER_VALIDATE_INT)!==false) {
        // Again formatting
        echo '<pre style="word-wrap: break-word; white-space: pre-wrap;">';
        $users.display_user($users, $user_id);
        echo "</pre>";
    }else { echo "User with id ".$user_id." does not exist";
    }
}

?>
