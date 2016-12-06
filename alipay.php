<?php

require_once("../order/alipay/config.php");
require_once("../order/alipay/Alipay.php");

$alipay = new Alipay($config=$config_host,$type='');

/*************订单生成**************/
$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
$order_id = $orderSn;
$subject = 'host-'.$orderSn ;

$ip = $_POST['ip'];
$price = $_POST['WIDprice'];
$tm_create=$_POST['tm_create'];
$tm_expire=$_POST['tm_expire'];
$quantity=$_POST['quantity'];
$tm_expire_next=date("Y-m-d H:i:s",strtotime("+$quantity month",strtotime($tm_expire))) ;
$update="update host_order set order_id='$order_id',renew_quantity='$quantity' where ip='$ip'" ;
$res=mysql_query($update) ;


// 生成支付表单
if($quantity==1){
	$price = $_POST['WIDprice'];
	$price =$price;
}
if($quantity==3){
	$price = $_POST['WIDprice'];
	$price =$price*3;
}
if($quantity==12){
	$price = $_POST['WIDprice'];
	$price =$price*12*0.95;
}
if($quantity==24){
	$price = $_POST['WIDprice'];
	$price =$price*24*0.9;
}
if($quantity==36){
	$price = $_POST['WIDprice'];
	$price =$price*36*0.8;
}

$body = $alipay->buildRequestFormHTML(array(
    'out_trade_no'      => $orderSn,
    'subject'           => $subject,
    'total_fee'         => $price,
    'body'              => $_POST['ip'],
    'show_url'          => 'http://'.$_SERVER['HTTP_HOST'].'/host/',
    'anti_phishing_key' => '',
    'exter_invoke_ip'   => '',
    //'it_b_pay'          => $this->setting['paymentTimeout'] / 60 . 'm',
    //'_input_charset'    => $this->config->item('input_charset', 'alipay')
));

// 输出 HTML 到浏览器，JS 会自动发起提交
echo $body;

?>
