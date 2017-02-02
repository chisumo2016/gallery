<?php include("includes/init.php"); ?>

<?php if(!$session->is_signed_in()){ redirect("login.php");}?>
    
<?php
// echo "it works";
if(empty($_GET['id'])){
  redirect ("users.php");
}
$users =User :: find_by_id($_GET['id']);
if($users){
	$session->message ("The {$user->username}user has been delete");

  $users->delete_photo();
  redirect("users.php");
}else{

  redirect("users.php");
}

?>