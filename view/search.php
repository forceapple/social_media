<?php include('header.php'); 
	$searchString = $_GET['for'];
?>
        	
     <!-- start wrapper -->
       <div class="row">
	       
       <!-- content -->
        <div id="content" class="col m8">
        	<h2 class="function-heading">Search Results for...<i><?php echo $searchString; ?></i></h2>
	       <p>--</p>
          
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
$('#searchForm').parsley();

$(document).ready(function(){
	
    //$('select').material_select();

})
	
</script>
</body>
</html>