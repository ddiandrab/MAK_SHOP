<?php		
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	$parentID = (int)$_POST["parentID"];
	$selected = $_POST["selected"];
	$childQuery = $mysqli->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY cat_name");
	ob_start(); 
?>
	<option value=""></option>
		<?php while($child = mysqli_fetch_assoc($childQuery)) : ?>
			<option value="<?=$child["id"];?>"<?=(($selected == $child["id"])?"selected": "");?>><?=$child["cat_name"]?></option>
		<?php endwhile; 
	echo ob_get_clean();
?>