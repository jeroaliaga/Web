<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo $ruta_raiz; ?>static/css/default.min.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo $ruta_raiz; ?>static/js/jquery.sceditor.bbcode.min.js"></script>
<style>
	textarea {
		height:300px; width:600px;
	}
</style>
<script>
	jQuery.noConflict();
	jQuery().ready(function() {
		var initEditor = function() {
			jQuery(".SCEditor").sceditor({
				plugins: "bbcode",
				//plugins: "xhtml",
				style: "./static/css/jquery.sceditor.default.min.css",
				toolbar: "bold,italic,underline|cut,copy,paste,pastetext|bulletlist,orderedlis|email,link,unlink|left,center,right,justify|source",
				parserOptions: {
					breakBeforeBlock: false,
					breakStartBlock: false
					// ect.
				}
			});
		};

		initEditor();
	});
</script>
