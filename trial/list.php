<?php
include '../config.php' ;

$conn=mysqli_connect($dbhost,$dbusername,$dbpassword) or die ("数据库连接错误！") ;
mysqli_select_db($conn,$dbname) or die("无此数据库！");
mysqli_query($conn,"set names utf8;");
?>

<?php 
if(isset($_POST['action'])){
	$trade_no=$_POST['trade_no'] ;
?>
<div class="wrapper">
	<section class="panel">
		<header class="panel-heading">
			服务器列表（流水：<?php echo $trade_no ;?>，Linux默认用户名：root，Windows默认用户名：administrator，密码：WWW.nbhao.org 。）
			<span class="tools pull-right"></span>
		</header>
		<div class="panel-body">
			<div class="row text-center">
				<div class="col-md-2">IP</div>
				<div class="col-md-2">密码</div>
				<div class="col-md-3">IPv6</div>
				<div class="col-md-1">VNC</div>
				<div class="col-md-2">创建时间</div>
				<div class="col-md-2">过期时间</div>
			</div>
<?php 
	$sql="select ip,tm_create,tm_expire,default_password,vnc_url,ipv6 from host_trial where is_active=1 and trade_no='".$trade_no."'" ;
	if ($stmt = mysqli_prepare($conn, $sql)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $ip, $tm_create,$tm_expire,$default_password,$vnc_url,$ipv6);
		while (mysqli_stmt_fetch($stmt)) {
?>
			<div class="row text-center">
				<div class="col-md-2"><?php echo $ip ;?></div>
				<div class="col-md-2"><?php echo $default_password ;?></div>
				<div class="col-md-3"><?php echo $ipv6 ;?></div>
				<div class="col-md-1"><a href="<?php echo $vnc_url ;?>" target="_blank">VNC</a></div>
				<div class="col-md-2"><?php echo $tm_create ;?></div>
				<div class="col-md-2"><?php echo $tm_expire ;?></div>
				
			</div>
<?php 
		}
		mysqli_stmt_close($stmt);
	}
?>
			
		</div>
	</section>
</div>
<?php
}
?>