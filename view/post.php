<?php
	include("../controller/main.php");
	$pid = $_GET['pid'];
	
	//$main = new noniController();
	//$post = $main->get_post($pid);
	//$comments = $main->get_comments($pid);
	
	include('header.php'); 
?>
     <!-- start wrapper -->
       <div class="row">
       <!-- content -->
       
        <div id="post-comments-container" class="col m8">
        	<div id="post-container" style="display:none;">
                <div class="card">
                <!-- if else POST LINK -->
                <div class="card-content">
                  <span class="card-title post-title"></span>
                   <p class="post-text"></p>
                </div><!-- /POST LINK -->
                
                <!-- if else POST IMAGE -->
                 <div class="card-image">
                  <!--<span class="card-title">Card Title</span>-->
                </div><!--/POST IMAGE -->
                
                <div class="card-action">
                     <a href="#"><i class="mdi-hardware-keyboard-arrow-up"></i></a><div class="vote">2 votes</div><a href="#"><i class="mdi-hardware-keyboard-arrow-down"></i></a> posted by <span class="username"></span> <img src="" class="userprofilepic">
                </div>
              </div>
            </div><!--end of post container-->
            
            <!--loading circle -->
	        <div id="post-loading" style="display:none" class="preloader-wrapper big active">
			    <div class="spinner-layer spinner-blue-only">
			      <div class="circle-clipper left">
			        <div class="circle"></div>
			      </div><div class="gap-patch">
			        <div class="circle"></div>
			      </div><div class="circle-clipper right">
			        <div class="circle"></div>
			      </div>
			    </div>
			</div>
          
          <!-- start comments -->
          <div id="comments-container" style="display:none;">
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
              
              <h2 id="comments-heading"></h2>
               <div class="col m12">
                  <table class="comments-table">
                   <tbody>
                      
                 </tbody>
                 </table>
                </div>
             </div><!-- end of comments container-->
          
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
		
		//get post
        $.ajax({
          type: 'POST',
          url: '../controller/listener.php',
          dataType: 'json',
		  type: 'GET',
          data: { phase: 1, pid: <?php echo $pid; ?> },
		  beforeSend: function(){
				$('#post-loading').show();
				$('#post-container').hide();
			},
		  success: function(post) {
				$('#post-loading').hide();
				$('#post-container').show();
			},
        })
        .done(function(resp){
          console.log(resp);
			$(".post-title").text(resp.post_title);
			$(".post-text").text(resp.text);
			$(".card-image").html("<img src='"+resp.post_image+"' class='post-image' />");
			$(".username").text(resp.username);
			$(".userprofilepic").attr("src", resp.profile_img);
        })
        .fail(function(err){
          console.log(err);
        });
	
		//get comments by post id
        $.ajax({
          type: 'POST',
          url: '../controller/listener.php',
          dataType: 'json',
		  type: 'GET',
          data: { phase: 2, cid: <?php echo $pid; ?> },
		  beforeSend: function(){
				$('#post-loading').show();
				$('#comments-container').hide();
			},
		  success: function(post) {
				$('#post-loading').hide();
				$('#comments-container').show();
			},
        })
        .done(function(commentsObj){
          console.log(commentsObj);
		  var comment = ""; 
		  
		  $("#comments-heading").text(commentsObj.length+" comments");
		  for(var i in commentsObj)
		  {
			if (i % 2 == 0)
			{
				comment = '<tr class="odd-row">';
			} else comment = '<tr class="even-row">';
			comment = comment + '<td class="user-avatar-td"> <img src="'+commentsObj[i].profile_img+'" alt="" class="circle user-avatar"></td><td>'+commentsObj[i].username+'</td></tr><tr><td colspan="2" class="commentsbox">'+commentsObj[i].comment+'</td></tr>';
			$(".comments-table tbody").append(comment);
		  }
        })
        .fail(function(err){
          console.log(err);
        });
	
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
      });
	
    });
</script>
</body>
</html>