<?php
include '../config.php' ;

if (!isset($_SESSION['email'])) {
	header("Location: ./");
	exit ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>云主机代购查询续费 - 章郎主机</title>
<meta name="keywords" content="章郎主机,云主机查询,云主机续费" />
<meta name="description" content="章郎主机云主机代购查询，自助续费页面。" />
<link rel="stylesheet" href="../static/bootstrap.min.css">
<link href="../static/manage.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<?php include '../template/common/navbar.php' ; ?>
	<div class="row">
	<?php
		if (isset($_GET['item'])) {
			if ($_GET['item']=='vultr'){
				include 'include/server/servers.php' ;
			}
		}
	?>
	</div>
</div>

<script src="../static/jquery.min.js"></script>
<script src="../static/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>