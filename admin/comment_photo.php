<?php include("includes/header.php"); ?>
        
        <?php if(!$session->is_signed_in()){ redirect("login.php");}?>
<!--Show the user-->
       
<?php
if(empty($_GET['id'])){
    redirect ("photos.php");
}

 $comments = Comment::find_the_comments($_GET['id']);


?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            
            
            
            <?php include("includes/top_nav.php");?>
            
            
            
            
            
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            
           
            
              <?php include("includes/side_nav.php");?>
            
            
            
            
            
            
            
            <!-- /.navbar-collapse -->
        </nav>
        
        
        
        
        
        
        

        <div id="page-wrapper">
            

        <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        All Comments
                            <!-- <small>Subheading</small> -->
                        </h1>
                            <!-- <a href="add_user.php" class="btn btn-primary">Add User</a> -->
                            <p class="bg-success"> <?php echo $message; ?> </p> 
                        <div class="col-md-12" >
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                   <th>Id</th>
                                   <th>Author</th>
                                   <th>Body</th>
                                   
                                 </tr>
                              </thead>
                              <tbody>
                                <!-- Loop -->
                                <?php  foreach ($comments as $comment): ?>
                                 <tr>
                                     <td><?php echo $comment->id;?></td>
                                    
                                    
                                    <td><?php echo $comment->author;?>

                                    <div class="actions_links">
                                        <a class="delete_link" href="delete_comment_photo.php?id=<?php echo $comment->id; ?>">Delete</a>
                                    
                                      </div>


                                    </td>
                                    <td><?php echo $comment->body;?></td>
                                                    
                 </tr>
                                 
                                  <?php endforeach; ?>
                                
                              </tbody>
                             
                           </table><!--End of Table-->
                            
                            
                            
                            
                            
                        </div>
<!--
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
-->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>