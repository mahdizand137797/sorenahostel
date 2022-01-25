<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
	<title>سایت مدیریت مهمان پذیر</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link href="css/bootstrap.rtl.min.css" rel="stylesheet">
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
		<div id="container">
			<?php include_once("menu.php"); ?>
			<div id="main">
				<?php include_once("slider.php"); ?>
				<div id="left">
					<?php include_once("login.php"); ?>
					<?php include_once("khadamat_text.php"); ?>
				</div>
				<div id="right">
					<?php include($page_content); ?>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
	</div>
</body>

</html>