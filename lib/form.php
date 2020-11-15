<?php

function input($id) {
	$value = isset($_POST[$id]) ? $_POST[$id] : '';
	return "<input type='text' class='form-control' id='$id' name='$id' value='$value'>";
}

function textarea($id) {
	$value = isset($_POST[$id]) ? $_POST[$id] : '';
	return "<textarea type='text' class='form-control' id='$id' name='$id'>$value</textarea>";
}

function select($id, $options = array()){
	$return = "<select class='form-control' id='$id' name='$id'>";
	foreach ($options as $k => $value) {
		# code..
		$selected = '';
		if (isset($_POST[$id]) && $k == $_POST[$id]) {
			# code...
			$selected = ' selected="selected"';
		}
		$return .= "<option value='$k' $selected>$value</option>";
	}
	$return .= '</select>';
	return $return;
}