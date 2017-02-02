<?php include("includes/init.php"); ?>

<?php if(!$session->is_signed_in()){ redirect("login.php");}?>
    
<?php

// Delete  comments is the same as users
// echo "it works";
if (empty($_GET['id'])){
  redirect ("comments.php");
}
$comments =Comment :: find_by_id($_GET['id']);
if ($comments){

  $comments->delete();
  $session ->message("The comment with {$comment->id} has been deleted");
  redirect("comments.php");
}else{

  redirect("comments.php");
}

?>