<?php
	include("../controller/main.php");
	$pid = $_GET['pid'];
	
	$main = new noniController();
	$post = $main->get_post($pid);
	$comments = $main->get_comments($pid);
	
	include('header.php');
?>
     <!-- start wrapper -->
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
 			 	<form class="col s12" method="POST" action="../controller/listener.php" id="submit_comment">
 					<div class="row">
   					<div class="input-field col l12 m12 s12">
     					<i class="mdi-editor-mode-edit prefix"></i>
      				<textarea id="user-comment" class="materialize-textarea"></textarea>
      				<label for="user-comment-label">What do you say?</label>
  					</div>
            <div class="col l12 m12 s12">
              <button class="btn waves-effect waves-light" id="submit-btn" type="submit" name="submit-comment">Submit
              <i class="mdi-content-send right"></i>
              </button>
            </div>
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
         
         <?php include('sidebar.php'); ?>
      </div>
     
         <!-- start footer -->
            <?php include('footer.php'); ?>
         <!-- end footer -->
     
     <!-- end wrapper -->
  
    </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
  $(document).ready(
    function() {
      $('#submit_comment').submit(function(e){
        var formData = {
          'phase' : 1,
          'userID' : 1,
          'postID' : <?php echo "$pid"; ?>,
          'comment' : $('#user-comment').val()
        }
        $.ajax({
          type: 'POST',
          url: '../controller/listener.php',
          dataType: 'json',
          data: formData
        })
        .done(function(resp){
          console.log(resp);

          //TO DO
          //refresh comments to show the added comment
          //Also, a user can't submit more than 1 comment to a post because of the following index http://i.imgur.com/PvpVffE.jpg
        })
        .fail(function(err){
          console.log(err);
        })
        e.preventDefault();
      })
	
    });
</script>
</body>
</html>