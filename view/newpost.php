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
                    <option value="2">Plain text</option>
                  </select>
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
	  <script src="js/parsley.min.js"></script>
<script type="text/javascript">
$('#createPostForm').parsley();

$(document).ready(function(){
	
    $('select').material_select();
	
	$('#post-type-select').change(function() {
		var postType = $('#post-type-select').val();
		if (postType==0 || postType==1)
		{
			$("#text_field").hide();
			$("#post_text").prop("required", false);
			$("#url_field").show();
			$("#link_url").prop("required", true);
		} else if (postType == 2)
		{
			$("#text_field").show();
			$("#post_text").prop("required", true);
			$("#url_field").hide();	
			$("#link_url").prop("required", false);
		}
	});
	
	$('.modal-trigger').leanModal();
 
	$('#createPostForm').submit(function(e){
		var formData = {
			'phase' : 0,
			'uid' : 1,
			'title' : $('#link_title').val(),
			'url' : $('#link_url').val(),
			'type' : $("#post-type-select").val(),
			'text' : $("#post_text").val(),
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
			 toast(resp.message, 4000);
			 //redirect to post page
			setTimeout(function () {
				//window.location.href = "post.php?pid=<?php echo $pid; ?>";
				window.location.href = "index.php";
			}, 1000);
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
				var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='"+post_url+"' target='_blank' class='post-link'>"+post_title+"</a></span><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='#'><i class='mdi-communication-forum'></i> 0</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'>TEST USER</span></div></div>";
				$("#previewPostContainer").html(card);	
				
			}
			else if (postType == 1)
			{
				//post type 1 = image with external a link
				$("#previewPostContainer").html("<div class='card'><div class='card-image'><a href='"+post_url+"' class='post-link'><img src='"+post_url+"' class='post-image'></a><span class='card-title'><span class='imageLink'><a href='#' class='post-link'>"+post_title+"</a></span></span></div><div class='card-content'><!-- if you wanna put <p> text --></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='#'><i class='mdi-communication-forum'></i> 0</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'>TEST USER</span></div></div>");				
			}
			else if (postType == 2)
			{
				//post type 2 = text only
				var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='#' target='_blank' class='post-link'>"+post_title+"</a></span><p>"+post_text+"</p></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='#'><i class='mdi-communication-forum'></i> 0</a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'>TEST USER</span></div></div>";
				$("#previewPostContainer").html(card);					
			}	
		}
	});

})
	
</script>
</body>
</html>