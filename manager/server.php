<?php
include '../config.php' ;
if (!isset($_SESSION['email'])) {
	header("Location: ./");
	exit ;
}
//action return message
if (isset($_GET['item'])) {
	if (isset($_GET['action'])) {
		include 'include/server/servers.php' ;
		exit ;
	}
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
			else if ($_GET['item']=='linode'){
				include 'include/server/servers.php' ;
			}
			else if ($_GET['item']=='digitalocean'){
				include 'include/server/servers.php' ;
			}
			else{
				echo "Invalid item." ;
			}
		}
	?>
	</div>
</div>

<script src="../static/jquery.min.js"></script>
<script src="../static/jquery.confirm.min.js"></script>
<script src="../static/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script>

function rebootServer(idc,seq){
	$.ajax({
		type:'POST',
		url:'./?mod=server&item='+idc+'&action=reboot',
		data: $('#serverReboot'+seq).serialize(),
		success:function(data){
			alert (data) ;
			window.location.reload();
		},
		error:function(){
			alert ('System Error!') ;
		}
	}) ;
}

$("#rebootConfirm1").confirm({
    	title:"确定重启？",
    	text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
    	confirm: function(button){
			rebootServer('<?php echo $_GET['item'] ;?>','1') ;
    	},
    	confirmButton: "是的，我确定",
    	cancelButton: "不了"
});
$("#rebootConfirm2").confirm({
	title:"确定重启？",
	text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
	confirm: function(button){
		rebootServer('<?php echo $_GET['item'] ;?>','2') ;
	},
	confirmButton: "是的，我确定",
	cancelButton: "不了"
});
$("#rebootConfirm3").confirm({
	title:"确定重启？",
	text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
	confirm: function(button){
		rebootServer('<?php echo $_GET['item'] ;?>','3') ;
	},
	confirmButton: "是的，我确定",
	cancelButton: "不了"
});
$("#rebootConfirm4").confirm({
	title:"确定重启？",
	text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
	confirm: function(button){
		rebootServer('<?php echo $_GET['item'] ;?>','4') ;
	},
	confirmButton: "是的，我确定",
	cancelButton: "不了"
});
$("#rebootConfirm5").confirm({
	title:"确定重启？",
	text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
	confirm: function(button){
		rebootServer('<?php echo $_GET['item'] ;?>','5') ;
	},
	confirmButton: "是的，我确定",
	cancelButton: "不了"
});

</script>
</body>
</html>