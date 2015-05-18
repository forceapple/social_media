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
					<a class="waves-effect waves-light btn modal-trigger" id="previewBtn" href="#previewWindow">Submit<i class="mdi-content-send right"></i></a>
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
         

        
      </div>

     
     <!-- end wrapper -->
     
  
  </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
	 
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
          data: { phase: 1, pid: <?php echo $_POST['pid']; ?> },
        })
        .done(function(post){
          console.log(post);
		  var card;
		  postType = post.post_type;
		  
		  	$("#link_title").focus();
		  	$("#link_title").val(post.post_title);
			if (postType == 0)
			{
				$("#link_url").focus();
				$("#link_url").val(post.text);
			} else if (postType == 1)
			{
				$("#url_field").hide();
				$("#text_field").show();
				$("#post_text").focus();
				$("#post_text").val(post.text);
			}
			
        })
        .fail(function(err){
          console.log(err);
        });
		
		$("#submitChangesBtn").click(function() {
			
			//udpate post
			$.ajax({
			  type: 'POST',
			  url: '../controller/listener.php',
			  dataType: 'json',
			  data: { phase: 2, pid: <?php echo $_POST['pid']; ?>, uid: 1, title: $("#link_title").val(), text: $("#post_text").val(), url: $("#link_url").val(), type: postType },
			})
			.done(function(updatePostObj){
			  		console.log(updatePostObj);
			  		toast(updatePostObj.message, 4000);
					//redirect to post page
					setTimeout(function () {
						window.location.href = "post.php?pid=<?php echo $_POST['pid']; ?>";
					}, 1000);
					
				})
				.fail(function(err){
				  console.log(err);
				  toast(err.errors, 4000)
				});
	
		});
})
	
</script>