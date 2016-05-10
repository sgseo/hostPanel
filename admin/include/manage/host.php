<?php
include '../config.php' ;
if (!isset($_SESSION['username'])) {
	header("Location: ./");
	exit ;
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
					<form method="GET" action="./?mod=manage&item=host&order=list">
						<div class="col-md-2">
							<input type="hidden" name="mod" value="manage">
							<input type="hidden" name="item" value="host">
							<input type="hidden" name="order" value="list">
							<input type="text" class="form-control" name="keyword">
						</div>
						<div class="col-md-1">
							<button class="btn btn-primary btn-block" type="submit">搜索</button>
						</div>
						<div class="col-md-9">
							&nbsp;
						</div>
					</form>
				</div>
				<div class="row">
					<div class="col-md-1">主机商</div>
					<div class="col-md-1">主机名</div>
					<div class="col-md-2">IP地址</div>
					<div class="col-md-2">创建时间</div>
					<div class="col-md-2">到期时间</div>
					<div class="col-md-2">邮箱</div>
					<div class="col-md-2">价格（元/月）</div>
				</div>
<?php
		if (isset($_GET['page'])) {
			$page=$_GET['page'] ;
		}
		else{
			$page=1 ;
		}
		$offset=($page-1)*10 ;
		
		#搜索词
		if (isset($_GET['keyword'])){
			$keyword=$_GET['keyword'] ;
		}
		else{
			$keyword=False ;
		}
		
		//统计
		$sql_tongji='SELECT (SELECT COUNT(*) AS COUNT FROM host_order WHERE idc="digitalocean") AS do_cnt,
				(SELECT COUNT(*) AS COUNT FROM host_order WHERE idc="vultr") AS vu_cnt,
				(SELECT COUNT(*) AS COUNT FROM host_order WHERE idc="linode") AS li_cnt' ;
		$stmt=mysqli_prepare($conn,$sql_tongji) ;
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $do_cnt,$vu_cnt,$li_cnt);
		while (mysqli_stmt_fetch($stmt)) {
				$do_cnt = $do_cnt ;
				$vu_cnt = $vu_cnt ;
				$li_cnt = $li_cnt ;
		}
		mysqli_stmt_close($stmt);
		
		#列表
		if($keyword){
			$sql='SELECT id,idc,hostname,ip,tm_create,tm_expire,email,price,wangwang FROM host_order where ip like "%'.$keyword.'%" ORDER BY id desc limit 10 offset '.$offset.'';
		}
		else{
			$sql='SELECT id,idc,hostname,ip,tm_create,tm_expire,email,price,wangwang FROM host_order ORDER BY id desc limit 10 offset '.$offset.'';
		}
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id, $idc,$hostname,$ip,$tm_create,$tm_expire,$email,$price,$wangwang);
			while (mysqli_stmt_fetch($stmt)) {
				//printf ("%s (%s)\n", $idc, $ip);
?>
				<div class="row">
					<div class="col-md-1"><?php echo $idc ;?></div>
					<div class="col-md-1"><?php echo $hostname ;?></div>
					<div class="col-md-2"><a href="./?mod=manage&item=host&order=info&id=<?php echo $id ;?>"><?php echo $ip ;?></a></div>
					<div class="col-md-2"><?php echo $tm_create ;?></div>
					<div class="col-md-2"><?php echo $tm_expire ;?></div>
					<div class="col-md-2"><?php echo $email ;?></div>
					<div class="col-md-2"><?php echo $price ;?></div>
				</div>
<?php
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
						<a href="?mod=manage&item=host&order=list&keyword=<?php echo $keyword ;?>&page=<?php echo ($page-1) ;?>">上一页</a>
						<?php
								}
								else{
						?>
						<a href="?mod=manage&item=host&order=list&page=<?php echo ($page-1) ;?>">上一页</a>
						<?php
								}
							}
						?>
					</div>
					<div class="col-md-1 text-left">
						<?php 
						if($keyword){
						?>
						<a href="?mod=manage&item=host&order=list&keyword=<?php echo $keyword ;?>&page=<?php echo ($page+1) ;?>">下一页</a>
						<?php
						}
						else{
						?>
						<a href="?mod=manage&item=host&order=list&page=<?php echo ($page+1) ;?>">下一页</a>
						<?php
						}
						?>
					</div>
					<div class="col-md-5 text-right">
						本地统计：Linode：<?php echo $li_cnt ;?>、DigitalOcean：<?php echo $do_cnt ;?>、Vultr：<?php echo $vu_cnt ;?>
					</div>
				</div>
<?php
			mysqli_stmt_close($stmt);
		}
		
	}

	//add
	if ($_GET['order']=='add'){
?>
					<form role="form" class="form" id='form' action="./?mod=manage&item=host&action=add" method="post">
						<div class="form-group">
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">主机商</label></div>
								<div class="col-md-5">
									<select class="form-control" name="idc">
										<option value="linode" selected="selected">Linode</option>
										<option value="digitalocean">DigitalOcean</option>
										<option value="vultr">Vultr</option>
										<option value="conoha">ConoHa</option>
									</select>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">主机名</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="hostname">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">IP地址</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="ip">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">创建时间</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="tm_create">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">到期时间</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="tm_expire">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">邮箱地址</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="email">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">价格<br/>（元/月）</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="price">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">旺旺</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="wangwang">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="hidden" name="action" value="add" />
										<button type="submit" class="btn btn-lg btn-primary btn-block">添加</button>
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
						</div>
					</form>
<?php
	}

	//info
	if ($_GET['order']=='info'){
		if (isset($_GET['id'])) {
			$sql='SELECT id,idc,hostname,ip,tm_create,tm_expire,email,price,wangwang,password FROM host_order where id='.$_GET['id'].'';
			if ($stmt = mysqli_prepare($conn, $sql)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $id, $idc,$hostname,$ip,$tm_create,$tm_expire,$email,$price,$wangwang,$password);
				while (mysqli_stmt_fetch($stmt)) {
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>主机商</div>\n\t\t\t<div class='col-md-10'>".$idc."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>主机名</div>\n\t\t\t<div class='col-md-10'>".$hostname."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>IP地址</div>\n\t\t\t<div class='col-md-10'>".$ip."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>创建时间</div>\n\t\t\t<div class='col-md-10'>".$tm_create."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>到期时间</div>\n\t\t\t<div class='col-md-10'>".$tm_expire."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>邮箱</div>\n\t\t\t<div class='col-md-10'>".$email."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>价格</div>\n\t\t\t<div class='col-md-10'>".$price."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>旺旺</div>\n\t\t\t<div class='col-md-10'>".$wangwang."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'>主机密码</div>\n\t\t\t<div class='col-md-10'>".$password."</div>\n\t\t</div>\n";
					echo "\t\t<div class='row'>\n\t\t\t<div class='col-md-2'></div>\n\t\t\t<div class='col-md-1'><a href='./?mod=manage&item=host&order=update&id=".$id."'><button class=\"btn btn-lg btn-primary btn-block\">更新</button></a></div>\n\t\t\t<div class='col-md-1'><button class=\"btn btn-lg btn-primary btn-block\">删除</button></div>\n\t\t\t<div class='col-md-8'></div>\n\t\t</div>\n";
				}
			}
		}
	}

	//update
	if ($_GET['order']=='update'){
		if (isset($_GET['id'])) {
			$sql='SELECT id,idc,hostname,ip,tm_create,tm_expire,email,price,wangwang,password FROM host_order where id='.$_GET['id'].'';
			if ($stmt = mysqli_prepare($conn, $sql)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $id, $idc,$hostname,$ip,$tm_create,$tm_expire,$email,$price,$wangwang,$password);
				while (mysqli_stmt_fetch($stmt)) {
?>
					<form role="form" class="form" id='form' action="./?mod=manage&item=host&action=update" method="post">
						<div class="form-group">
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">主机商</label></div>
								<div class="col-md-5">
									<select class="form-control" name="idc">
										<option value="<?php echo $idc ;?>" selected="selected"><?php echo $idc ;?></option>
									</select>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">主机名</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="hostname" value="<?php echo $hostname ;?>">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">IP地址</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="ip" value="<?php echo $ip ;?>">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">创建时间</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="tm_create" value="<?php echo $tm_create ;?>">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">到期时间</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="tm_expire" value="<?php echo $tm_expire ;?>">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">邮箱地址</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="email" value="<?php echo $email ;?>">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">价格<br/>（元/月）</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="price" value="<?php echo $price ;?>">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">旺旺</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="wangwang" value="<?php echo $wangwang ;?>">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="hidden" name="action" value="update" />
										<input type="hidden" name="id" value="<?php echo $id ;?>" />
										<button type="submit" class="btn btn-lg btn-primary btn-block">更新</button>
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
						</div>
					</form>
<?php
				}
			}
		}
	}
}

//action
if (isset($_POST['action'])) {
	//add
	if ($_GET['action']=='add'){
		if ( !$_POST['idc'] || !$_POST['hostname'] || !$_POST['ip'] || !$_POST['tm_create'] || !$_POST['tm_expire'] || !$_POST['email'] || !$_POST['price'] || !$_POST['wangwang']){
			echo "<script>alert('Invalid form,return!');window.location.href='./?mod=manage&item=host&order=add';</script>";
		}
		else{
			$sql="insert into host_order(idc,hostname,ip,tm_create,tm_expire,email,price,wangwang) values('".$_POST['idc']."','".$_POST['hostname']."','".$_POST['ip']."','".$_POST['tm_create']."','".$_POST['tm_expire']."','".$_POST['email']."','".$_POST['price']."','".$_POST['wangwang']."')" ;
			$result=mysqli_query($conn,$sql) ;
			if($result == 1){
				echo "<script>alert('Add successfully!');window.location.href='./?mod=manage&item=host&order=list';</script>";
			}
			else{
				echo "<script>alert('Invalid form,return!');window.location.href='./?mod=manage&item=host&order=add';</script>";
			}
		}
	}
	//update
	if ($_GET['action']=='update'){
		if ( !$_POST['id'] || !$_POST['idc'] || !$_POST['hostname'] || !$_POST['ip'] || !$_POST['tm_create'] || !$_POST['tm_expire'] || !$_POST['email'] || !$_POST['price'] || !$_POST['wangwang']){
			echo "<script>alert('Invalid form,return!');window.location.href='./?mod=manage&item=host&order=update&id=".$_POST['id']."';</script>";
		}
		else{
			$sql="update host_order set idc='".$_POST['idc']."',hostname='".$_POST['hostname']."',ip='".$_POST['ip']."',tm_create='".$_POST['tm_create']."',tm_expire='".$_POST['tm_expire']."',email='".$_POST['email']."',price='".$_POST['price']."',wangwang='".$_POST['wangwang']."' where id=".$_POST['id']."" ;
			$result=mysqli_query($conn,$sql) ;
			if($result == 1){
				echo "<script>alert('Update successfully!');window.location.href='./?mod=manage&item=host&order=info&id=".$_POST['id']."';</script>";
			}
			else{
				echo "<script>alert('Invalid form,return!');window.location.href='./?mod=manage&item=host&order=update&id=".$_POST['id']."';</script>";
			}
		}
	}
}


mysqli_close($conn) ;
?>