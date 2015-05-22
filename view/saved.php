<div class="container">
	<div class="row">
		<div class="col s8 offset-s2 l6 offset-l3">
		<h4>Your saved posts</h4>
			 <ul class="collection">
		    </ul>
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){
		$.ajax({
			url: 'controller/listener.php',
			type: 'GET',
			dataType: 'json',
			data: { phase: 6, uid: <?php echo $_SESSION['user_id']; ?>}
		}).done(function(resp){
			console.log(resp);
			for(var key in resp){
				console.log(key);
				$('.collection').append('<li class="collection-item"><a href="<?php echo ROOT_FOLDER; ?>post/' + resp[key].pid + '">' + resp[key].post_title + '</a></li>')
			}
			
			
		}).fail(function(err){
			console.log(err);
		})
	})

</script>