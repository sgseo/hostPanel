<?php
include '../config.php' ;

if (!isset($_SESSION['username'])) {
	/*
	if($_SESSION['username'] != "" ){
		echo $_SESSION['username'] ;
	}
	*/
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
	<div class="row">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">Nbhao</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							国内主机
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="https://zhangnq.taobao.com/category-1130370426.htm" target="_blank">主机代购</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							国外主机
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="https://item.taobao.com/item.htm?id=522194007039" target="_blank">Linux代购</a></li>
							<li><a href="https://item.taobao.com/item.htm?id=523205318200" target="_blank">DigitalOcean代购</a></li>
							<li><a href="https://item.taobao.com/item.htm?id=525393879787" target="_blank">Vultr代购</a></li>
						</ul>
					</li>
					<li><a target="_blank" href="/donate/"><span>赞助NB号</span></a></li>
					<?php
						include 'include/manage/navbar.php' ;
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							用户管理
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="./?mod=logout">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="row">
	<?php
		if (isset($_GET['item'])) {
			if ($_GET['item']=='ssh'){
				include 'include/manage/ssh.php' ;
			}
			if ($_GET['item']=='host'){
				include 'include/manage/host.php' ;
			}
		}
	?>
	</div>
</div>

<script src="../static/jquery.min.js"></script>
<script src="../static/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>