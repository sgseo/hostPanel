<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, must-revalidate");
header("Pragma: no-cache");
require_once("../donate/globle.php") ;
function dbconn($host,$user,$pwd,$db){
                $conn=mysql_connect($host,$user,$pwd) or die ("数据库连接错误！") ;
                mysql_select_db($db) or die("无此数据库！");
                mysql_query("set names utf8;");
        }
if(!dbconn(Host,Username,Password,Select_db)){
        //echo "数据库连接成功！<br />" ;
}
else{ exit ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>云主机代购查询续费 - 章郎主机</title>
</head>
<body>
<br/><br/>
	<div class="framecenter margintop10">
		<div class="pagecontent margintleft10" style="width:500px;margin-left:auto;margin-right:auto;margin-top:20px;">
			<div class="pagecontentstr">
				<div class="righttext center lineheight200">
					<h3>您的查询结果如下</h3>
				</div>
<!--alipay -->
<style>
*{
	margin:0;
	padding:0;
}
ul,ol{
	list-style:none;
}
.title{
    color: #ADADAD;
    font-size: 14px;
    font-weight: bold;
    padding: 8px 16px 5px 10px;
}
.hidden{
	display:none;
}

.new-btn-login-sp{
	border:1px solid #D74C00;
	padding:1px;
	display:inline-block;
}

.new-btn-login{
    background-color: transparent;
    background-image: url("../donate/images/new-btn-fixed.png");
    border: medium none;
}
.new-btn-login{
    background-position: 0 -198px;
    width: 82px;
	color: #FFFFFF;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding: 0 10px 3px;
}
.new-btn-login:hover{
	background-position: 0 -167px;
	width: 82px;
	color: #FFFFFF;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding: 0 10px 3px;
}
.bank-list{
	overflow:hidden;
	margin-top:5px;
}
.bank-list li{
	float:left;
	width:153px;
	margin-bottom:5px;
}

#main{
	width:750px;
	margin:0 auto;
	font-size:14px;
	font-family:'宋体';
}
#logo{
	background-color: transparent;
    background-image: url("images/new-btn-fixed.png");
    border: medium none;
	background-position:0 0;
	width:166px;
	height:35px;
    float:left;
}
.red-star{
	color:#f00;
	width:10px;
	display:inline-block;
}
.null-star{
	color:#fff;
}
.content{
	margin-top:5px;
}

.content dt{
	width:160px;
	display:inline-block;
	text-align:right;
	float:left;
	
}
.content dd{
	margin-left:100px;
	margin-bottom:5px;
}
#foot{
	margin-top:10px;
}
.foot-ul li {
	text-align:center;
}
.note-help {
    color: #999999;
    font-size: 12px;
    line-height: 130%;
    padding-left: 3px;
}

.cashier-nav {
    font-size: 14px;
    margin: 15px 0 10px;
    text-align: left;
    height:30px;
    border-bottom:solid 2px #CFD2D7;
}
.cashier-nav ol li {
    float: left;
}
.cashier-nav li.current {
    color: #AB4400;
    font-weight: bold;
}
.cashier-nav li.last {
    clear:right;
}
.alipay_link {
    text-align:right;
}
.alipay_link a:link{
    text-decoration:none;
    color:#8D8D8D;
}
.alipay_link a:visited{
    text-decoration:none;
    color:#8D8D8D;
}
</style>
<?php
$idc=$_POST['idc'];
$ip=$_POST['ip'];
if($idc && $ip){
	$select="select idc,hostname,ip,tm_create,tm_expire,price from host_order where ip='$ip' and idc='$idc'" ;
	if($res=mysql_query($select)){
	$cnt=mysql_num_rows($res) ;
		if($cnt==0){
			echo "您查询的账号不存在，请查实！<a href=/host/>返回>></a>" ;
		}
		else{
			while($row=mysql_fetch_array($res,MYSQL_ASSOC)){
?>
        <form name=alipayment action="alipay.php" method=post target="_blank">
            <div id="body" style="clear:left">
                <dl class="content">
                    <dt>IDC服务商：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="idc" value="<?php echo $row['idc']; ?>" readonly />
                    </dd>
                    <dt>主机名：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="hostname" value="<?php echo $row['hostname']; ?>" readonly />
                    </dd>
                    <dt>订购套餐：</dt>
                    <dd>
                        <span class="null-star">*</span>
						<select name="WIDprice">
							<option value="<?php echo $row['price']; ?>"><?php echo $row['price'];?> 元/月</option>
						</select>
                        <span>*</span>
                    </dd>
                    <dt>IP地址：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="ip" value="<?php echo $row['ip']; ?>" readonly />
                    </dd>
		    <dt>开始时间：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="tm_create" value="<?php echo $row['tm_create']; ?>" readonly />
                    </dd>
		    <dt>到期时间：</dt>
                    <dd>
                        <span class="null-star">*</span>
                        <input size="30" name="tm_expire" value="<?php echo $row['tm_expire']; ?>" readonly />
                    </dd>
		    <dt>续费年限：</dt>
                    <dd>
                        <span class="null-star">*</span>
						<select name="quantity">
							<option value="1">1 月</option>
							<option value="3">1 季度</option>
							<option value="12">1 年</option>
							<option value="24">2 年</option>
							<option value="36">3 年</option>
						</select>
                        <span>*</span>
                    </dd>
		    <dt></dt>
                    <dd>
		        <span class="new-btn-login-sp">
                            <button class="new-btn-login" type="submit" style="text-align:center;">确认续费</button>
                        </span>
                    </dd>
                </dl>
            </div>
		</form>
		<div><br/>################################################################</div>
<?php
			}
		}
	}
}
else{
	echo "您查询的账号不存在或者输入错误，请查实后重新输入！<a href=/host/>返回>></a>" ;
}
?>
<!--alipay end-->
<br/><br />
<p>&nbsp;</p>
<p>注意：续费1年9.5折，续费2年9折，续费3年8折。</p>
			</div>
		</div>
	</div>
</body>
</html>
