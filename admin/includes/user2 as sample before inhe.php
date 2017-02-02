<?php

 

 class User extends Db_object{
     // Assign 
     protected static $db_table = "users"; // Abstracting table
     protected static $db_table_fields = array('username','password','first_name','last_name'); // Modifying the properties method
     public $id;
     public $username;
     public $password;
     public $first_name;
     public $last_name;
    
  // Find users from database
    //public static function find_all_users() { change into abstarct
    public static function find_all() {
        global $database;
        //return self::find_this_query("SELECT * FROM users");
        return self::find_this_query("SELECT * FROM " .self::$db_table . "");

    }
     
        //Find user id  using our instantion Method to find 1 user
       //public static function find_user_by_id($user_id) { change it bse of abstarct metho
       public static function find_by_id($user_id) {
        global $database;
        //$the_result_array = self::find_this_query("SELECT * FROM users WHERE id =$user_id LIMIT 1");
        $the_result_array = self::find_this_query("SELECT * FROM"  .self::$db_table ." WHERE id =$user_id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
        return  $found_user;
    }
     
     
 
     //Method to verify the user method
    public static function verify_user($username, $password){
    global $database;
    $username = $database ->escape_string($username);
    $password =$database ->escape_string($password);
          
    //$sql = "SELECT *FROM users WHERE ";  i have change this bse of abstract method
    $sql = "SELECT *FROM " .self::$db_table ." WHERE ";  
    $sql .= "username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    // Return  the data back 
     $the_result_array = self::find_this_query($sql);
     return  !empty($the_result_array) ? array_shift($the_result_array) : false;  
          
      }
     
     //Testing the Instantiaon method
     public static function instantation($the_record){  //Its the same as $row
         
         $the_object = new self;
                        
//        $the_object->id =$found_user['id'];
//        $the_object->username =$found_user['username'];
//        $the_object->password =$found_user['password'];
//        $the_object->First_Name =$found_user['first_name'];
//        $the_object->Last_Name =$found_user['last_name'];
//        
         foreach ($the_record as $the_attribute =>$value){
             if ($the_object->has_the_attribute($the_attribute)){
                 
                 $the_object->$the_attribute=$value;  // Value is attribute in database
             }   
         }
         return   $the_object;                  
         
     }
       // Creating the attribute finder method
     private function  has_the_attribute($the_attribute){
         
         $object_properties = get_object_vars($this); //Function get_object_vars
         
        return array_key_exists($the_attribute, $object_properties);
     }
     
     // Abstracting the create Method
     
     protected function properties(){
         //return get_object_vars($this);
         $properties = array();
         foreach(self::$db_table_fields as $db_field){
             if(property_exists($this, $db_field)){
                 
                 $properties[$db_field] = $this->$db_field;
             }
         }
         return $properties;

     }
     
     //Escape values from abstract method
     
     public function clean_properties(){
             global $database;
         $clean_properties = array();
         foreach ($this->properties() as $key =>$value){
             $clean_properties[$key] =$database->escape_string($value);
         }
         
         return $clean_properties ;
         
         
     }
        
         
     
     //Improving  the create method (Abstraction)
     public function save(){
         return isset($this->id) ? $this->update() : $this->create();
        
     }
    
     // Create a user
      public function create(){
      global $database;
          
          //$properties = $this->properties();
          $properties = $this->clean_properties();
         
//         $sql = "INSERT INTO users (username,password,first_name,last_name)";
//         $sql = "INSERT INTO " .self::$db_table. "(username,password,first_name,last_name)";  
         $sql = "INSERT INTO " .self::$db_table. "(".implode(",",array_keys($properties)).")";  
         $sql .= "VALUES ('". implode("','",array_values($properties)) ."')";
//         $sql .= $database->escape_string($this->username) . "', '";
//         $sql .= $database->escape_string($this->password) . "', '";
//         $sql .= $database->escape_string($this->first_name) . "', '";
//         $sql .= $database->escape_string($this->last_name) . "')";
         
         if($database->query($sql)){
             $this->id = $database->the_insert_id();
             return true;
         }else{
             
              return false;
             
             
              }
  
     }// End of create method
     
     //Abstracting the update method
     public function update() {
         global $database;
         //$properties = $this->properties();
         $properties = $this->clean_properties();
         $properties_pairs = array();
         foreach ($properties as $key =>$value){
              $properties_pairs[] = "{$key}='{$value}'";
             
         }
         
//         $sql = "UPDATE users SET ";
         $sql = "UPDATE " .self::$db_table. " SET ";  // we use the abstract tables
         $sql .=implode(",", $properties_pairs);
//         $sql .="username = '" .$database->escape_string($this->username)   ."', ";
//         $sql .="password = '" .$database->escape_string($this->password)   ."', ";
//         $sql .="first_name = '" .$database->escape_string($this->first_name)   ."', ";
//         $sql .="last_name = '" .$database->escape_string($this->last_name) ."' ";
          $sql .=" WHERE id =" .$database->escape_string($this->id);
         
         // Send the query to a databse  using iternally instead of if
         $database->query($sql);
          return (mysqli_affected_rows($database->connection) ==1)? true : false;
     }// End of updade method
     
     
     public function delete(){
         global $database;
         
            //$sql = "DELETE FROM users ";
          $sql = "DELETE FROM " .self::$db_table . " "; // space is for where
          $sql .="WHERE id =" . $database->escape_string($this->id);
          $sql .= " LIMIT 1";
         
         // Send the query to a databse  using iternally instead of if
          $database->query($sql);
          return (mysqli_affected_rows($database->connection) ==1) ? true : false;
    } // End of Delete
         

} // End of user class



?>