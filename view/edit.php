<?php include('header.php'); 
	$pid = $_GET['pid'];

?>
        	
     <!-- start wrapper -->
       <div class="row">
	       
       <!-- content -->
        <div id="content" class="col m8">
        	<h2 class="post-heading">Edit Post</h2>
	        <form action="../controller/listener.php" class="col l12 m12 s12 container" id="createPostForm" method="POST" data-parsley-validate>
			    <div class="row">
               
                  </div>
                  
                   <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <input id="link_title" name="link_title" type="text" class="validate" data-parsley-error-message="Title is required." required>
			        <label for="link_title">Title</label>
			      </div>
			    </div>
			    <div class="row" id="change_field">
			      <div class="input-field col l12 m12 s12" id="url_field">
			        <input id="link_url" name="link_url" type="url" data-parsley-error-message="URL is required." required>
			        <label for="link_url">URL</label>
			      </div>
                   <div class="input-field col l12 m12 s12" id="text_field" style="display:none;">
			        <input id="post_text" name="post_text" type="text" data-parsley-error-message="Some text is required." required>
			        <label for="post_text">Text</label>
			      </div>
			    </div>
			    
			    <div class="row">
					<!--<a class="waves-effect waves-light btn modal-trigger" id="previewBtn" href="#previewWindow">Submit<i class="mdi-content-send right"></i></a>-->
                    <a class="waves-effect waves-light btn modal-trigger" id="previewBtn">Submit<i class="mdi-content-send right"></i></a>
			    </div>

              <!-- Modal Structure -->
          <div id="previewWindow" class="modal modal-fixed-footer">
            <div class="modal-content">
              <h4>Preview your changes</h4>
              <p>Are you happy with this?</p>
              <div id="post-container"></div>
            </div>
            <div class="modal-footer"> 
              <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">No, I changed my mind</a> <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close" id="submitChangesBtn">Yes</a>
            </div>
          </div>
          </form>
            
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
<script type="text/javascript">
$('#createPostForm').parsley();

$(document).ready(function(){
	 
	 $('.modal-trigger').leanModal();
	 var postType;
	 
	//get post
        $.ajax({
          url: '../controller/listener.php',
          dataType: 'json',
		  type: 'GET',
          data: { phase: 1, pid: <?php echo $pid; ?> },
        })
        .done(function(post){
          console.log(post);
		  var card;
		  postType = post.post_type;
		  
		  	$("#link_title").focus();
		  	$("#link_title").val(post.post_title);
			if (postType == 0 || postType == 1)
			{
				$("#link_url").focus();
				$("#link_url").val(post.post_image);
			} else if (postType == 2)
			{
				$("#url_field").hide();
				$("#text_field").show();
				$("#post_text").focus();
				$("#post_text").val(post.text);
			}
			
			/*$("#previewBtn").click(function(e){

			//get new data
				var title = $("#link_title").val();
				var url = $("#link_url").val();
				var text = $("#post_text").val();
				
			//determine post type
				if(postType == 0) 
				{
					//post type 0 = title and link only
					card = "<div class='card'><div class='card-content'><span class='card-title'><a href='"+url+"' target='_blank' class='post-link'>"+title+"</a></span><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href=''><i class='mdi-communication-forum'></i> 0</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'>"+post.username+"</span> <img src='"+post.profile_img+"' class='userprofilepic'></div></div></div>";
				}
				else if (postType == 1)
				{
					//post type 1 = image with external a link
					card = "<div class='card'><div class='card-image'><a href='post.php?pid="+post.pid+"' class='post-link'><img src='"+url+"' class='post-image'></a><span class='card-title'><span class='imageLink'><a href='post.php?pid="+post.pid+"' class='post-link'>"+title+"</a></span></span></div><div class='card-content'><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href=''><i class='mdi-communication-forum'></i> 0</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'>"+post.username+"</span> <img src='"+post.profile_img+"' class='userprofilepic'></div></div>";				
				}
				else if (postType == 2)
				{
					//post type 2 = title and text only
					var card = "<div class='card'><div class='card-content'><span class='card-title blue-text text-darken-2'>"+title+"</span><p>"+text+"</p></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href=''><i class='mdi-communication-forum'></i> 0</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'>"+post.username+"</span> <img src='"+post.profile_img+"' class='userprofilepic'></div></div>";
										
				}	
			
			$("#post-container").html(card);
		});*/
			
        })
        .fail(function(err){
          console.log(err);
        });
		
		$("#previewBtn").click(function() {
			
			//udpate post
			$.ajax({
			  type: 'POST',
			  url: '../controller/listener.php',
			  dataType: 'json',
			  data: { phase: 2, pid: <?php echo $pid; ?>, uid: 1, title: $("#link_title").val(), text: $("#post_text").val(), url: $("#link_url").val(), type: postType },
			})
			.done(function(updatePostObj){
			  		console.log(updatePostObj);
			  		toast(updatePostObj.message, 4000);
					console.log("test"+$("#post_text").val());
					console.log($("#link_url").val());
					
				})
				.fail(function(err){
				  console.log(err);
				  toast(err.errors, 4000)
				});
	
		});

})
	
</script>
</body>
</html>