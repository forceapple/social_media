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
					<button class="btn waves-effect waves-light" type="submit" name="link_submit">Submit
					    <i class="mdi-content-send right"></i>
					</button>
			    </div>
			 </form>
    
          <div id="post-container" style="display:none;">
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
	  <script src="js/parsley.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">
$('#createPostForm').parsley();

$(document).ready(function(){
	 
	//get post
        $.ajax({
          type: 'POST',
          url: '../controller/listener.php',
          dataType: 'json',
		  type: 'GET',
          data: { phase: 1, pid: <?php echo $pid; ?> },
        })
        .done(function(post){
          console.log(post);
		  var card;
		  
		  	$("#link_title").focus();
		  	$("#link_title").val(post.post_title);
				
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
			
        })
        .fail(function(err){
          console.log(err);
        });
	
	$("#previewPostBtn").click(function(e){
		e.preventDefault();
		var postType= $("#post-type-select").val();
		var post_title = $("#link_title").val();
		var post_url = $("#link_url").val();
		var post_text = $("#post_text").val();
		
		//$('#createPostForm').parsley().validate();
		
		if (!postType)
		{
			$('#PostPreviewError').openModal();
		} else if ($('#createPostForm').parsley().validate())
		{
			//determine post type
			if(postType == 0) 
			{
				//post type 0 = link only
				var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='"+post_url+"' target='_blank' class='post-link'>"+post_title+"</a></span><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='#'># of comments</a>by <span class='username'>TEST USER</span></div></div>";
				$("#previewPostContainer").html(card);	
				
			}
			else if (postType == 1)
			{
				//post type 1 = image with external a link<br>
				$("#previewPostContainer").html("<div class='card'><div class='card-image'><a href='"+post_url+"' class='post-link'><img src='"+post_url+"' class='post-image'></a><span class='card-title'><span class='imageLink'><a href='#' class='post-link'>"+post_title+"</a></span></span></div><div class='card-content'><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php'># of comments</a>by <span class='username'>TEST USER</span></div></div>");				
			}
			else if (postType == 2)
			{
				//post type 2 = text only
				var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='#' target='_blank' class='post-link'>"+post_title+"</a></span><p>"+post_text+"</p></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='#'># of comments</a>by <span class='username'>TEST USER</span></div></div>";
				$("#previewPostContainer").html(card);					
			}	
		}
	});

})
	
</script>
</body>
</html>