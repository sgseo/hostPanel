<?php
include '../config.php' ;
if (!isset($_SESSION['wangwang'])) {
	header("Location: ./");
	exit ;
}
if (!isset($_SESSION['email'])) {
	header("Location: ./");
	exit ;
}
else{
	$email=$_SESSION['email'] ;
}
$conn=mysqli_connect($dbhost,$dbusername,$dbpassword) or die ("数据库连接错误！") ;
mysqli_select_db($conn,$dbname) or die("无此数据库！"); 
mysqli_query($conn,"set names utf8;");
?>

<?php
if (isset($_GET['order'])) {
	//list
	if ($_GET['order']=='list'){
?>
				<div class="row">
					<form method="GET" action="./?mod=server&item=<?php echo $_GET['item']; ?>&order=list">
						<div class="col-md-2">
							<input type="hidden" name="mod" value="server">
							<input type="hidden" name="item" value="<?php echo $_GET['item']; ?>">
							<input type="hidden" name="order" value="list">
							<input type="text" class="form-control" name="keyword">
						</div>
						<div class="col-md-1">
							<button class="btn btn-primary btn-block" type="submit">搜索</button>
						</div>
						<div class="col-md-9">
							你好，<?php echo $_SESSION['wangwang']."，邮箱：".$email."。" ;?>
						</div>
					</form>
				</div>
				<div class="row">
					<div class="col-md-2">IP地址</div>
					<div class="col-md-2">创建时间</div>
					<div class="col-md-2">到期时间</div>
					<div class="col-md-2">价格（元/月）</div>
					<div class="col-md-2">操作</div>
					<div class="col-md-2">状态</div>
				</div>
<?php
		if (isset($_GET['page'])) {
			$page=$_GET['page'] ;
		}
		else{
			$page=1 ;
		}
		$offset=($page-1)*5 ;
		
		#搜索词
		if (isset($_GET['keyword'])){
			$keyword=$_GET['keyword'] ;
		}
		else{
			$keyword=False ;
		}
		
		#列表
		if($keyword){
			$sql='SELECT a.id,a.idc,a.hostname,a.ip,a.tm_create,a.tm_expire,a.email,a.price,a.wangwang,(SELECT vnc_url FROM host_info WHERE sid=a.id ORDER BY id DESC LIMIT 1) as vnc_url,(SELECT STATUS FROM host_info WHERE sid=a.id ORDER BY id DESC LIMIT 1) AS STATUS,(SELECT COUNT(id) FROM host_task WHERE sid=a.id AND STATUS=1) as task_count FROM host_order a where a.idc="'.$_GET['item'].'" and a.email="'.$email.'" and a.ip like "%'.$keyword.'%" ORDER BY a.id desc limit 5 offset '.$offset.'';
		}
		else{
			$sql='SELECT a.id,a.idc,a.hostname,a.ip,a.tm_create,a.tm_expire,a.email,a.price,a.wangwang,(SELECT vnc_url FROM host_info WHERE sid=a.id ORDER BY id DESC LIMIT 1) as vnc_url,(SELECT STATUS FROM host_info WHERE sid=a.id ORDER BY id DESC LIMIT 1) AS STATUS,(SELECT COUNT(id) FROM host_task WHERE sid=a.id AND STATUS=1) as task_count FROM host_order a where a.idc="'.$_GET['item'].'" and a.email="'.$email.'" ORDER BY a.id desc limit 5 offset '.$offset.'';
		}
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id, $idc,$hostname,$ip,$tm_create,$tm_expire,$email,$price,$wangwang,$vnc_url,$status,$task_count);
			$i=1 ;
			while (mysqli_stmt_fetch($stmt)) {
				//printf ("%s (%s)\n", $idc, $ip);
?>
				<div class="row">
					<div class="col-md-2"><a href="./?mod=server&item=<?php echo $_GET['item']; ?>&order=info&id=<?php echo $id ;?>"><?php echo $ip ;?></a></div>
					<div class="col-md-2"><?php echo $tm_create ;?></div>
					<div class="col-md-2"><?php echo $tm_expire ;?></div>
					<div class="col-md-2"><?php echo $price ;?></div>
					<div class="col-md-2">
						<form name="form" role="form" id="serverReboot<?php echo $i ;?>" method="POST" action="#">
							<input type="hidden" name="id" value="<?php echo $id ;?>">
							<input type="hidden" name="ip" value="<?php echo $ip ;?>">
							<button type="submit" class="btn btn-primary" id="rebootConfirm<?php echo $i ;?>">重启</button>
							<?php if (strlen($vnc_url) != 0) { ?>
							<a href="<?php echo $vnc_url?>" target="_blank"><button type="button" class="btn btn-primary">VNC</button></a>
							<?php } ?>
						</form>
					</div>
					<div class="col-md-2">
<?php 
						if($task_count != 0){
							echo "正在执行任务..." ;
						}
						else{
							echo $status ;
						}
?>
					</div>
				</div>
<?php
			$i=$i+1 ;
			}
?>
				<div class="row">
					<div class="col-md-5 text-left">
						&nbsp;
					</div>
					<div class="col-md-1 text-right">
						<?php
							if ($page == 1){
						?>
						上一页
						<?php
							}
							else{
								if($keyword){
						?>
						<a href="?mod=server&item=<?php echo $_GET['item']; ?>&order=list&keyword=<?php echo $keyword ;?>&page=<?php echo ($page-1) ;?>">上一页</a>
						<?php
								}
								else{
						?>
						<a href="?mod=server&item=<?php echo $_GET['item']; ?>&order=list&page=<?php echo ($page-1) ;?>">上一页</a>
						<?php
								}
							}
						?>
					</div>
					<div class="col-md-1 text-left">
						<?php 
						if($keyword){
						?>
						<a href="?mod=server&item=<?php echo $_GET['item']; ?>&order=list&keyword=<?php echo $keyword ;?>&page=<?php echo ($page+1) ;?>">下一页</a>
						<?php
						}
						else{
						?>
						<a href="?mod=server&item=<?php echo $_GET['item']; ?>&order=list&page=<?php echo ($page+1) ;?>">下一页</a>
						<?php
						}
						?>
					</div>
					<div class="col-md-5 text-right">
						© 2016 nbhao
					</div>
				</div>
<?php
			mysqli_stmt_close($stmt);
		}
		
	}
	//end list

	//info
	if ($_GET['order']=='info'){
		if (isset($_GET['id'])){
			$id=$_GET['id'] ;
			//判断email
			$sql="select id,ip,email from host_order where id=$id" ;
			$stmt = mysqli_prepare($conn, $sql) ;
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id,$ip,$email);
			while (mysqli_stmt_fetch($stmt)) {
				$db_email=$email ;
			}
			$post_email=$_SESSION['email'] ;
			mysqli_stmt_close($stmt);
			//if判断
			if($db_email == $post_email){
?>
				<div class="panel panel-success">
					<div class="panel-heading">
      					<h3 class="panel-title">主机信息</h3>
   					</div>
   					<div class="panel-body">
<?php
				$sql="SELECT a.ip,b.os,b.ram,b.disk,b.vcpu_count,b.location,b.current_bandwidth_gb,b.allowed_bandwidth_gb,b.status,b.vnc_url,b.tm_create FROM host_info b INNER JOIN host_order a ON a.id=b.sid WHERE a.id=$id order by b.id desc limit 1" ;
				$stmt = mysqli_prepare($conn, $sql) ;
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $ip,$os,$ram,$disk,$vcpu_count,$location,$current_bandwidth_gb,$allowed_bandwidth_gb,$status,$vnc_url,$tm_create);
				while (mysqli_stmt_fetch($stmt)) {
?>
					<div class="row">
						<div class="col-md-1">IP地址</div>
						<div class="col-md-2"><?php echo $ip ;?></div>
						<div class="col-md-1">操作系统</div>
						<div class="col-md-2"><?php echo $os ;?></div>
						<div class="col-md-1">内存</div>
						<div class="col-md-2"><?php echo $ram ;?></div>
						<div class="col-md-1">硬盘</div>
						<div class="col-md-2"><?php echo $disk ;?></div>
					</div>
					<div class="row">
						<div class="col-md-1">CPU核数</div>
						<div class="col-md-2"><?php echo $vcpu_count ;?></div>
						<div class="col-md-1">机房</div>
						<div class="col-md-2"><?php echo $location ;?></div>
						<div class="col-md-1">当前流量</div>
						<?php if (strlen($current_bandwidth_gb) != 0) {?>
						<div class="col-md-2"><?php echo $current_bandwidth_gb ;?> GB/月</div>
						<?php } else {?>
						<div class="col-md-2">Null</div>
						<?php } ?>
						<div class="col-md-1">总流量</div>
						<?php if (strlen($allowed_bandwidth_gb) != 0) {?>
						<div class="col-md-2"><?php echo $allowed_bandwidth_gb ;?> GB/月</div>
						<?php } else {?>
						<div class="col-md-2">Null</div>
						<?php } ?>
					</div>
					<div class="row">
						<div class="col-md-1">更新时间</div>
						<div class="col-md-11"><?php echo $tm_create ;?></div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-12">
								注：<br/>
								1、windows服务器默认密码 WWW.nbhao.org ；<br/>
								2、重装系统联系客服旺旺，一个用户暂定一月免费重装一次。
							</div>
						</div>
					</div>
<?php
				}
				mysqli_stmt_close($stmt);
?>
				</div>
				</div>
<?php
			}
			else{
				echo "不要偷看他人主机信息哦。。。" ;
			}
		}
	}
	//end info
}


//action method
if (isset($_GET['action'])) {
	//reboot
	if ($_GET['action']=='reboot'){
		$sid=$_POST['id'];
		$ip=$_POST['ip'];
		$idc=$_GET['item'] ;
		$operator=$_SESSION['email'] ;
		if ( $sid && $ip && $idc && $operator ){
			//判断是否有相同任务未完成
			$sql="select count(id) as count from host_task where sid='$sid' and status=1" ;
			$stmt = mysqli_prepare($conn, $sql) ;
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $count);
			while (mysqli_stmt_fetch($stmt)) {
				$task_count=$count ;
			}
			mysqli_stmt_close($stmt);
			if ($task_count != 0){
				echo "请不要重复提交相同任务！" ;
			}
			else{
				$sql="insert into host_task(sid,ip,idc,task_name,operator,status) values('$sid','$ip','$idc','reboot','$operator',1)" ;
				$stmt = mysqli_prepare($conn, $sql) ;
				mysqli_stmt_execute($stmt);
				if ($stmt){
					echo "任务提交成功，请等待后台重启！" ;
				}
				else{
					echo "任务提交失败，请联系管理员！" ;
				}
				mysqli_stmt_close($stmt);
			}
		}
	}
	//end reboot
}

mysqli_close($conn) ;
?>