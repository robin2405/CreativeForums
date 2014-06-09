		<div class="right_block Sidebar_right">
			<div class="content">
                        <br />
                        <p>Er zijn: <a href="online_users.php"><font color="#00FF26"><?php echo count_onlineusers(); ?> gebruikers Online</font></a></p>
                        <?php
						// Query the posts table for all posts in the specified topic
						$sql2 = "SELECT * FROM users WHERE TIMESTAMPDIFF(MINUTE,`last_Active`,NOW()) <= 15";
						// Execute the SELECT query
						$res2 = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
						// Fetch all the post data from the database
						while ($row2 = mysqli_fetch_assoc($res2)) {
							// Echo out the topic post data from the database
							echo "<img src='http://achievecraft.com/tools/avatar/64/".$row2['username'].".png' Title='".$row2['username']."' style='width:30px;height:30px;'> ";
						}
						?>
						</div>
		</div>
		<div class="background Body"></div>
		<div class="Main">
		<div id="wrapper">
		<div class="content">