<?php include('header.php'); ?>
        	
     <!-- start wrapper -->
       <div class="row">
	       
       <!-- content -->
        <div id="content" class="col m8">
        	<h2 class="post-heading">Create New Post</h2>
	        <form action="../controller/listener.php" class="col l12 m12 s12 container" id="createPostForm" method="POST" data-parsley-validate>
			    <div class="row">
                <label>Post Type</label>
                  <select id="post-type-select" required>
                    <option value="" disabled selected>Choose what type of post</option>
                    <option value="0">Link only</option>
                    <option value="1">Image from external link</option>
                   
                  </select>
                  </div>
                   <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <input id="link_title" name="link_title" type="text" class="validate" required>
			        <label for="link_title">Title</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <input id="link_url" name="link_url" type="text" class="validate" required>
			        <label for="link_url">URL</label>
			      </div>
			    </div>
			    <div class="row">
			  		<a class="waves-effect waves-light btn" id="previewPostBtn" type="button">Post Preview</a>
                    <div id="previewPostContainer"></div>
			    </div>
			    <div class="row">
					<button class="btn waves-effect waves-light" type="submit" name="link_submit">Submit
					    <i class="mdi-content-send right"></i>
					</button>
			    </div>
			 </form>
       
          <!-- Post preview modal window message Structure -->
          <div id="PostPreviewError" class="modal">
            <div class="modal-content">
              <h4>Oops.. You need to choose a post type first!</h4>
              <p>How can we preview your post if you didn't choose a post type yet?</p>
            </div>
            <div class="modal-footer">
              <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">You're right, take me back. Duh.</a>
            </div>
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
      <script src="js/parsley.remote.min.js"></script>
	  <script src="js/parsley.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">
$('#createPostForm').parsley();

$(document).ready(function(){
	
    $('select').material_select();
	$('.modal-trigger').leanModal();
 
	$('#createPostForm').submit(function(e){
		var formData = {
			'phase' : 0,
			'uid' : 1,
			'title' : $('#link_title').val(),
			'url' : $('#link_url').val(),
			'type' : $("#post-type-select").val(),
		}

		console.log(formData);
		$.ajax({
			type: "POST",
			url: '../controller/listener.php',
			data: formData,
			dataType: 'json'
		})
		.done(function(resp){
			console.log(resp);
			 toast(resp.message, 4000)
		})
		.fail(function(err){
			console.log(err);
			toast(err.errors, 4000)
		})
		e.preventDefault();
	});
	
	$("#previewPostBtn").click(function(e){
		e.preventDefault();
		var postType= $("#post-type-select").val();
		var post_title = $("#link_title").val();
		var post_url = $("#link_url").val();
		
		if (!postType)
		{
			$('#PostPreviewError').openModal();
		} else {
			//determine post type
			if(postType == 0) 
			{
				//post type 0 = link only
				var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='"+post_url+"' target='_blank' class='post-link'>"+post_title+" by <span class='username'>TEST USER</span></a></span><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='#'># of comments</a></div></div>";
				$("#previewPostContainer").html(card);	
				
			}
			else if (postType == 1)
			{
				//post type 1 = image with external a link<br>
				$("#previewPostContainer").html("<div class='card'><div class='card-image'><a href='"+post_url+"' class='post-link'><img src='"+post_url+"' class='post-image'></a><span class='card-title'><span class='imageLink'><a href='#' class='post-link'>"+post_title+"</a></span> by <span class='username'>TEST USER</span></span></div><div class='card-content'><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>2 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='post.php'># of comments</a></div></div>");				
			}
		}
	});

})
	
</script>
</body>
</html>