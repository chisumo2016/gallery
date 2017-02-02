
<?php
// Undeclare Object Backup Function (Autoload)


function __autoload($class){
    
$class= strtolower($class);
    
$the_path = "includes/{$class}.php";
    
if(file_exists($the_path)){
require_once($the_path);

}else{
        
        die("This file name{$class}.php was not found...");
    }
    
}
////Page redirection

function redirect($location){
        
    //Direct to login page
     header("Location: {$location}");  
}

?>