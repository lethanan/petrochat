<?php
require 'stuff/global.php';
?><!DOCTYPE html>
<html><head>
  <link rel="stylesheet" href="main.css">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <title><?=$cfg['sitename'];?></title>
  <meta charset="UTF-8">
</head><body class="home">

<center><img src="img/logox64.gif" id="homelogo"></center>
<div id="center">
	<h2 style="margin-top:0;">Select</h2>
	<form action="chat.php">
		<select id="user" name="s"><option value="none">select</option>
		<?php 
		$sel = $db->prepare("SELECT id,number,title FROM `servers` WHERE 1");
		$sel->execute();
		while($row = $sel->fetch(PDO::FETCH_ASSOC)){ 
			$id = cleanNumber($row['id']);
			$number = cleanString($row['number']);
			$title = cleanString($row['title']);
			echo "<option value='{$id}'>{$cfg['nouns']['server']} {$number} ({$title})</option>";
		} ?>
		<option value="create">-->Create <?php echo $cfg['nouns']['server']; ?></option>
		</select>
		<button id="submit">></button>
	</form>
</div>
</body></html>