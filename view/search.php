<?php
//	print_r($_GET['for']);
?>
<div class="container search-results">
	<div class="row">
	    <div class="col s8 offset-s2">
	    	<h4 class="text-center-xs"> Search Results</h4>
	      <ul class="tabs">
	        <li class="tab col s3 tab-posts"><a class="active" href="#posts">Posts</a></li>
	        <li class="tab col s3 tab-users"><a href="#users">Users</a></li>
	        <li class="tab col s3 tab-names"><a href="#names">Names</a></li>
	        <li class="tab col s3 tab-comments"><a href="#comments">Comments</a></li>
	      </ul>
	    </div>
		<div id="posts" class="col s12 text-center-xs">
			<p></p>
			<ul>
				
			</ul>
		</div>
		<div id="users" class="col s12 text-center-xs">
			<p></p>
			<ul>
				
			</ul>
		</div>
		<div id="names" class="col s12 text-center-xs">
			<p></p>
			<ul>
				
			</ul>
		</div>
		<div id="comments" class="col s12 text-center-xs">
			<p></p>
			<ul>
				
			</ul>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){
		function elLength(elem){
            return elem.length > 0;
        }


		$.ajax({
			url: 'controller/listener.php',
			type: 'GET',
			data: { phase: 4, input: "<?php echo $_GET['for']; ?>"},
			dataType: 'json'
		}).done(function(resp){
			console.log(resp);
			$.each(resp, function(key,arr){
				if(arr != false){
					for(var el in arr){
						console.log(key);
						if(key == 'posts'){
							$('#'+key + '> ul').append('<li><a href="<?php echo ROOT_FOLDER; ?>post/' + arr[el].pid + '">' + arr[el].title + '</a></li>');
						}else if(key == 'users' || key == 'names'){
							$('#'+key + '> ul').append('<li><a href="<?php echo ROOT_FOLDER; ?>user/' + arr[el].uid + '">' + arr[el].username + '</a></li>');
						}else if(key == 'comments'){
							$('#'+key +'>p').html('Found comments in the following posts:');
							$('#'+key + '> ul').append('<li><a href="<?php echo ROOT_FOLDER; ?>post/' + arr[el].pid + '">' + arr[el].title + '</a></li>');
						}
						
					}
				}else{
					$('#'+key +'> p').html('Nothing found');
					$('.tab-'+ key).addClass('disabled');
				}
				////console.log(key);
				//console.log(value);
			})
			/*
			if(elLength(resp.posts)){
				console.log('yes');
				for(var key in resp.posts){
					console.log(resp.posts[key].pid);
					$('#posts > ul').append('<li><a href="<?php echo ROOT_FOLDER; ?>post/' + resp.posts[key].pid + '">' + resp.posts[key].title + '</a></li>');
				}
			}
			if(elLength(resp.posts)){
				console.log('yes');
				for(var key in resp.posts){
					console.log(resp.posts[key].pid);
					$('#posts > ul').append('<li><a href="<?php echo ROOT_FOLDER; ?>post/' + resp.posts[key].pid + '">' + resp.posts[key].title + '</a></li>');
				}
			}
			*/

		}).fail(function(err){
			console.log(err);
		});
    });

</script>