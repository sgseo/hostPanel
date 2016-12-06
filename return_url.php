<?php
require_once("../order/alipay/config.php");
require_once("../order/alipay/Alipay.php");

$alipay = new Alipay($config=$config_host,$type='');

$result = $alipay->verifyCallback();

if($result){
    $out_trade_no = $_POST['out_trade_no'];
    $trade_no = $_POST['trade_no'];
    $trade_status = $_POST['trade_status'];

    if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
        //该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
        echo "success";         //请不要修改或删除
        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
    else if($_POST['trade_status'] == 'TRADE_SUCCESS') {
        //该判断表示买家已经确认收货，这笔交易完成
        echo "success";         //请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

        /******************更新订单状态**************************/
        $select="select id,renew_quantity,tm_expire from host_order where order_id='$out_trade_no' limit 1" ;
        $res_select=mysql_query($select) ;
        $row_select=mysql_fetch_array($res_select,MYSQL_ASSOC) ;
        $id=$row_select['id'] ;
        $quantity=$row_select['renew_quantity'] ;
        $tm_expire=$row_select['tm_expire'] ;
        $tm_expire_next=date("Y-m-d H:i:s",strtotime("+$quantity month",strtotime($tm_expire))) ;
        
        $update_order="update host_order set tm_expire='$tm_expire_next',trade_no='$trade_no',pay_method=1 where id=$id and pay_method!=1" ;
        $res=mysql_query($update_order) ;
    }
    else if($_POST['trade_status'] == 'TRADE_FINISHED') {
        //该判断表示买家已经确认收货，这笔交易完成
        echo "success";         //请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

    }
    else {
        //其他状态判断
        echo "success";

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }


    $url = 'http://'.$_SERVER['HTTP_HOST'].'/host/';
    echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>";
}
else{
    echo "fail";
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>
