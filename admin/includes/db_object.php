<?php
    
// Parent class
 class Db_object{
    
    // Checking Erorr onject
    public $errors =array();
    public $upload_errors_array = array(
          
    UPLOAD_ERR_OK => "There is no error",
    UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize disk",
    UPLOAD_ERR_FORM_SIZE =>"The uploaded file exceeds the MAX_FILE_SIZE drective",
    UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
    UPLOAD_ERR_NO_FILE => "No file was uploaded",
    UPLOAD_ERR_NO_TMP_DIR =>"Missing a temporary folder",
    UPLOAD_ERR_CANT_WRITE =>"Failed to write file to disk",
    UPLOAD_ERR_EXTENSION=>"A PHP extension stopped the file upload"
    
    );


    //Setting Up Image for user -grabbing from photo

     public function set_file($file){
          //error checking
          if(empty($file) || !$file || !is_array($file)){
              $this->errors[] ="There was no file uploaded here";
              return false; 
              // Check if the file is uploaded 
          }elseif($file['error'] !==0){
          
          $this->error[] = $this->upload_errors_array[$file['error']];
          return false;
              
          }else {
              //Submit data 
           $this->user_image = basename($file['name']); //basename is function
           $this->tmp_path = $file['tmp_name'];
           $this->type = $file ['type'];
           $this->size = $file ['size'];
      }
  }


     
    
     // Find users from database //late static binding
    //public static function find_all_users() { change into abstarct
    public static function find_all() {
        global $database;
        //return static::find_this_query("SELECT * FROM users");
//        return self::find_this_query("SELECT * FROM " .static::$db_table . "");// Disabled bse  i am inheritance 
         //return $this->find_this_query("SELECT * FROM " .static::$db_table . "");
         return static::find_by_query("SELECT * FROM " . static::$db_table . " ");

    }
     
        //Find user id  using our instantion Method to find 1 user
       //public static function find_user_by_id($user_id) { change it bse of abstarct metho
       public static function find_by_id($id) {
        global $database;
        //$the_result_array = static::find_this_query("SELECT * FROM users WHERE id =$user_id LIMIT 1");
        $the_result_array = static::find_by_query("SELECT * FROM "  . static::$db_table ." WHERE id =$id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;


        //return  $found_user;
    }
     
     // Find a query method
         public static function find_by_query($sql){
         global $database;
         $result_set = $database->query($sql);
         $the_object_array = array();
         while($row = mysqli_fetch_array($result_set)){
            
         $the_object_array[] = static::instantation($row);// Getting array
         }

         return $the_object_array;
     }
     
     
     //Testing the Instantiaon method
     public static function instantation($the_record){  //Its the same as $row
        //$the_object = new self; // Bse of inheritance problem ,this as to change in late static
         $calling_class = get_called_class();
         $the_object = new $calling_class;
        
                        
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
         //foreach(self::$db_table_fields as $db_field){
         foreach(static::$db_table_fields as $db_field){
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
         $sql = "INSERT INTO " .static::$db_table. "(".implode(",",array_keys($properties)).")";  
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
         $sql = "UPDATE " .static::$db_table. " SET ";  // we use the abstract tables
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
          $sql = "DELETE FROM " .static::$db_table . " "; // space is for where  // Change self to late static binding
          $sql .="WHERE id =" . $database->escape_string($this->id);
          $sql .= " LIMIT 1";
         
         // Send the query to a databse  using iternally instead of if
          $database->query($sql);
          return (mysqli_affected_rows($database->connection) ==1) ? true : false;
    } // End of Delete
       

      //Create the count All method  and echoing photo count

    public static function count_all(){
      global $database;
      $sql ="SELECT count(*) FROM ".static::$db_table;
      $result_set=$database->query($sql);
      $row =mysqli_fetch_array($result_set);

      return array_shift($row);

    }


 }

?>