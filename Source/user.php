<?php
	include_once("connect.php");
	
	if (isset($_GET['pagenr'])) { $page  = $_GET['pagenr']; } else { $page='1'; };
	$start_from = ($page-1) * 5;
	
	if (isset($_GET['mid'])) { $mid  = $_GET['mid']; } else { $mid=''; };
	
	function getTheme() {
		$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['SettingValue'];
	}
	
	function convertdate($date) {
		$date = strtotime($date);
		return date("M j, Y g:ia", $date);
	}
	
	function Target($uid) {
		$sql = "SELECT Target FROM Messages WHERE id='".$uid."'";
		$res = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['Target'];
	}

	function view($mid) {
		$sql = "UPDATE Messages SET viewed='1' WHERE id='".$mid."'";
		$res = mysql_query($sql) or die(mysql_error());
	}

	$getTheme = getTheme();
	
	include_once("Themes/".$getTheme."/ProfileHeader.php");
	
	echo'
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
          <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>';

		if (isset($_GET['page'])){
			$PageID = $_GET['page'];
		} else {
			$PageID = "";
		}
    echo' <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="user.php">Profile</a></li>
	      </ul>
		  <ul class="nav nav-sidebar">
			<li><a href="user.php?page=1">Edit Name</a></li>
			<li><a href="user.php?page=2">Change password</a></li>
			<li><a href="user.php?page=3">Change email address</a></li>
			<li><a href="user.php?page=4">Change avatar</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
			<li><a href="user.php?page=5">New Message</a></li>
			<li><a href="user.php?page=6">Inbox</a></li>
			<li><a href="user.php?page=7">Outbox</a></li>
          </ul>
		  <ul class="nav nav-sidebar">
			<li><a href="user.php?page=10">Your Topics</a></li>
			<li><a href="user.php?page=11">Your Posts</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">';
		
			if($PageID=="1"){
				echo '			
				<h1 class="page-header">Edit username</h1>
					<form name="reg" action="editname_parse.php" method="post">
						<input type="text" name="name" class="form-control" placeholder="New Username"/><br />
						<input class="btn btn-lg btn-primary btn-block" type="submit" name="reply_submit" value="Change name" />
					</form>';
			} else if($PageID=="2"){
				echo '
				<h1 class="page-header">Edit password</h1>
					<form name="reg" action="editpass_parse.php" method="post">
						<input type="password" name="oldpass" class="form-control" placeholder="Old Password"/><br />
						<input type="password" name="newpass" class="form-control" placeholder="New Password"/><br />
						<input type="password" name="newpass2" class="form-control" placeholder="Confirm password"/><br />
						<input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Change Password" id="button-2" />
					</form>';
			} else if($PageID=="3"){
				echo'	
				<h1 class="page-header">Edit email address</h1>
					<form name="reg" action="editmail_parse.php" method="post">
						<input type="text" name="email" class="form-control" placeholder="email" /><br />
						<input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Change email" id="button-3" />
					</form>';
			} else if($PageID=="4"){
				echo'	<form action="avatar_parse.php" enctype="multipart/form-data" method="post">
					<h1 class="page-header">Change Avatar</h1>
					<div class="choose_file">
							<label>Choose File</label>
							<input id="file" name="file" type="file" />
						</div><br />
					<input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Change Avatar!" id="button-4" />
					</form>';
			} else if($PageID=="5"){
				echo '
				<form action="newmessage_parse.php" method="post">
					<input type="text" class="form-control" name="target" placeholder="Receiver"><br />
					<input type="text" class="form-control" name="title" placeholder="Subject"><br />
					<textarea name="Content">Your Message.</textarea><br />
					<input type="submit" class="btn btn-lg btn-primary btn-block" value="Send" />
				</form>
				';
			} else if($PageID=="6"){
				echo "<div class='table-responsive'>
					<table class='table table-striped'>
					<thead>
									<tr>
									  <th>Messages</th>
									  <th></th>
									  <th></th>
									  <th><div align='right'><button type='button' class='btn btn-sm btn-primary'  onClick=\"window.location = 'newmessage.php'\">Compose Message</button></div></th>
									</tr>
								  </thead>
								  <tbody>";
					$uid = $_SESSION['uid'];
							// Query the posts table for all posts in the specified topic
							$sql2 = "SELECT * FROM Messages WHERE Target='".$uid."' LIMIT $start_from, 5";
							// Execute the SELECT query
							$res2 = mysql_query($sql2) or die(mysql_error());
							// Fetch all the post data from the database
							while ($row2 = mysql_fetch_assoc($res2)) {
								// Echo out the topic post data from the database
											$mid=$row2['ID'];
								echo "<tr><td valign='top'>Send by: ".getusername($row2['Sender'])."</td><td><a href='user.php?page=8&mid=".$mid."'>Subject: ".$row2['Title']."</td><td>".convertdate($row2['Date'])."</a></td><td><a href='DelMessage.php?mid=".$mid."'>Delete</a></td></tr>";
							}
					echo "</tbody>
								</table>
								</div>";
					$sql = "SELECT * FROM Messages WHERE Target='".$uid."'"; 
					$rs_result = mysql_query($sql) or die(mysql_error());
					$row = mysql_num_rows($rs_result);
					$total_pages = ceil($row / 5); 
					echo "Page ";
					for ($i=1; $i<=$total_pages; $i++) { 
								echo "<a href='?page=6&pagenr=".$i."'>".$i."</a> ";
					}
			} else if($PageID=="7"){
				echo "<div class='table-responsive'>
					<table class='table table-striped'>
					<thead>
									<tr>
									  <th>Messages</th>
									  <th></th>
									  <th></th>
									  <th></th>
									</tr>
								  </thead>
								  <tbody>";
				$uid = $_SESSION['uid'];
						// Query the posts table for all posts in the specified topic
						$sql2 = "SELECT * FROM Messages WHERE Sender='".$uid."' LIMIT $start_from, 5";
						// Execute the SELECT query
						$res2 = mysql_query($sql2) or die(mysql_error());
						// Fetch all the post data from the database
						while ($row2 = mysql_fetch_assoc($res2)) {
										$mid=$row2['ID'];
							// Echo out the topic post data from the database
							echo "<tr><td valign='top'>Send to: ".getusername($row2['Target'])."</td><td><a href='user.php?page=8&mid=".$mid."'>Subject: ".$row2['Title']."</a></td><td>".convertdate($row2['Date'])."</td></tr>";
						}
				echo "</tbody>
								</table>
								</div>";
				$sql = "SELECT * FROM Messages WHERE Target='".$uid."'"; 
				$rs_result = mysql_query($sql) or die(mysql_error());
				$row = mysql_num_rows($rs_result);
				$total_pages = ceil($row / 5); 
				echo "Page ";
				for ($i=1; $i<=$total_pages; $i++) { 
							echo "<a href='?page=7&pagenr=".$i."'>".$i."</a> ";
				}
			} else if($PageID=="8"){
				if (Target($mid) == $uid) {
				view($mid);
				echo "<div class='table-responsive'>
						<table class='table table-striped'>
							  <thead>
								<tr>
								  <th>Message</th>
								</tr>
							  </thead>
							  <tbody>";
						$uid = $_SESSION['uid'];
						// Query the posts table for all posts in the specified topic
						$sql2 = "SELECT * FROM Messages WHERE id='".$mid."' LIMIT 1";
						// Execute the SELECT query
						$res2 = mysql_query($sql2) or die(mysql_error());
						// Fetch all the post data from the database
						while ($row2 = mysql_fetch_assoc($res2)) {
							// Echo out the topic post data from the database
							echo "<tr><td valign='top'>Send by: ".getusername($row2['Sender'])."</td><td>".convertdate($row2['Date'])."</td><td>".$row2['Content']."</td></tr>";
										echo "</tbody>
							</table>
							</div>";
										echo "<button type='button' class='btn btn-lg btn-primary btn-block'  onClick=\"window.location = 'user.php?page=9&mid=".$mid."'\">Reply</button>";
						}
				} else {
					header("Location: index.php");
				}
			} else if($PageID=="9"){
				Function GetSubject($mid){
					$sql = "SELECT Title FROM Messages WHERE ID='".$mid."' LIMIT 1";
					$res = mysql_query($sql) or die(mysql_error());
					$row = mysql_fetch_assoc($res);
					return $row['Title'];
				}

				Function GetTarget($uid){
					$sql = "SELECT Sender FROM Messages WHERE ID='".$uid."' LIMIT 1";
					$res = mysql_query($sql) or die(mysql_error());
					$row = mysql_fetch_assoc($res);
					return $row['Sender'];
				}

				$Target=GetTarget($mid);
				$Target=Getusername($Target);
				$Onderwerp=GetSubject($mid);

				echo '
				<form action="newmessage_parse.php" method="post">
					<input type="text" class="form-control" name="target" placeholder="'.$Target.'">
					<br />
					<input type="text" class="form-control" name="title" placeholder="RE: '.$Onderwerp.'">
					<br />
					<textarea name="Content">Your Message.</textarea>
					<input type="submit" class="btn btn-lg btn-primary btn-block" value="Reply" />
				</form>
				';
			} else if($PageID=="10"){
				echo "<div class='table-responsive'>
				<table class='table table-striped'>
				<thead>
								<tr>
								  <th>Topics of ".getusername($uid)."</th>
								  <th>Date</th>
								  <th>Title</th>
								</tr>
							  </thead>
							  <tbody>";
				$uid = $_SESSION['uid'];
						// Query the topics table for all topics in the specified topic
						$sql2 = "SELECT * FROM topics WHERE topic_creator='".$uid."' LIMIT $start_from, 5";
						// Execute the SELECT query
						$res2 = mysql_query($sql2) or die(mysql_error());
						// Fetch all the post data from the database
						while ($row2 = mysql_fetch_assoc($res2)) {
							// Echo out the topic post data from the database
							echo "<tr><td valign='top'>".getusername($uid)."</td><td>".convertdate($row2['topic_date'])."</td><td>".$row2['topic_title']."</td></tr>";
						}
				echo "</tbody>
							</table>
							</div>";
				$sql = "SELECT * FROM posts WHERE post_creator='".$uid."'"; 
				$rs_result = mysql_query($sql2) or die(mysql_error());
				$row = mysql_num_rows($rs_result);
				$total_pages = ceil($row / 5); 
				echo "Page ";
				for ($i=1; $i<=$total_pages; $i++) { 
							echo "<a href='?page=10&pagenr=".$i."'>".$i."</a> ";
				}
			} else if($PageID=="11"){
				echo "<div class='table-responsive'>
				<table class='table table-striped'>
				<thead>
								<tr>
								  <th>Posts of ".getusername($uid)."</th>
								  <th>Date</th>
								  <th>Content</th>
								</tr>
							  </thead>
							  <tbody>";
				$uid = $_SESSION['uid'];
						// Query the posts table for all posts in the specified topic
						$sql2 = "SELECT * FROM posts WHERE post_creator='".$uid."' LIMIT $start_from, 5";
						// Execute the SELECT query
						$res2 = mysql_query($sql2) or die(mysql_error());
						// Fetch all the post data from the database
						while ($row2 = mysql_fetch_assoc($res2)) {
							// Echo out the topic post data from the database
							echo "<tr><td valign='top'>".getusername($uid)."</td><td>".convertdate($row2['post_date'])."</td><td>".$row2['post_content']."</td></tr>";
						}
				echo "</tbody>
							</table>
							</div>";
				$sql = "SELECT * FROM posts WHERE post_creator='".$uid."'"; 
				$rs_result = mysql_query($sql2) or die(mysql_error());
				$row = mysql_num_rows($rs_result);
				$total_pages = ceil($row / 5); 
				echo "Page ";
				for ($i=1; $i<=$total_pages; $i++) { 
							echo "<a href='?page=11&pagenr=".$i."'>".$i."</a> ";
				}
			} else {
				// Function that will convert a user id into their email
				function getuid($uid) {
					$sql = "SELECT id FROM users WHERE username='".$uid."' LIMIT 1";
					$res = mysql_query($sql) or die(mysql_error());
					$row = mysql_fetch_assoc($res);
					return $row['id'];
				}

				$sql = "SELECT * FROM posts WHERE post_creator='".$uid."'";
				$res = mysql_query($sql) or die(mysql_error());
				$post_count = mysql_num_rows($res);

				if (isset($_GET['username'])){
					$username = $_GET['username'];
				} else {
					$username = "";
				}

				if ($username == "") {
					if (isset($_SESSION['uid'])){
						echo "
						<center>
						<table>
						<tr><td><center>".getusername($uid)."</center><br /></td></tr>
						<tr><td><center><img src='".getavatar($uid)."' style='width:200px;height:200px;' /></center><br /></td></tr>
						<tr><td><center>Email: ".getemail($uid)."</center><br /></td></tr>
						<tr><td><center>Rank: ".getrank($uid)."</center><br /></td></tr>
						<tr><td><center>Posts: ".$post_count."</center><br /></td></tr>
						</table>
						</center>
						<br />
						";
					} else {
						echo "<h1>404</h1>
						<h3>It’s looking like you may have taken a wrong turn.<br />
						Don’t worry... it happens to the best of us.</h3>";
					}
				} else {
					$uid2 = getuid($username);
					echo "
					<center>
					<table>
					<tr><td><center>".getusername($uid2)."</center><br /></td></tr>
					<tr><td><center><img src='".getavatar($uid2)."' style='width:200px;height:200px;' /></center><br /></td></tr>
					<tr><td><center>Email: ".getemail($uid2)."</center><br /></td></tr>
					<tr><td><center>Rank: ".getrank($uid2)."</center><br /></td></tr>
					<tr><td><center>Posts: ".count_posts($uid2)."</center><br /></td></tr>
					</table>
					</center>
					<br />";
				}
			}
			echo'</p>';
		
		include_once("Themes/".$getTheme."/DashboardFooter.php");
?>