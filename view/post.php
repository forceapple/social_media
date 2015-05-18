<?php
	
	//echo $_GET['pid'];

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
              
              <h3 id="comments-heading"></h3>
               <div class="col m12">
                  <table class="comments-table">
                   <tbody>
                 </tbody>
                 </table>
                </div>
             </div><!-- end of comments container-->
             
             <!-- delete post modal window  -->
          <div id="deleteWindow" class="modal">
            <div class="modal-content">
              <h4>Delete this Post</h4>
              <p>Are you sure about this?</p>
            </div>
            <div class="modal-footer"> 
              <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">No</a> <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close" id="confirmDeleteBtn">Yes</a>
            </div>
          </div>
          
          <!-- delete comment modal window  -->
          <div id="deletecommentWindow" class="modal">
            <div class="modal-content">
              <h4>Delete this Comment</h4>
              <p>Are you sure about this?</p>
            </div>
            <div class="modal-footer"> 
              <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">No</a> <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close" id="confirmDeleteCommentBtn">Yes</a>
            </div>
          </div>
          
         </div><!-- /content-->
         
      </div>
     
         <!-- start footer -->

         <!-- end footer -->
     
     <!-- end wrapper -->
  
    </div><!-- end of container-->

      <script src="/social_media/js/parsley.min.js"></script>
      <script>
	  $('#submit_comment').parsley();
  $(document).ready(
    function() {
		//global variables
		var cid, origComment;
		
		//delete modal window
		$('.modal-trigger').leanModal();
		//get post
        $.ajax({
          url: '../controller/listener.php',
          dataType: 'json',
		  type: 'GET',
          data: { async: true, phase: 1, pid: <?php echo $_GET['pid']; ?> },
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
		  		var pid = parseInt(post.pid);
				var postType = post.post_type;
				var cardType, card;
				
				//determine post type
				//post type 0 = text and link or image only
				if(postType == 0) 
				{
					//check if image
					IsValidImageUrl(post, function(resp){
						//image
						cardType= "<div class='card-image'><a href='post.php?pid="+resp.pid+"'><img src='"+resp.text+"' class='post-image'/><span class='card-title'>"+resp.post_title+"</span></a></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a><a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+resp.username+"</a></span></div></div>";
						$("#post-container").append(card);
					}, function(resp){
						cardType = "<div class='card-content'><span class='card-title'><a href='"+resp.text+"' target='_blank'>"+resp.post_title+"</a></span></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+resp.username+"</a></span></div></div>";
						$("#post-container").append(card);
					});	
				}
				else if (postType == 1)
				{
					//post type 1 = title and text
					var card = "<div class='card'><div class='card-content'><span class='card-title'><a href='post.php?pid="+pid+"' class='post-link'>"+post.post_title+"</a></span><p>"+post.text+"</p></div><div class='card-action'><a href='#'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='vote'>0 votes</div><a href='#'><i class='mdi-hardware-keyboard-arrow-down'></i></a> <a href='#'><i class='mdi-action-grade'></i>0</a>submitted by <span class='username'><a href='#'>"+post.username+"</a></span></div></div>";
					$("#post-container").append(card);	
				}
		
				//for delete modal
				$(document).on("click", ".deleteBtn", function(e) {
					e.preventDefault();
					$('#deleteWindow').openModal();
				});
	
				getComments();
        })
        .fail(function(err){
          console.log(err);
        });
	
		//add comment
      $('#submit_comment').submit(function(e){
			var formData = {
			  'phase' : 1,
			  'userID' : 1,
			  'postID' : <?php echo $_GET['pid']; ?>,
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
			  	$('#user-comment').val("");
				getComments();
				toast(resp.message, 4000);
			  //TO DO
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
			  url: '../controller/listener.php',
			  dataType: 'json',
			  type: 'GET',
			  data: { phase: 2, cid: <?php echo $_GET['pid']; ?> },
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
					comment = comment + '<td class="user-avatar-td"> <img src="'+commentsObj[i].profile_img+'" alt="" class="circle user-avatar"></td><td>'+commentsObj[i].username+'<a href="#" class="editCommentBtn" id="'+commentsObj[i].cid+'"><i class="mdi-image-edit commentActions"></i></a><a href="#" class="modal-trigger deleteCommentBtn" id="'+commentsObj[i].cid+'"><i class="mdi-action-delete commentActions"></i></a></td></tr><tr><td colspan="2" class="commentsbox"><div id="commentBox'+commentsObj[i].cid+'">'+commentsObj[i].comment+'</div></td></tr>';
					
					//delete comment 
					$(document).on("click", ".deleteCommentBtn", function(e){
						e.preventDefault();
						$("#deletecommentWindow").openModal();
						cid = $(this).attr("id");
					});
					
					//edit comment
					$(document).on("click", ".editCommentBtn", function(e){
						e.preventDefault();
						
						cid = $(this).attr("id");
						origComment = $("#commentBox"+cid).text();
						
						$("#commentBox"+cid).html("<textarea type='text' id='editedComment'>"+origComment+"</textarea>");
						$("#editedComment").focus();
						
						$('#editedComment').bind("enterKey",function(e){
						   //submit edited comment
						   $.ajax({
							  type: 'POST',
							  url: '../controller/listener.php',
							  dataType: 'json',
							  data: { phase: 3, cid: cid, uid: 1, pid: <?php echo $_GET['pid'] ?>, comment: $("#editedComment").val() },
							  success: function(res) {
									toast(res.message, 4000);
								}
							}).done(function() {
								//reload comments
								
								getComments();
							})
							.fail(function(err){
								  console.log(err);
								  toast(err.errors, 4000)
							});
						});
						
						//user hit enter key to edited comment
						$('#editedComment').keyup(function(e){
							if(e.keyCode == 13)
							{
								$(this).trigger("enterKey");
							}
						});
						
						//revert changes on edited comment
						$('#editedComment').bind("escKey",function(e){
							$("#commentBox"+cid).text(origComment);
						});
						//user hit esc key to cancel edit comment
						$('#editedComment').keyup(function(e){
							if(e.keyCode == 27)
							{
								$(this).trigger("escKey");
							}
						});
					});
			
					$(".comments-table tbody").append(comment);
				  }  
			  }
			  
			})
			.fail(function(err){
			  console.log(err);
			});
			
			//confirm delete post
			$("#confirmDeleteBtn").click(function() {
				$.ajax({
					  type: 'POST',
					  url: '../controller/listener.php',
					  dataType: 'json',
					  data: { phase: 4, pid: <?php echo $_GET['pid']; ?>, uid: 1 },
					  success: function(res) {
							toast(res.message, 4000);
						}
				}).done(function() {
					//redirect to home page
					setTimeout(function () {
					   window.location.href = "index.php";
					}, 2000);
				})
				.fail(function(err){
				  console.log(err);
				  toast(err.errors, 4000)
				});
					
			});
			
			//confirm delete comment
			$("#confirmDeleteCommentBtn").click(function() {
				$.ajax({
						  type: 'POST',
						  url: '../controller/listener.php',
						  dataType: 'json',
						  data: { phase: 5, cid: cid, uid: 1 },
						  success: function(res) {
								toast(res.message, 1000);
							}
						}).done(function() {
							//reload comments
							getComments();
						})
						.fail(function(err){
						  console.log(err);
						  toast(err.errors, 4000)
				});	
			});
			
			//upvote post
			
			
		}
		
function IsValidImageUrl(post, callback, error) {
    console.log(post);
	$("<img>", {
        src: post.text,
		async: false,
        error: function() { error(post); },
        load: function() { callback(post); }
    });
}
</script>