<?php
	include("../controller/main.php");
	$pid = $_GET['pid'];

	include('header.php'); 
?>
     <!-- start wrapper -->
       <div class="row">
       <!-- content -->
       
        <div id="post-comments-container" class="col m8">
        	<div id="post-container" style="display:none;">
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
                        <textarea id="user-comment" class="materialize-textarea" data-parsley-error-message="You forgot to write your comment, Noni lover!" required></textarea>
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
      <script src="js/parsley.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
	  $('#submit_comment').parsley();
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
        .done(function(post){
          console.log(post);
		  var card;
			
			
			var postType = post.post_type;
			//determine post type
				if(postType == 0) 
				{
					//post type 0 = text or link only
					card = "<div class='card'><div class='card-content'><span class='card-title'><a href='"+post.text+"' target='_blank' class='post-link'>"+post.post_title+"</a></span><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a>by <span class='username'>"+post.username+"</span> <img src='"+post.profile_img+"' class='userprofilepic'><div class='post-options'><a href='edit.php?pid="+post.pid+"'>edit</a> <a href='#'>save</a> <a href='#'>delete</a></div></div></div></div>";
				}
				else if (postType == 1)
				{
					//post type 1 = image with external a link
					card = "<div class='card'><div class='card-image'><a href='post.php?pid="+post.pid+"' class='post-link'><img src='"+post.post_image+"' class='post-image'></a><span class='card-title'><span class='imageLink'><a href='post.php?pid="+post.pid+"' class='post-link'>"+post.post_title+"</a></span></span></div><div class='card-content'><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a>by <span class='username'>"+post.username+"</span> <img src='"+post.profile_img+"' class='userprofilepic'><div class='post-options'><a href='edit.php?pid="+post.pid+"'>edit</a> <a href='#'>save</a> <a href='#'>delete</a></div></div></div>";				
				}
				else if (postType == 2)
				{
					//post type 2 = text only
					var card = "<div class='card'><div class='card-content'><span class='card-title blue-text text-darken-2'>"+post.post_title+"</span><p>"+post.text+"</p></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a>by <span class='username'>"+post.username+"</span> <img src='"+post.profile_img+"' class='userprofilepic'><div class='post-options'><a href='edit.php?pid="+post.pid+"'>edit</a> <a href='#'>save</a> <a href='#'>delete</a></div></div></div>";
										
				}	
			
			$("#post-container").append(card);
			getComments();
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
				getComments();
				toast(resp.message);
			  //TO DO
			  //DONE ->//refresh comments to show the added comment
			  //Also, a user can't submit more than 1 comment to a post because of the following index http://i.imgur.com/PvpVffE.jpg
			})
			.fail(function(err){
			  console.log(err);
			})
			e.preventDefault();
      });
	
    });
	
		//get comments by post id
		function getComments() {
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
				}
			})
			.done(function(commentsObj){
			  console.log(commentsObj);
			  var comment = ""; 
			  var num_comments = commentsObj.length;
			  var nullFlag = false;
			  
			  $(".comments-table tbody").empty();
			  if (commentsObj[0].cid === null)
			  {
				  num_comments = "No";
				  nullFlag = true;
			  }
			  $("#comments-heading").text( num_comments+" comments");
			  
			  if (!nullFlag) 
			  {
					for(var i in commentsObj)
				  {
					if (i % 2 == 0)
						comment = '<tr class="odd-row">';
					else comment = '<tr class="even-row">';
					comment = comment + '<td class="user-avatar-td"> <img src="'+commentsObj[i].profile_img+'" alt="" class="circle user-avatar"></td><td>'+commentsObj[i].username+'</td></tr><tr><td colspan="2" class="commentsbox">'+commentsObj[i].comment+'</td></tr>';
					$(".comments-table tbody").append(comment);
				  }  
			  }
			  
			})
			.fail(function(err){
			  console.log(err);
			});
		}
</script>
</body>
</html>