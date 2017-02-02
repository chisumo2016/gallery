<?php

 
//Inheritance 
 class User extends Db_object{
     // Assign 
     protected static $db_table = "users"; // Abstracting table
     protected static $db_table_fields = array('username','password','first_name','last_name','user_image'); // Modifying the properties method
     public $id;
     public $username;
     public $password;
     public $first_name;
     public $last_name;
     public $user_image;
     public $upload_directory = "images";
     public $image_placeholder = "http://placehold.it/400x400&text=image";  

      
   // Save method  user and image
     public function upload_photo(){
        
          // if($this->id) {
          //     $this->update();
          // }else{
              //Updating user Modification
          if(!empty($this->errors)){
                  return false;
              }
              // Check if the file empty
          if(empty($this->user_image) || empty($this->tmp_path)){
                  $this->errors[] ="The file was not available";
                  return false;
              }
               //Target paths
               //$target_path = SITE_ROOT  .DS . 'admin' .DS. $this->upload_directory.DS. $this->user_image;
              $target_path = "C:" .DS. "xampp" .DS . "htdocs" .DS. "gallery" .DS.'admin' .DS. $this->upload_directory.DS. $this->user_image;
              
              if(file_exists($target_path)){
                  
                  $this->errors[] = "The file {$this->user_image} already exists";
                  return false; 
              }
              
              //move_uploaded_file(user_image, destination)
              if(move_uploaded_file($this->tmp_path, $target_path)){
                  
                  // if($this->create()){
                      unset($this->tmp_path);//taking out tmp_path
                      return true;
                  //}
                  
              }else{
                  
                  // Placing customs string
                  
                  $this->errors[] = "The file directory probably  does not have permission";
                  return false;      
              }
          //}  
      }
      


 
     //Method to verify the user method
    public static function verify_user($username, $password){
    global $database;
    $username = $database ->escape_string($username);
    $password =$database ->escape_string($password);
          
    //$sql = "SELECT *FROM users WHERE ";  i have change this bse of abstract method
    $sql = "SELECT *FROM " .self::$db_table ." WHERE "; //self 
    $sql .= "username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    // Return  the data back 
     $the_result_array = self::find_by_query($sql);   //self
     return  !empty($the_result_array) ? array_shift($the_result_array) : false;  
          
      }

      //Working with user Image

      public function image_path_and_placeholder(){
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory."/".$this->user_image;
      }


      //Creating the Ajax PHP method

  public function ajax_save_image($user_image, $user_id){
    
    global $database;

    $user_image = $database->escape_string($user_image);
    $user_id = $database->escape_string($user_id);

    $this->user_image =$user_image;
    $this->id         =$user_id;

    $sql = "UPDATE ". self::$db_table . " SET user_image = '{$this->user_image}' ";
    $sql .= " WHERE id = {$this->id} ";
    $update_image = $database->query($sql);


    echo $this->image_path_and_placeholder();
    
    //$this->save();  

  }


  // Delete Picture

     public function delete_photo(){
        
          //delete data from the table
          if($this->delete()){
              $target_path =  SITE_ROOT .DS. 'admin' .DS. $this->upload_directory. DS. $this->user_image;
              return  unlink($target_path) ? true : false; // Will delete the file
          }else{
              
              return false;
          }
      }



} // End of user class

?>