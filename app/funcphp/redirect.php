<?php 
	function redirect_in($target) {
		header("Location: " . $target);
		exit;
	}