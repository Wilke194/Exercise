<?php
/**
 *
 *@access public
 *
 * @var int $userId Id of the users
 *
 * @var string $login
 *
 * @var string $password
 *
 * @var string $title
 *
 * @var string $lastName
 *
 * @var string $firstName
 *
 * @var string $gender
 *
 * @var string $email
 *
 * @var string $picture
 *
 * @var string $address
 */
class User
{
    private $userId;
    private $login;
    private $password;
    private $title;
    private $lastName;
    private $firstName;
    private $gender;
    private $email;
    private $picture;
    private $address;
    /**
     * displays one User as json
     *
     * @return void
     */
    public function display_User()
    {
        $display=array();
        foreach (get_object_vars($this)  as $key => $value) {
            $display[$key]=$value;
        }
        echo json_encode($display);
    }
    /**
     * Constructor to fill the fields of a user.
     *
     * @param int   $userId Id for the user to have
     *
     * @param array $user   associative array containing the users data
     */
    function __construct($userId,$user)
    {
        $this->userId=$userId;
        $this->firstName=$user["firstname"];
        $this->lastname=$user["lastname"];
        $this->login=$user["login"];
        $this->password=$user["password"];
        $this->title=$user["title"];
        $this->gender=$user["gender"];
        $this->email=$user["email"];
        $this->picture=$user["picture"];
        $this->address=$user["address"];
    }
    /**
     * getter function for ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->userId;
    }
    /**
     * getter function for firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * getter function for lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastname;
    }
}

?>
