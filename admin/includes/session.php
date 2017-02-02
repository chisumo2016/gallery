
<?php
   // Starting the session
  class Session{
      //Properties
      private $signed_in = false;
      public  $id;//user_id
      public $count;
      public $message;
	  
    // Constructor  
function __construct(){
 session_start();
 $this->visitor_count();//Call automatically the session when it start  
$this->check_the_login();  //Call automatically the session when it start 
$this->check_message(); 
          
}

 

// Getter function /method
public  function is_signed_in() {
    return $this->signed_in;    
}
      
//Function to login the user
public function login($user){  // Come from database
 if($user){
     $this->user_id = $_SESSION['id'] = $user->id;
    $this->signed_in =true;
    }      
}     
      //The Log out Method
public function logout(){
    unset($_SESSION['id']);
    unset($this->id);
    $this->signed_in = false;
}
      
//Checking login Method
private function check_the_login(){
    if(isset($_SESSION['id'])){
        $this->user_id = $_SESSION['id'];  //user_id
        $this->signed_in = true;
              
    }else {
              unset($this->id);//user_id
               $this->signed_in =false;  
          }
      }


  // Tracking Page Views Method

  public  function visitor_count(){

    if(isset($_SESSION['count'])){
         return $this->count = $_SESSION['count']++;
    }else{

      return $_SESSION['count']=1;  // adding one over and over
    }
  }

  private function check_message(){

    if(isset($_SESSION['message'])){
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    }else{

      $this->message ="";
    }
  }

   //Send and Receiving message
  public function message($msg=""){
    if(!empty($msg)){
      $_SESSION['message'] = $msg;
    }else{

      return $this->message; 
    }
  }






  }

 $session = new Session();
 $message = $session ->message();
?>