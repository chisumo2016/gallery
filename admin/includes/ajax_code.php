<?php require("init.php");
    $user = new User();
    //$photo = new Photo();


    if(isset($_POST['image_name'])){

    $this->ajax_save_image($_POST['user_image'],$_POST['user_id']);
    	//echo "This is data from the Server Lovely";
    }
        //Photo Library sidebar 

    if(isset($_POST['photo_id'])){

      Photo::display_sidebar_data($_POST['photo_id']);
    	// echo "It Works";


    }

  
 ?>