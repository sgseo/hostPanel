<?php
include '../config.php' ;

if (!isset($_GET['mod']) && !isset($_POST['action']) ) {
	include 'form.php' ;
}

//mod
if (isset($_GET['mod'])) {
	//order
	if ($_GET['mod']=='order' && isset($_GET['name']) && isset($_GET['plan'])  && isset($_GET['price'])){
		include 'form.php' ;
	}
	else{
		echo "error";
	}
}

//action
if (isset($_POST['action'])) {
	//order
	if($_POST['action']=='order'){
		require_once("../../order/alipay/config.php");
		require_once("../../order/alipay/Alipay.php");
		
		$alipay = new Alipay($config=$config_host_trial,$type='');
		
		$conn=mysqli_connect($dbhost,$dbusername,$dbpassword) or die ("数据库连接错误！") ;
		mysqli_select_db($conn,$dbname) or die("无此数据库！");
		mysqli_query($conn,"set names utf8;");
		
		$tm_create=date("Y-m-d H:i:s") ;
		$tm_expire=date("Y-m-d H:i:s",strtotime("+1 day")) ;
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$order_id = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
		$subject = 'host-trial-'.$order_id ;
		$body = "".$_POST['os']." ".$_POST['number']." VPS." ;
		
		for($i=0;$i<$_POST['number'];$i++){
			if($_POST['os'] == 'linux'){
				$osid = $_POST['distribution'];
				$snapshotid = '';
			}
			else if($_POST['os'] == 'windows'){
				$osid = 127;
				$snapshotid = $_POST['distribution'];
			}
			
			$sql="insert into host_trial(tm_create,tm_expire,order_id,price,dcid,planid,osid,snapshotid) values('".$tm_create."','".$tm_expire."','".$order_id."','".$_POST['singleprice']."','".$_POST['dcid']."','".$_POST['planid']."','".$osid."','".$snapshotid."')" ;
			
			$result=mysqli_query($conn,$sql) ;
		}
		
		$body = $alipay->buildRequestFormHTML(array(
				'out_trade_no'      => $order_id,
				'subject'           => $subject,
				'total_fee'         => $_POST['price'],
				'body'              => $body,
				'show_url'          => 'http://'.$_SERVER['HTTP_HOST'].'/host/',
				'anti_phishing_key' => '',
				'exter_invoke_ip'   => '',
				//'it_b_pay'          => $this->setting['paymentTimeout'] / 60 . 'm',
				//'_input_charset'    => $this->config->item('input_charset', 'alipay')
		));
		// 输出 HTML 到浏览器，JS 会自动发起提交
		echo $body;
	}
	else{
		echo "error";
	}
}

