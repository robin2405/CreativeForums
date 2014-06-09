	</div>
		<br />
		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
						<?php
						// Query the posts table for all posts in the specified topic
						$sql2 = "SELECT * FROM users WHERE TIMESTAMPDIFF(SECOND,`last_Active`,NOW()) <= 5 LIMIT 50";
						// Execute the SELECT query
						$res2 = mysqli_query($link, $sql2) or Mysql::HandleError(mysqli_error($link));
						// Fetch all the post data from the database
						while ($row2 = mysqli_fetch_assoc($res2)) {
							// Echo out the topic post data from the database
							echo'<a href="user.php?username='.$row2["username"].'"><img src="'.User::getavatar($row2["id"]).'" Title="'.$row2["username"].'" style="width:30px;height:30px;"></a>';
						}
						?>
						<center><p>There are: <a href="allusers.php"><?php echo Site::count_registered(); ?> registered</a> <br />and <a href="online_users.php"><?php echo Site::count_onlineusers(); ?> user(s) online</a></p></center>
			</div>
		</div>
		
		<!-- FOOTER -->
		<div class="container">
			<footer>
				<hr class="featurette-divider">
				<p class="pull-right"><a href="#">Back to top</a></p>
				<?php require "FooterContent.php"; ?>
			</footer>
		</div>
		<br />
		
    <!-- javascripts placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>
</html>