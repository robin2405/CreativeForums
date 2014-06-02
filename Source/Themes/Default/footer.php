	</div>
		<br />
		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
						<?php
						// Query the posts table for all posts in the specified topic
						$sql2 = "SELECT * FROM users WHERE TIMESTAMPDIFF(SECOND,`last_Active`,NOW()) <= 5 LIMIT 50";
						// Execute the SELECT query
						$res2 = mysql_query($sql2) or die(mysql_error());
						// Fetch all the post data from the database
						while ($row2 = mysql_fetch_assoc($res2)) {
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
		
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<script src="../../bootstrap/js/docs.min.js"></script>
</body>
</html>