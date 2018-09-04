<?php
/**
 *
 */
class User
{
   private $user_id;
   private $first_name;
   private $last_name;
   private $login;
   private $password;
   private $title;
   private $gender;
   private $email;
   private $picture;
   private $address;
   /**
    *
    * displays one User as json
    *
    *
    * @return void
    *
    */
   function display_User()
   {
       $display=array();
       foreach (get_object_vars(this)  as $key => $value) {
           $display[$key]=$value;
       }
       echo json_encode($display);
   }

  function __construct($user_id,$user)
  {
    $user_id=$user_id;
    $first_name=$user["firstName"];
    $last_name=$user["lastName"];
    $login=$user["login"];
    $password=$user["password"];
    $title=$user["title"];
    $gender=$user["gender"];
    $email=$user["email"],;
    $picture=$user["picture"];
    $address=$user["address"];
  }
  public function getId()
  {
    return $user_id;
  }
  public function get_first_name(){
    return $first_name;
  }
  public function get_last_name()
  {
    return $last_name;
  }
}

 ?>
