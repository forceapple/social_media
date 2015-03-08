<?php
	include("../controller/main.php");
	$pid = $_GET['pid'];
	
	$main = new noniController();
	$post = $main->get_post($pid);
	$comments = $main->get_comments($pid);
	
?>

<!doctype html>
<html>
<head>
<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Let browser know website is optimized for mobile-->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <title>Reddit?</title>

</head>

<body>
	<div class="container">
    	<div class="row">
        	<div class="col s12" id="header"><a href="index.php">NONI</a></div>
        </div>
  
     <!-- start container -->
       <div class="row">
       <!-- content -->
        <div class="col m8">
          <div class="card">
          
   			<!-- if else POST LINK -->
            <div class="card-content">
              <span class="card-title post-title"><?php echo $post['post_title']; ?></span>
               <p><?php echo $post['text']; ?></p>
            </div><!-- /POST LINK -->
            
            <!-- if else POST IMAGE -->
             <div class="card-image">
              <img src="<?php echo $post['post_image']; ?>" class="post-image">
              <!--<span class="card-title">Card Title</span>-->
            </div><!--/POST IMAGE -->
            
            
            <div class="card-action">
            	 <a href="#"><i class="mdi-hardware-keyboard-arrow-up"></i></a><div class="vote">2 votes</div><a href="#"><i class="mdi-hardware-keyboard-arrow-down"></i></a> posted by <span class="username"><?php echo $post['username']; ?></span> <img src="<?php echo $post["profile_img"]; ?>" class="userprofilepic">
            </div>
          </div>
          
          <!-- start comments -->
          <div class="row">
 			 	<form class="col s12">
   					<div class="row">
     					<div class="input-field col s12">
     					<i class="mdi-editor-mode-edit prefix"></i>
        				<textarea id="user-comment" class="materialize-textarea"></textarea>
        				<label for="user-comment-label">What do you say?</label>
      					</div>
      					 <button class="btn waves-effect waves-light" id="submit-btn" type="submit" name="submit-comment">Submit
    					<i class="mdi-content-send right"></i>
 						 </button>
    				</div>
  				</form>
			</div>
          
          <h2><?php echo count($comments); ?> comments</h2>
          	
           <div class="col m12">
           		<table  class="comments-table">
               <tbody>
               		<?php 
						
						foreach ($comments as $i => $comment)
						{
							if ($i % 2 == 0)
								echo "<tr class='even-row'>";
							else echo "<tr class='odd-row'>";
							echo "<td class='user-avatar-td'> <img src='".$comment["profile_img"]."' alt='' class='circle user-avatar'></td>
							<td>".$comment["username"]."</td>
					  		</tr>
					  		<tr>
							<td colspan='2' class='commentsbox'>".$comment["comment"]."</td>
					 		 </tr>";
						}
					
                  	?>
       		 </tbody>
             </table>
			</div>
          
         </div><!-- /content-->
         
         <!-- sidebar: username? -->
          <div class="col m4">
           <form id="insertUserForm">
        <div class="row block-content">
        	<div class="col">
        		<div class="form-group center med-content">
                    	<label>Username</label>
                           <input type="text" class="form-control" id="uid" value="1" placeholder="user ID" required>
               </div>
           </div>
    		<button id="loginButton" class="btn waves-effect waves-light btn-large" type="submit" name="action">LOGIN<i class="mdi-hardware-keyboard-alt right"></i></button>
           <div id="insertUserMsgBox" class="col s3 center med-content">	
           </div>
        </div>
        </form>
        </div><!-- end sidebar -->
      </div>
     
     <!-- end CONTAINER -->
     
  
    </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
  $(document).ready(
    function() {
	
    });
</script>
</body>
</html>