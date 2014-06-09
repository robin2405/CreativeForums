<?php
    session_start(); // Start your sessions to allow your page to interact with session variables

    include_once("Classes/Connect.class.php");
    $link = DbConnection::getConnection();

    // Check to see if they person accessing this page is logged in and that there is a category id in the url
    if ((!isset($_SESSION['uid'])) || ($_GET['cid'] == "")) {
    	header("Location: index.php");
    	exit();
    }
    // Assign local variables found in the url
    $cid = $_GET['cid'];
    $tid = $_GET['tid'];
    $pid = $_GET['pid'];

    include_once("header.php");
    ?>
    <!-- IMPLEMENTING THE TINYMCE WYSIWYG EDITOR -->
    <script language="javascript" type="text/javascript" src="tiny_mce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        plugins: [
            "link image charmap preview anchor pagebreak hr",
            "searchreplace wordcount visualblocks visualchars fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons paste image"
        ],
        toolbar1: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview media | forecolor backcolor emoticons",
        templates: [],
    });
    </script>
    <!-- END TINYMCE SCRIPT -->
    <?php
    // Function that will convert a user id into their username
    function getposttext($pid) {
        $link = DbConnection::getConnection();
        $sql = "SELECT post_content FROM posts WHERE id='".mysqli_real_escape_string($link, $pid)."' LIMIT 1";
    	$res = mysqli_query($link, $sql) or Mysql::HandleError(mysqli_error($link));
    	$row = mysqli_fetch_assoc($res);
    	return $row['post_content'];
    }
    		echo "<p>Go back to <a href='view_topic.php?cid=".$cid."&tid=".$tid."'>Topic</a>.</p>";
    		?>
    <form action="edit_reply_parse.php?pid=<?php echo $pid ?>" method="post">
    <textarea name="reply_content" rows="5" cols="75"><?php echo getposttext($pid); ?></textarea>
    <br /><br />
    <input type="hidden" name="cid" value="<?php echo $cid; ?>" />
    <input type="hidden" name="tid" value="<?php echo $tid; ?>" />
    <center><input class="btn btn-lg btn-primary btn-block" type="submit" name="reply_submit" value="Edit post" /></center>
    </form>
    <?php
    include_once("footer.php");
?>			