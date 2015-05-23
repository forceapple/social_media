     <!-- start wrapper -->
       <div class="row">
       <!-- content -->
       
        <div id="post-comments-container" class="col m8">
        	<div id="post-container" style="display:none;">
            </div><!--end of post container-->

            <!--loading circle -->
	        <div id="post-loading" style="display:none" class="preloader-wrapper big active">
			    <div class="spinner-layer spinner-green-only">
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
				var cardType, card, userOwn;
				
				//determine post type
				//post type 0 = text and link or image only
				if(postType == 0) 
				{
					//check if image
					IsValidImageUrl(post, function(resp){
						//image
						cardType= "<div class='card-image'><img src='"+resp.text+"' class='post-image'/><span class='card-title'>"+resp.post_title+"</span></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'>";
						<?php if ($isLoggedIn) { //can only vote when logged in ?>
						card += "<div class='voteBox'><a href='#' class='userVote' data-votetype='0' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='voteCount' id='voteBox"+resp.pid+"'>0</div><a href='#' data-votetype='1' class='userVote' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-down'></i></a></div>";
						<?php } ?>
						card += "<div class='postDetails'><a href='#'><i class='mdi-action-grade'></i>0</a>by "+resp.username+" <img src='"+resp.profile_img+"' class='userprofilepic'>";
						//check if post is userLoggedIn's own
						var userOwnComp = resp.username.localeCompare("<?php echo $username; ?>"); //0 if match
						if (userOwnComp == 0) {
							card += "<div class='post-options'><a href='../edit/"+resp.pid+"'>EDIT</a> <a href='#' class='deleteBtn'>DELETE</a><a href='#' class='saveBtn'>SAVE</a></div>";	
						}
						card += "</div></div></div>";
						$("#post-container").append(card);
						$('.saveBtn').on('click', function(e){
							console.log('click');
							e.preventDefault();
							$.ajax({
								type: 'POST',
								url: '../controller/listener.php',
								dataType: 'json',
								data: { phase: 9, pid: <?php echo $_GET['pid']; ?>, uid: <?php echo $userId_session; ?> },
							}).done(function(resp){
								console.log(resp);
								toast(resp.message, 1000);
							}).fail(function(err){
								console.log(err);
							});
						});
					}, function(resp){	
						cardType = "<div class='card-content'><span class='card-title'><a href='"+resp.text+"' target='_blank'>"+resp.post_title+"</a></span></div>";
						card = "<div class='card'>"+cardType+"<div class='card-action'>";
						<?php if ($isLoggedIn) { //can only vote when logged in ?>
						card += "<div class='voteBox'><a href='#' class='userVote' data-votetype='0' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='voteCount' id='voteBox"+resp.pid+"'>0</div><a href='#' data-votetype='1' class='userVote' data-pid='"+resp.pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-down'></i></a></div>";
						<?php } ?>
						card += "<div class='postDetails'><a href='#'><i class='mdi-action-grade'></i>0</a>by "+resp.username+" <img src='"+resp.profile_img+"' class='userprofilepic'>";
						//check if post is userLoggedIn's own
						var userOwnComp = resp.username.localeCompare("<?php echo $username; ?>"); //0 if match
						if (userOwnComp == 0) {
							card += "<div class='post-options'><a href='../edit/"+resp.pid+"'>EDIT</a> <a href='#' class='deleteBtn'>DELETE</a><a href='#' class='saveBtn'>SAVE</a></div>";
						}
						card += "</div></div></div>";
						$("#post-container").append(card);
						$('.saveBtn').on('click', function(e){
							console.log('click');
							e.preventDefault();
							$.ajax({
								type: 'POST',
								url: '../controller/listener.php',
								dataType: 'json',
								data: { phase: 9, pid: <?php echo $_GET['pid']; ?>, uid: <?php echo $userId_session; ?> },
							}).done(function(resp){
								console.log(resp);
								toast(resp.message, 1000);
							}).fail(function(err){
								console.log(err);
							});
						});
					});	
				}
				else if (postType == 1)
				{
					//post type 1 = title and text
					var card = "<div class='card'><div class='card-content'><span class='card-title' style='color:#689f38;'>"+post.post_title+"</span><p>"+post.text+"</p></div><div class='card-action'>";
					<?php if ($isLoggedIn) { //can only vote when logged in ?>
					card += "<div class='voteBox'><a href='#' class='userVote' data-votetype='0' data-pid='"+pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-up'></i></a><div class='voteCount' id='voteBox"+pid+"'>0</div><a href='#' data-votetype='1' class='userVote' data-pid='"+pid+"' data-uid='<?php echo $userId_session; ?>'><i class='mdi-hardware-keyboard-arrow-down'></i></a></div>";
					<?php } ?>
					card += "<div class='postDetails'><a href='#'><i class='mdi-action-grade'></i>0</a>by "+post.username+" <img src='"+post.profile_img+"' class='userprofilepic'>";
					//check if post is userLoggedIn's own
						var userOwnComp = post.username.localeCompare("<?php echo $username; ?>"); //0 if match
						if (userOwnComp == 0) {
							card += "<div class='post-options'><a href='../edit/"+post.pid+"'>EDIT</a> <a href='#' class='deleteBtn'>DELETE</a><a href='#' class='saveBtn'>SAVE</a></div>";
						}
						card += "</div></div></div>";
					$("#post-container").append(card);	
				}
				$('.saveBtn').on('click', function(e){
					console.log('click');
					e.preventDefault();
					$.ajax({
						type: 'POST',
						url: '../controller/listener.php',
						dataType: 'json',
						data: { phase: 9, pid: <?php echo $_GET['pid']; ?>, uid: <?php echo $userId_session; ?> },
					}).done(function(resp){
						console.log(resp);
						toast(resp.message, 1000);
					}).fail(function(err){
						console.log(err);
					});
				});
				//for delete modal
				$(document).on("click", ".deleteBtn", function(e) {
					e.preventDefault();
					$('#deleteWindow').openModal();
				});
				
				getVoteCount(<?php echo $_GET['pid'] ?>);
				votingFunc();  
				getComments();
        })
        .fail(function(err){
          console.log(err);
        });
	
		//add comment
      $('#submit_comment').submit(function(e){
			var formData = {
			  'phase' : 1,
			  'userID' : <?php echo $userId_session; ?>,
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
					comment = comment + '<td class="user-avatar-td"> <img src="'+commentsObj[i].profile_img+'" alt="" class="circle user-avatar"></td><td>'+commentsObj[i].username;
					//can only edit or delete one's own comment
					//check if post is userLoggedIn's own
						var userOwnComp = commentsObj[i].username.localeCompare("<?php echo $username; ?>"); //0 if match
						if (userOwnComp == 0) {
							comment += '<a href="#" class="editCommentBtn" id="'+commentsObj[i].cid+'"><i class="mdi-image-edit commentActions"></i></a><a href="#" class="modal-trigger deleteCommentBtn" id="'+commentsObj[i].cid+'"><i class="mdi-action-delete commentActions"></i></a>';
						}
					comment += '</td></tr>';
					//comment vote box
					comment += '<tr><td class="commentVote">';
					<?php if ($isLoggedIn) { //can only vote when logged in ?>
					comment += '<div class="commentVoteBox"><a href="#" class="commentUserVote" data-votetype="0" data-cid="'+commentsObj[i].cid+'" data-uid="<?php echo $userId_session; ?>"><i class="mdi-hardware-keyboard-arrow-up"></i></a><div class="commentVoteCount" id="commentVoteBox'+commentsObj[i].cid+'">0</div><a href="#" data-votetype="1" class="commentUserVote" data-cid="'+commentsObj[i].cid+'" data-uid="<?php echo $userId_session; ?>"><i class="mdi-hardware-keyboard-arrow-down"></i></a></div>';
					<?php } ?>
					comment += '</td>';
					//comment
					comment += '<td class="commentsbox"><div id="commentBox'+commentsObj[i].cid+'">'+commentsObj[i].comment+'</div></td></tr>';
					
					//get # of votes for comment
					getCommentVoteCount(commentsObj[i].cid);
					
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
							  data: { phase: 3, cid: cid, uid: <?php echo $userId_session; ?>, pid: <?php echo $_GET['pid'] ?>, comment: $("#editedComment").val() },
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
			  commentVotingFunc();
			  
			})
			.fail(function(err){
			  console.log(err);
			});
			
			//confirm delete post
			$("#confirmDeleteBtn").click(function() {
				console.log('fired');
				$.ajax({
					  type: 'POST',
					  url: '../controller/listener.php',
					  dataType: 'json',
					  data: { phase: 4, pid: <?php echo $_GET['pid']; ?>, uid: <?php echo $userId_session; ?> },
					  success: function(res) {
							toast(res.message, 4000);
						}
				}).done(function() {
					//redirect to home page
					setTimeout(function () {
					   window.location.href = "<?php echo ROOT_FOLDER; ?>";
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
						  data: { phase: 5, cid: cid, uid: <?php echo $userId_session; ?> },
						  success: function(res) {
							  console.log(res);
							  console.log(cid);
								toast(res.message, 1000);
							}
						}).done(function() {
							//reload comments
							getComments();
						})
						.fail(function(err){
						  console.log(err);
						  toast(err.errors, 4000);
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
//save post
			

function getVoteCount(pid) {
	$.ajax({
		url:'../controller/listener.php',
		data: {phase: 3, pid: pid},
		type: 'GET',
		dataType: 'json',
		success: function (voteNum) {
			$("#voteBox"+pid).text(voteNum);
		}, 
		error: function(err) {
			console.log(err);
		}
	});  
}

function votingFunc() {
	//vote click event listener binds dynamically made cards
	$(document).on("click", ".userVote", function(e) {
			e.preventDefault();
			var votetype = $(this).data('votetype');
			var pid = $(this).data('pid');
			var currVoteCount = parseInt($("#voteBox"+pid).text());
			var uservotetype = $(this).data('uservote');
			
			if (!votetype)
			{
				$("#voteBox"+pid).text(currVoteCount	+1);
				$(this).attr("class", "disableVote");
				$(this).siblings().closest("a").attr("class","userVote");
			}
			else {
				$("#voteBox"+pid).text(currVoteCount-1);
				$(this).attr("class", "disableVote");
				$(this).siblings().closest("a").attr("class","userVote");
			}
			$(document).on("click", ".disableVote", function(e) { e.preventDefault(); });
			
			var formData = {
				phase: 6, 
				uid: <?php echo $userId_session; ?>, //user in session
				pid: pid, 
				votetype: votetype 
			};
			
			//0 is upvote, 1 is minus
			$.ajax({
				url:'../controller/listener.php',
				data: formData,
				type: 'POST',
				dataType: 'json',
				success: function(resp) {
					console.log(formData);
					console.log(resp);
				},
				error: function(err) {
					
				}
			});
	});
}

function getCommentVoteCount(cid) {
	$.ajax({
		url:'../controller/listener.php',
		data: {phase: 5, cid: cid},
		type: 'GET',
		dataType: 'json',
		success: function (voteNum) {
			$("#commentVoteBox"+cid).text(voteNum);
		}, 
		error: function(err) {
			console.log(err);
		}
	});  
}

function commentVotingFunc() {
	//vote click event listener binds dynamically made cards
	$(document).on("click", ".commentUserVote", function(e) {
			e.preventDefault();
			var votetype = $(this).data('votetype');
			var cid = $(this).data('cid');
			var currVoteCount = parseInt($("#commentVoteBox"+cid).text());
			var uservotetype = $(this).data('uservote');
			
			if (!votetype)
			{
				$("#commentVoteBox"+cid).text(currVoteCount	+1);
				$(this).attr("class", "disableVote");
				$(this).siblings().closest("a").attr("class","commentUserVote");
			}
			else {
				$("#commentVoteBox"+cid).text(currVoteCount-1);
				$(this).attr("class", "disableVote");
				$(this).siblings().closest("a").attr("class","commentUserVote");
			}
			$(document).on("click", ".disableVote", function(e) { e.preventDefault(); });
			
			var formData = {
				phase: 10, 
				uid: <?php echo $userId_session; ?>, //user in session
				cid: cid, 
				votetype: votetype 
			};
			console.log(formData);
			//0 is upvote, 1 is minus
			$.ajax({
				url:'../controller/listener.php',
				data: formData,
				type: 'POST',
				dataType: 'json',
				success: function(resp) {
					console.log(formData);
					console.log(resp);
				},
				error: function(err) {
					console.log(err);
				}
			});
	});
}
</script>