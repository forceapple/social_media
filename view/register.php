   <!-- start wrapper -->
	   
       <!-- content -->
       <div id="register" class="valign-wrapper">
          <form id="registerForm" class="col s12" method="POST" action="controller/listener.php"  enctype="multipart/form-data">
             <h5 class="center-align function-heading">Sign Up for Fun</h5>
            <div class="row">
              <div class="input-field col s6">
                <input id="first_name" type="text">
                <label for="first_name">First Name</label>
              </div>
              <div class="input-field col s6">
                <input id="last_name" type="text">
                <label for="last_name">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="username" type="text" required>
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password1" type="password" required>
                <label for="password">Password</label>
              </div>
            </div>
             <div class="row">
              <div class="input-field col s12">
                <input id="password2" type="password" class="validate" data-parsley-equalto="#password1" required>
                <label for="password">Confirm Password</label>
              </div>
             </div>
              <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" required>
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
             	<div class="input-field col s12">
                <input id="profilePic" type="text" required>
                <label for="profilePic">Profile Picture (http://)</label>
              </div>
            </div>
             
            <div class="row">
              <div class="center-align col s12" style="padding-top:1.5rem;">
                <button type="submit" id="registerButton" class="waves-effect waves-light btn-large">Register</button>
              </div>
            </div>
           
          </form>
</div>
            
      <!-- /content-->
        

     
     <!-- start footer -->
     <!-- end footer -->
     
     <!-- end wrapper -->
     
  
  </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
      <script>
	  $('#registerButton').parsley();
  $(document).ready(
    function() {
		$("#registerButton").submit(function(e) {
			e.preventDefault();
			
			$.ajax(function() {
				url: 'controller/listener.php',
				data: { phase: 8, f_name: $("#first_name").val(), l_name: $("#last_name").val(), username: $("#username").val(), password: $("#password1").val(), email: $("#email").val(), profilePic: $("#profilePic").val(),},
				dataType:"json",
				type: "POST",
				success: function(resp) {
					console.log(resp);
				}
				}).done(function(resp) {
					if (resp.success) 
				{
					toast(resp.message, 4000);
    				setInterval(function(){ location.href = "<?php echo ROOT_FOLDER; ?>"; }, 2000);
				} else {
					toast(resp.errors, 4000);
					$("#registerForm").parsley().reset();
				}
				}); 
			
		});  
    });
</script>
</body>
</html>