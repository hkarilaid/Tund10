<?php
	require_once("functions.php");
	
	if(!isset($_SESSION["id_from_db"])){
		header("Location: login.php");
	}
	
	if(isset($_GET["logout"])){
		session_destroy();
		
		header("Location: login.php");
	}
?>

<p>
	Tere, <?=$_SESSION["user_email"];?>
	<a href="?logout=1"> Logi välja</a>
</p>

<h2>Lisa uus huviala</h2>
<form>
	<input name="new_interest">
	<input type="submit">
</form>