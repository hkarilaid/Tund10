<?php
	require_once("functions.php");
	require_once("InterestManager.class.php");
	if(!isset($_SESSION["id_from_db"])){
		header("Location: login.php");
	}
	
	if(!isset($_SESSION["id_from_db"])){
		header("Location: login.php");
		
		
		exit();
	}
	
	
	
	
	
	if(isset($_GET["logout"])){
		session_destroy();
		
		header("Location: login.php");
	}
	
	$InterestManager = new InterestManager($mysqli);
	
	if(isset($_GET["new_interest"])){
		
	$added_interest = $InterestManager->addInterest($_GET["new_interest"]);
	}
?>

<p>
	Tere, <?=$_SESSION["user_email"];?>
	<a href="?logout=1"> Logi välja</a>
</p>

<h2>Lisa uus huviala</h2>
<?php if(isset($added_interest->error)): ?>
  
	<p style="color:red;">
		<?=$added_interest->error->message;?>
	</p>
  
  <?php elseif(isset($added_interest->success)): ?>
  
	<p style="color:green;">
		<?=$added_interest->success->message;?>
	</p>
  
  <?php endif; ?>  
<form>
	<input name="new_interest">
	<input type="submit">
</form>
<h2>Minu huvialad</h2>
<form>
	<?=$InterestManager->createDropdown();?>
	<input type="submit">
</form>