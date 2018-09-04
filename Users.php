<?php
include_once 'User.php';
/**
 *
 */
class Users
{
  private $users
  /**
   * returns Users from a file as an Associative Array
   *
   * includes the chosen formats .php file which contains the get_Users function for that format
   * and then executes it
   *
   *
   * @param  mixed $ext The format of the file to load
   *
   *@param mixed $file the filepath
   *
   * @return Array
   *
   */
  function get_Users($ext="json",$file)
  {
      include_once $ext.".php";
      $func="get_file_as_assoc_array";
      $users_array= $func($file.".".$ext);
      $users=array();
      $i=1;
      foreach ($users_array as $user) {
        array_push($users,newUser($i,$user));
        $i++;
        )
      }
  }
  /**
   * displays Users as json
   *
   *
   * @param  int    $limit  The maximum amount of users to displays
   *
*
   * @param  int    $offset The staring number to display Users
   *
*
   * @param  string $filter Users need to contain this string in either their first
   *                        or last name to be displayed
   *
   * @return void
   *
   */
  function display_users($limit=20,$offset=0,$filter="")
  {

      $display=[];
      $i=$offset;
      $count=0;
      while ($i<=count($users) && $count<$limit) {
          $user = get_User($i);
          if (!is_null($user)) {
            $first_name=$user.get_first_name();
            $last_name=$user.get_last_name();
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
          }
          $i++;

      }
      echo json_encode($display);

  }
  public display_User($user_id){
    get_User($user_id).display_User();
  }
  public function get_User($user_id)
  {

    foreach ($users as $user) {
      if ($user.getId()==$user_id) {
        return $user;
      }
    }
  }
  function __construct()
  {
    //loads config file
    $config = parse_ini_file("config.ini");
    //retrieves users according to format
    $users=get_Users($config["format"],$config["User_file"]);
  }
}

 ?>
