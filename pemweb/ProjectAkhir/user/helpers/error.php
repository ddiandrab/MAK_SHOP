<?php
	function display_errors($errors){
		$display = "<ul class='bg-danger'>";
		foreach($errors as $error){
			$display .= "<li class='text-danger'>" . $error . "</li>";
		}
		$display .= "</ul>";
		return $display;
	}
	
	function pretty_date($date){
		return date("M d, Y", strtotime($date));
	}
	
	
?>