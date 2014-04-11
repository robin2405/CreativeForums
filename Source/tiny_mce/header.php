<?php
session_start(); // Start your sessions to allow your page to interact with session variables
include_once("connect.php");

$uid = $_SESSION[uid];

$sql = "UPDATE users SET Last_Active=now() WHERE id='".$uid."'";
$res = mysql_query($sql) or die(mysql_error());

// Function that will convert a user id into their Permission
function getpermission($uid) {
	$sql = "SELECT Permission FROM users WHERE id='".$uid."'";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['Permission'];
}

function getusername($uid) {
	$sql = "SELECT username FROM users WHERE id='".$uid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['username'];
}

// Function that will convert a user id into their username
function getstyle($sid) {
	$sql = "SELECT content FROM style WHERE id='".$sid."' LIMIT 1";
	$res = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($res);
	return $row['content'];
}

// Function that will convert a user id into their username
function count_onlineusers() {
 $sql = "SELECT * FROM users WHERE TIMESTAMPDIFF(MINUTE,`last_Active`,NOW()) <= 15";
 $res = mysql_query($sql) or die(mysql_error());
 $post_count = mysql_num_rows($res);
 return $post_count;
}

$_SESSION['username'] = getusername($uid); // Username for chatting
$permission = getpermission($uid);
$admin = 'admin';
?>
<!doctype html>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" type="image/png" href="favicon.png">
        <title>Roit Skield Gaming</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="//dunb17ur4ymx4.cloudfront.net/assets/50/popup/style.css" /><script type="text/javascript" src="//dunb17ur4ymx4.cloudfront.net/assets/50/popup/script.js"></script>
	<style type="text/css">
	<?php echo"".getstyle('1').""; ?>
	</style>
        <link type="text/css" rel="stylesheet" media="all" href="chat/css/chat.css" />

	<link rel="stylesheet" href="styles/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="styles/nivo-slider.css" type="text/css" media="screen" />
	<script type="text/javascript" src="scripts/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
	<script type="text/javascript">
	sfHover = function() {
	var sfEls = document.getElementById("navbar").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" hover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" hover\\b"), "");
		}
	}
	}
	if (window.attachEvent) window.attachEvent("onload", sfHover);
	</script>


<!-- Start css3menu.com HEAD section -->
<link rel="stylesheet" href="header_files/css3menu1/style.css" type="text/css" />
<!-- End css3menu.com HEAD section -->

</head>
<body><script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script><script src="scripts/cookieControl-5.1.min.js" type="text/javascript"></script><script type="text/javascript">//<![CDATA[  cookieControl({      introText:'Deze website gebruikt cookies om informatie te bewaren op uw computer.',      fullText:'Beste,<br />Sommige cookies zijn essentieel van belang voor de website zonder die kan de website niet 100% werken dus bepaalde functies kunnen niet meer werken als je ze uitzet</p><p>Om de cookies te beheren kunt u ook naar <a href="http://www.civicuk.com/cookie-law/browser-settings" target="_blank">gaan</a>.</p><p>By using our site you accept the terms of our <a href="http://www.craftopianl.com/privacy.php">Privacy Policy</a>.</p>',      position:'left', // left or right      shape:'triangle', // triangle or diamond      theme:'dark', // light or dark      startOpen:true,      autoHide:6000,      subdomains:true,      protectedCookies: [], //list the cookies you do not want deleted ['analytics', 'twitter']      consentModel:'information_only',      onAccept:function(){ccAddAnalytics()},      onReady:function(){},      onCookiesAllowed:function(){ccAddAnalytics()},      onCookiesNotAllowed:function(){},      countries:'' // Or supply a list ['United Kingdom', 'Greece']      });      function ccAddAnalytics() {        jQuery.getScript("http://www.google-analytics.com/ga.js", function() {          var GATracker = _gat._createTracker('');          GATracker._trackPageview();        });      }   //]]></script>  
	<div class="content">
		<ul id="navbar2">
			<?php
				if (!isset($_SESSION['uid'])) {
				echo' <li><a href="login.php">Login</a></li>
					  <li><a href="register.php">register</a></li>';
			} else {
			echo'
				<li><a href="profile.php"><img src="http://achievecraft.com/tools/avatar/64/'.getusername($uid).'.png" style="vertical-align:middle;width:30px;height:30px;background:url();background-size:70px 70px;" /><font style="vertical-align:middle;"> '.getusername($uid).'</font></a><ul>
				<li><a href="messages.php">Berichten</a></li>
				<li><a href="editprofile.php">Pas profiel aan</a></li>
				<li><a href="content.php">Mijn inhoud</a></li>';
				if ($permission==$admin) {
        			echo '<li><a href="admin.php">Admin Panneel</a></li>';
				}
				echo '
				<li><a href="logout_parse.php">Log uit</a></li>
				</ul>

                                ';
			}
			?>
		</ul>
<form action="chat_parse.php" method="post" style="margin-left:71%; margin-top:8px;position: fixed;z-index: 1000;">                                
Chat met: <input type="text" name="name"> <input type="submit" value="Chat!" />
</form>
		<div class="Header"></div>
                <div class="logo"></div> 
<center>
<ul id="css3menu1" class="topmenu">
	<li class="topfirst"><a href="index.php" style="height:22px;line-height:22px;"><img src="header_files/css3menu1/home.png" alt=""/>Home</a></li>
	<li class="topmenu"><a href="forum.php" style="height:22px;line-height:22px;"><img src="header_files/css3menu1/lala.png" alt=""/>Forum</a></li>
	<li class="topmenu"><a href="pages.php?page=7" style="height:22px;line-height:22px;"><img src="header_files/css3menu1/kaka.png" alt=""/>Donneer</a></li>
	<li class="topmenu"><a href="pages.php?page=6" style="height:22px;line-height:22px;"><img src="header_files/css3menu1/donate.png" alt=""/>Stem</a></li>
	<li class="topmenu"><a href="pages.php?page=2" style="height:22px;line-height:22px;"><img src="header_files/css3menu1/forum.png" alt=""/>Community</a></li>
	<li class="topmenu"><a href="pages.php?page=4" style="height:22px;line-height:22px;"><img src="header_files/css3menu1/tralalala.png" alt=""/>regels</a></li>
	<li class="toplast"><a href="pages.php?page=5" style="height:22px;line-height:22px;"><img src="header_files/css3menu1/server_lijst.png" alt=""/>Server Lijst</a></li>
</ul>
<!-- End css3menu.com BODY section -->
<!-- IMPLEMENTING THE TINYMCE WYSIWYG EDITOR -->

<script language="javascript" type="text/javascript" src="tiny_mce/tinymce.min.js"></script>

<script type="text/javascript">

tinymce.init({

    selector: "textarea",

    theme: "modern",

    plugins: [

        "link image charmap preview anchor pagebreak hr",

        "searchreplace wordcount visualblocks visualchars fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons paste image textcolor",

    ],

    toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview media | forecolor backcolor emoticons",

    templates: [],

});

</script>

<!-- END TINYMCE SCRIPT -->
</center>
		</div>
<script type="text/javascript" src="chat/js/jquery.js"></script>
<script type="text/javascript" src="chat/js/chat.js"></script>
