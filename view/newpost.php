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
                    <option value="0" selected>URL</option>
                    <option value="2">Text</option>
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
					<button class="btn waves-effect waves-light" type="submit" name="link_submit">Submit
					    <i class="mdi-content-send right"></i>
					</button>
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
		var text;
		//check if URL or text
		if ($("#post-type-select").val() == 0)
		{
			//text and URL	
			text = $('#link_url').val();
		} else text = $("#post_text").val();
		
		var formData = {
			'phase' : 0,
			'uid' : 1,
			'title' : $('#link_title').val(),
			'text' : text,
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
	


})
	
</script>
</body>
</html>