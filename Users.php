<?php
require_once 'User.php';
/**
* Users class is a class to represent all users
*@access public
*
*@var array $users array of class User
*/
class Users
{
    private $users;
    /**
     * fills Users from a file as an Associative Array
     *
     * includes the chosen formats .php file which contains the get_Users function for that format
     * and then executes it
     *
     * @param mixed $ext  The format of the file to load
     *
     * @param mixed $file the filepath
     *
     * @return void
     */
    private function get_Users($file,$ext="json")
    {
        include_once $ext.".php";
        $func="get_file_as_assoc_array";
        $users_array= $func($file.".".$ext);
        $this->users=array();
        $i=0;
        foreach ($users_array as $user) {
            array_push($this->users, new User($i, $user));
            $i++;
        }
    }
    /**
     * displays Users as json
     *
     * @param int    $limit  The maximum amount of users to displays
     *
     * @param int    $offset The staring number to display Users
     *
     * @param string $filter Users need to contain this string in either their first
     *                       or last name to be displayed
     *
     * @return void
     */
    function display_users($limit=20,$offset=0,$filter="")
    {
        $display=[];
        $i=$offset;
        $count=0;
        while ($i<=count($this->users) && $count<$limit) {
            $user = $this->get_User($i);
            if (!is_null($user)) {
                $first_name=$user->getFirstName();
                $last_name=$user->getLastName();
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
    /**
     * Displays the user with the indicated id
     *
     * @param int $user_id ID of the user to be displayed
     *
     * @return void
     */
    public function display_User($user_id)
    {
        $this->get_User($user_id)->display_User();
    }
    /**
     * retrieves a single user with the indicated
     *
     * @param int $user_id ID of the user to be returned
     *
     * @return User
     */
    public function get_User($user_id)
    {
        foreach ($this->users as $user) {
            if ($user->getId()==$user_id) {
                return $user;
            }
        }
    }
    /**
    * Constructor to call get_Users with the parameters from config file
    */
    public function __construct()
    {
        //loads config file
        $config = parse_ini_file("config.ini");
        //retrieves users according to format
        $users=$this->get_Users($config["User_file"], $config["format"]);
    }
}

?>
