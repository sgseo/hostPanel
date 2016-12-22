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
					<form method="GET" action="./?mod=manage&item=trial&order=list">
						<div class="col-md-2">
							<input type="hidden" name="mod" value="manage">
							<input type="hidden" name="item" value="trial">
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
					<div class="col-md-3">流水号</div>
					<div class="col-md-1">主机名</div>
					<div class="col-md-1">IP地址</div>
					<div class="col-md-2">创建时间</div>
					<div class="col-md-2">到期时间</div>
					<div class="col-md-1">付款状态</div>
					<div class="col-md-1">价格（元/月）</div>
					<div class="col-md-1">主机状态</div>
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
		
		#列表
		if($keyword){
			$sql='SELECT id,hostname,ip,tm_create,tm_expire,trade_status,price,is_active,trade_no FROM host_trial where ip like "%'.$keyword.'%" ORDER BY id desc limit 10 offset '.$offset.'';
		}
		else{
			$sql='SELECT id,hostname,ip,tm_create,tm_expire,trade_status,price,is_active,trade_no FROM host_trial ORDER BY id desc limit 10 offset '.$offset.'';
		}
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id,$hostname,$ip,$tm_create,$tm_expire,$trade_status,$price,$is_active,$trade_no);
			while (mysqli_stmt_fetch($stmt)) {
				//printf ("%s (%s)\n", $idc, $ip);
?>
				<div class="row">
					<div class="col-md-3"><?php echo $trade_no ;?></div>
					<div class="col-md-1"><?php echo $hostname ;?></div>
					<div class="col-md-1"><?php echo $ip ;?></div>
					<div class="col-md-2"><?php echo $tm_create ;?></div>
					<div class="col-md-2"><?php echo $tm_expire ;?></div>
					<div class="col-md-1"><?php echo $trade_status ;?></div>
					<div class="col-md-1"><?php echo $price ;?></div>
					<div class="col-md-1"><?php echo $is_active ;?></div>
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
						<a href="?mod=manage&item=trial&order=list&keyword=<?php echo $keyword ;?>&page=<?php echo ($page-1) ;?>">上一页</a>
						<?php
								}
								else{
						?>
						<a href="?mod=manage&item=trial&order=list&page=<?php echo ($page-1) ;?>">上一页</a>
						<?php
								}
							}
						?>
					</div>
					<div class="col-md-1 text-left">
						<?php 
						if($keyword){
						?>
						<a href="?mod=manage&item=trial&order=list&keyword=<?php echo $keyword ;?>&page=<?php echo ($page+1) ;?>">下一页</a>
						<?php
						}
						else{
						?>
						<a href="?mod=manage&item=trial&order=list&page=<?php echo ($page+1) ;?>">下一页</a>
						<?php
						}
						?>
					</div>
					<div class="col-md-5 text-right">
						本地统计：
					</div>
				</div>
<?php
			mysqli_stmt_close($stmt);
		}
		
	}

	//add
	if ($_GET['order']=='add'){
?>
					<form role="form" class="form" id='form' action="./?mod=manage&item=trial&action=add" method="post">
						<div class="form-group">
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">套餐</label></div>
								<div class="col-md-5">
									<select class="form-control" name="planid">
										<option value=29 select>768MB</option>
	                            		<option value=93>1024MB</option>
									</select>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">机房</label></div>
								<div class="col-md-5">
									<select class="form-control" name="dcid">
										<option value=25 select>东京</option>
	                            		<option value=40>新加坡</option>
	                            		<option value=5>洛杉矶</option>
	                            		<option value=4>西雅图</option>
	                            		<option value=19>澳大利亚</option>
									</select>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">操作系统</label></div>
								<div class="col-md-5">
									<select class="form-control" name="osid">
										<option value=127 select>CentOS 6 x64</option>
										<option value=167>CentOS 7 x64</option>
										<option value=193>Debian 8 x64</option>
										<option value=215>Ubuntu 16.04 x64</option>
									</select>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">镜像</label></div>
								<div class="col-md-5">
									<select class="form-control" name="snapshotid">
										<option value="" select>无</option>
										<option value="851572a0a81ef">Windows XP i386</option>
										<option value="4cf56d67644ed">Windows 2003 x64</option>
										<option value="cf57b994b45ee">Windows 2008 x64</option>
									</select>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">价格<br/>（元/月）</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="price" value=5 >
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">流水号</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="trade_no">
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">是否付款</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="trade_status" value=1>
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">创建时间</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="tm_create" value="<?php echo date("Y-m-d H:i:s") ;?>" readonly>
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<div class="control-group row">
								<div class="col-md-1"><label class="control-label">到期时间</label></div>
								<div class="col-md-5">
									<div class="controls">
										<input type="text" class="form-control" name="tm_expire" value="<?php echo date("Y-m-d H:i:s",strtotime("+1 day")) ; ?>" readonly>
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
}

//action
if (isset($_POST['action'])) {
	//add
	if ($_GET['action']=='add'){
		//if ( !$_POST['planid'] || !$_POST['dcid'] || !$_POST['osid'] || !$_POST['price'] || !$_POST['trade_no'] || !$_POST['trade_status'] || !$_POST['tm_create'] || !$_POST['tm_expire'] ){
		if ( !$_POST['planid'] ){
			/*
			echo "error"."<br/>";
			echo $_POST['planid']."<br/>";
			echo $_POST['dcid']."<br/>";
			echo $_POST['osid']."<br/>";
			echo $_POST['snapshotid']."<br/>";
			echo $_POST['price']."<br/>";
			echo $_POST['trade_no']."<br/>";
			echo $_POST['trade_status']."<br/>";
			echo $_POST['tm_create']."<br/>";
			echo $_POST['tm_expire']."<br/>";
			*/
			echo "<script>alert('Invalid form,return!');window.location.href='./?mod=manage&item=trial&order=add';</script>";
		}
		else{
			$sql="insert into host_trial(planid,dcid,osid,snapshotid,price,trade_no,trade_status,tm_create,tm_expire) values('".$_POST['planid']."','".$_POST['dcid']."','".$_POST['osid']."','".$_POST['snapshotid']."','".$_POST['price']."','".$_POST['trade_no']."','".$_POST['trade_status']."','".$_POST['tm_create']."','".$_POST['tm_expire']."')" ;
			$result=mysqli_query($conn,$sql) ;
			if($result == 1){
				echo "<script>alert('Add successfully!');window.location.href='./?mod=manage&item=trial&order=list';</script>";
			}
			else{
				echo "<script>alert('Invalid form,return!');window.location.href='./?mod=manage&item=trial&order=add';</script>";
			}
		}
	}
}


mysqli_close($conn) ;
?>