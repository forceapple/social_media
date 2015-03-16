<!doctype html>
<html>
<head>
<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Let browser know website is optimized for mobile-->
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <title>Reddit?</title>

</head>

<body>
<div class="container">
	  <div class="row">
	    <div class="col s12">
	      <ul class="tabs">
	        <li class="tab col s3"><a class="active" href="#link">Link</a></li>
	        <li class="tab col s3"><a href="#text">Text</a></li>
	      </ul>
	    </div>
	    <div id="link" class="col s12">
	    	<h1>Submit a link</h1>
    		<form action="../controller/listener.php" class="col l12 m12 s12 container" id="linkform" method="POST">
			    <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <input id="link_title" name="link_title" type="text" class="validate">
			        <label for="link_title">Title</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <input id="link_url" name="link_url" type="text" class="validate">
			        <label for="link_url">URL</label>
			      </div>
			    </div>
			    <div class="row">
			      <div class="input-field col l12 m12 s12">
			        <p>[[ Some information about submitting ]]</p>
			      </div>
			    </div>
			    <div class="row">
					<button class="btn waves-effect waves-light" type="submit" name="link_submit">Submit
					    <i class="mdi-content-send right"></i>
					</button>
			    </div>
			 </form>
    	</div>
	    <div id="text" class="col s12">
			
    	</div>
	  </div>
        



	<div class="row">
	  
	</div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$('#linkform').submit(function(e){
		var formData = {
			'phase' : 0,
			'uid' : 1,
			'title' : $('#link_title').val(),
			'url' : $('#link_url').val(),
			'type' : 1
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
		})
		.fail(function(err){
			console.log(err);
		})
		e.preventDefault();
	})

})
	
</script>
</body>
</html>