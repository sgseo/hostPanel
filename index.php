<?php include 'config.php' ;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>云主机代购查询续费 - 章郎主机</title>
<meta name="keywords" content="章郎主机,云主机查询,云主机续费" />
<meta name="description" content="章郎主机云主机代购查询，自助续费页面。" />
<link rel="stylesheet" href="static/bootstrap.min.css">
<style>
	.row{
		margin-bottom:20px;
	}
	[class*="col-"]{
			padding-top:5px;
			padding-bottom:5px;
	}
</style>
</head>
<body>
<div class="container">
	<?php include 'template/common/navbar.php' ; ?>
</div>
<div class="container">
	<div class="row well">
		<form role="form" class="form" id='form' action="IPInfo.php" method="post">
			<div class="form-group">
				<div class="col-md-2"></div>
				<div class="col-md-10"><h3>云主机查询和续费</h3></div>
				<div class="col-md-2">
				</div>
				<div class="col-md-10">
					<p>1、（续费）选择IDC服务商，输入IP地址查询，确认后自助续费，支付宝付款。（推荐）</p>
					<p>2、（续费）点击页面上方主机，打开购买淘宝界面，通过淘宝下单购买。购买后联系客服手动续费。</p>
					<p>3、逾期未续费的主机直接删除，数据不可恢复。</p>
					<p>4、续费不支持退款服务。</p>
				</div>
				<div class="control-group">
					<div class="col-md-2"><label class="control-label">主机商：</label></div>
					<div class="col-md-10">
						<select class="form-control" name="idc">
							<option value="linode" selected="selected">Linode</option>
							<option value="digitalocean">DigitalOcean</option>
							<option value="vultr">Vultr</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="col-md-2">
						<label class="control-label" for="inputIP">IP地址：</label>
					</div>
					<div class="col-md-10">
						<div class="controls">
							<input type="text" class="form-control" id="inputIP" name="ip" placeholder="请输入您的IP地址...">
						</div>
					</div>
				</div>
				<div class="control-group">
					<div class="col-md-2">
					</div>
					<div class="col-md-10">
						<div class="controls">
							<button type="submit" class="btn btn-default">查询</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<a class="infolist_fff" target="_blank" href="http://www.nbhao.org/">nbhao</a> 版权所有 2011-2013 All Rights Reserved .
                        <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_3075497'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s5.cnzz.com/stat.php%3Fid%3D3075497' type='text/javascript'%3E%3C/script%3E"));</script>
		</div>
	</div>
</div>

<script src="static/jquery.min.js"></script>
<script src="static/bootstrap-validation.js" type="text/javascript" charset="utf-8"></script>
<script src="static/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
    $(function () {
        $('#form').validation();//自定义form表单的id
    })
    $(function () {
        $('#form1').validation();//自定义form表单的id
    })
</script>
</body>
</html>

