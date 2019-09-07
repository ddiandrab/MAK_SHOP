<script>
	function child_option(selected){
		if(typeof selected === "undefined"){
			var selected = "";
		}
		var parentID = jQuery("#parent").val();
		jQuery.ajax({
			url : "/pemweb/projectakhir/user/helpers/child.php",
			type : "POST" ,
			data : {parentID : parentID, selected : selected},
			success: function(data){
				jQuery("#child").html(data);
			}
		});
	}
	jQuery("select[name='parent']").change(function(){
		child_option();
	});
	jQuery("document").ready(function(){
		child_option("<?=$category;?>");
	});
	
</script>
</body>
</html>