<div>
SHOWtest THE USER PICTURE
</div>
<script>
$(document).ready(function(){
	
	$.ajax({
		url:"localhost/route/user",
		data:{async:true,uid:1},
		dataType:"json",
		type:"GET",
		success:function(resp){
			console.log(resp);
			alert(resp);
		}
	});
});
</script>