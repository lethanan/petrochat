<?php
require 'stuff/global.php';

$serverid= cleanString($_REQUEST['s']); 
if($serverid == 'create') header("Location: stuff/createServer.php");
else if($serverid == 'none') header("Location: index.php");
// Get page info

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sel = $db->prepare("SELECT number,title,color FROM servers WHERE id=?");
$sel->execute(array($serverid));
$server = current($sel->fetchAll());
foreach($server as $key=>$val){
	$server[$key] = cleanString($val);
}
$users = array();

?>
<!DOCTYPE html>
<html><head>
  <link rel="stylesheet" href="main.css">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <title><?php echo $cfg['sitename'];?> - <?php echo $title;?></title>
  <meta charset="UTF-8">
</head><body>
<div id="container">
<div id="header">
	<img src="img/logox64.gif">
	<h1><span><?php echo $cfg['sitename'];?></span></h1>
	<h3><span class="title"><?php echo $server['title'];?></span></h3>
	<right>
	<form action="stuff/createUser.php" method="post">
		<select id="user" name="user" onchange="switchUser()">			
			<?php 
			$selUsers = $db->prepare("SELECT id,name,color FROM users WHERE serverid=?");
			$selUsers->execute(array($serverid));
			if($selUsers->rowCount()==0) echo "<option value='null'>Select User</option>";
			while($row = $selUsers->fetch(PDO::FETCH_ASSOC)){ 
				$newUser = array( id=>cleanNumber($row['id']),name=>cleanString($row['name']),color=>cleanString($row['color']));
				$users[$newUser['id']] = $newUser;
				echo "<option value='{$newUser['id']}' class='user-{$newUser['id']}'>{$newUser['name']}</option>";
			}
			?>
			<option value="create">-->Create Account</option>
			<option value="logout">-->LogOut</option>
		</select>
		<div id="newUserForm" class="hidden">
			<input id="newusername" name="newusername" type="text" maxlength="250" autocomplete="off">
			<input name="serverid" type="hidden" value="<?php echo $serverid;?>">			
			<button id="submit" name="submitUser">></button>
		</div>
	</form>
	</right>
</div>
<div id="errors">
	<h3 id="error-existing-user" class="error hidden">Username Exists</h3>
</div>
<div id="main">
	<!--
	<div id="channels">
		<div class="channel active">General</div>
		<div class="channel">Misc</div>
		<div class="channel">Plans?</div>
	</div>
	-->
	<noscript>Javascript is required for chat to update and to unhide the new user creation form.</noscript>
	<div id="chat">
		<div id="messages">
			<?php 
			$selMessages = $db->prepare("SELECT content,userid FROM messages WHERE serverid=? ORDER BY id DESC LIMIT 20");
			$selMessages->execute(array($serverid));
			while($row = $selMessages->fetch(PDO::FETCH_ASSOC)){ 
				$row['content'] = cleanString($row['content']);
				$row['userid'] = cleanString($row['userid']);
				echo "<div class='message' ><span class='username username-{$row['userid']}'>{$users[$row['userid']]['name']}</span><span class='messageContent'>{$row['content']}</span></div>";
			}
			?>
		</div>
		<?php if($selUsers->rowCount()>0){ ?>
		<div id="form">
			<form action="stuff/createMessage.php" type="post">
				<input id="content" name="content" type="text" maxlength="250" autocomplete="off">
				<input id="server" name="serverid" type="hidden" value="<?php echo $serverid;?>">
				<input id="userid" name="userid" type="hidden" value="<?php echo current($users)['id'];?>">
				<button id="submit" name="submitMessage">></button>
			</form>
		</div>
		<?php } ?>
	</div>
</div>
</div>

<script language="javascript" src="chat.js"></script>
</body></html>