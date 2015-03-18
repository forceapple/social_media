<?php include('header.php'); ?>
        	
     <!-- start wrapper -->

	   
       <!-- content -->
       <div id="login" class="valign-wrapper">
          <form id="loginForm" class="col s12">
             <h5 class="center-align function-heading">Welcome Back</h5>
            <div class="row">
              <div class="input-field col s12">
                <input id="username" type="text" required>
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" required>
                <label for="password">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="center-align col s12">
                <button type="submit" id="loginButton" class="waves-effect waves-light btn-large">Log In</button>
              </div>
            </div>
           
          </form>
</div>
            
      <!-- /content-->
        

     
     <!-- start footer -->
     	<?php include('footer.php'); ?>
     <!-- end footer -->
     
     <!-- end wrapper -->
     
  
  </div><!-- end of container-->

	  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="js/parsley.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
	  $('#loginForm').parsley();
  $(document).ready(
    function() {

		  
    });
</script>
</body>
</html>