<?php

  class Photo extends Db_object{
      
      // Adding the class properties
     protected static $db_table = "photos"; // Abstracting table
     protected static $db_table_fields = array('id','title','caption','description','filename','alternate_text','type','size'); // Modifying the properties method
     public $id;
     public $title;
     public $caption;
     public $description;
     public $filename;
     public $alternate_text;
     public $type;
     public $size;
    
      
      // Setting Up properties Array
      
      public $tmp_path;
      public $upload_directory = "images";
      public $errors =array(); // Will display to the user
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
      
      // Set File Method
      
      /* This is passing $_FILES['uploaded_file'] as argument*/
      
      public function set_file($file){
          //error checking
          if(empty($file) || !$file || !is_array($file)){
              $this->errors[] ="There was no file uploaded here";
              return false; 
              // Check if the file is uploaded 
          }elseif($file['error'] !==0){
          
          $this->error[] = $this->upload_errors_arrays[$file['error']];
          return false;
              
          }else {
              //Submit data 
           $this->filename = basename($file['name']); //basename is function
           $this->tmp_path = $file['tmp_name'];
           $this->type = $file ['type'];
           $this->size = $file ['size'];
      }
  }
      // Dynamic image Path
      public function picture_path(){
          
          return $this->upload_directory.DS.$this->filename;
//          return $this->upload_directory."/".$this->filename;
      }
      
      // Save method part 1 field into database
      public function save(){
        
          if($this->id) {
              $this->update();
          }else{
              
          if(!empty($this->errors)){
                  return false;
              }
              // Check if the file empty
          if(empty($this->filename) || empty($this->tmp_path)){
                  $this->errors[] ="The file was not available";
                  return false;
              }
               //Target paths
               //$target_path = SITE_ROOT  .DS . 'admin' .DS. $this->upload_directory.DS. $this->filename;
              $target_path = "C:" .DS. "xampp" .DS . "htdocs" .DS. "gallery" .DS.'admin' .DS. $this->upload_directory.DS. $this->filename;
              
              if(file_exists($target_path)){
                  
                  $this->errors[] = "The file {$this->filename} already exists";
                  return false; 
              }
              
              //move_uploaded_file(filename, destination)
              if(move_uploaded_file($this->tmp_path, $target_path)){
                  
                  if($this->create()){
                      unset($this->tmp_path);//taking out tmp_path
                      return true;
                  }
                  
              }else{
                  
                  // Placing customs string
                  
                  $this->errors[] = "The file directory probably  does not have permission";
                  return false;      
              }
          }  
      }
      
      public function delete_photo(){
          
          //delete data from the table
          if($this->delete()){
              $target_path =  SITE_ROOT .DS. 'admin' .DS. $this->picture_path();
              return  unlink($target_path) ? true : false; // Will delete the file
          }else{
              
              return false;
          }
      }

  }
?>


