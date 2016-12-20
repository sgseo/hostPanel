<?php
include '../config.php' ;

if (!isset($_GET['mod']) && !isset($_POST['action']) ) {
	include 'form.php' ;
}
