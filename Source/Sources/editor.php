<?php
	echo' <script language="javascript" type="text/javascript" src="'.$Root.'tiny_mce/tinymce.min.js"></script>

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

	</script>';
?>