<?php
	include_once("connect.php");
	
// Function that will retrieve the selected theme
function getTheme() {
	$sql = "SELECT SettingValue FROM settings WHERE SettingName='Theme' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['SettingValue'];
}

	$getTheme = getTheme();
	
	include_once("Themes/".$getTheme."/ProfileHeader.php");
?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="editprofile.php">Profile Settings</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="editprofile.php">Profile Settings</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="index.php">Home</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

	<?php
		if (isset($_GET['page'])){
			$PageID = $_GET['page'];
		} else {
			$PageID = "";
		}
	?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="editprofile.php">Overview</a></li>
			<li><a href="editprofile.php?page=1">Edit Name</a></li>
			<li><a href="editprofile.php?page=2">Change password</a></li>
			<li><a href="editprofile.php?page=3">Change email address</a></li>
			<li><a href="editprofile.php?page=4">Change avatar</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		
		<?php
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
					<tr>
					<td><p>Avatar (gebruikersfoto)</p></td>
					<td>
					<div class="choose_file">
							<span>Choose File</span>
							<input id="file" name="file" type="file" />
						</div>
					<td><input name="submit" type="submit" value="Verander avatar!" id="button-4" /></p></td>
					</tr>
					</form>';
					} else {
					echo'
					Welcome to the user settings panel, here you can change anything related to your user account
					';
					}
				?>
			</p>
        </div>
		
		<?php
			include_once("connect.php");
		?>