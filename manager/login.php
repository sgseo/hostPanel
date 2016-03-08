<?php
include '../config.php' ;

if (isset($_SESSION['email'])) {
	header("Location: ./?mod=server");
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
<link href="../static/login.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="../static/ie10-viewport-bug-workaround.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">

      <form class="form-signin" method="POST" action="./?action=login">
        <h2 class="form-signin-heading text-center">登录</h2>
        <label for="inputUsername" class="sr-only">旺旺用户名</label>
        <input type="username" id="inputUsername" name="wangwang" class="form-control" placeholder="旺旺用户名" required autofocus>
        <label for="inputPassword" class="sr-only">Email</label>
        <input type="username" id="inputPassword" name="email" class="form-control" placeholder="Email" required>
        <div class="checkbox">
          
        </div>
		<input type="hidden" name="action" value="login" />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

</div> <!-- /container -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../static/ie10-viewport-bug-workaround.js"></script>
</body>
</html>