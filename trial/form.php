<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>VPS云主机试用、云服务器测试、日付VPS - 章郎主机</title>
<meta name="keywords" content="章郎主机,vps试用,vps测试,日付vps" />
<meta name="description" content="vps云主机试用，云服务器测试，日付vps，按天计算的测试VPS云服务器购买。" />
<link rel="stylesheet" href="../static/css/style.css" rel="stylesheet">
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
	<?php include '../template/common/navbar.php' ; ?>
	<div class="row">
				<div class="col-sm-12">
					<?php if (!isset($_GET['mod']) ) {?>
					
                    <!--price start-->
                    <div class="text-center price-head">
                        <h1 class="color-terques"> VPS服务器，云主机测试、日付VPS主机 </h1>
                        <p>付款后正常情况Linux最快一般5分钟左右安装好，Windows大约需要30分钟。</p>
                    </div>
                    
                    <div class="col-lg-4 col-sm-4">
                        <div class="pricing-table">
                            <div class="pricing-head">
                                <h1> Trial 768 </h1>
                            </div>
                            <div class="pricing-quote">
                                5<span class="note"> 元</span>
                                <p>一天<br/>Windows加收3元</p>
                            </div>
                            <ul class="list-unstyled">
                                <li>内存 768 MB</li>
                                <li>CPU 1 核</li>
                                <li>带宽 100Mbps</li>
                                <li>硬盘 15 GB SSD</li>
                            </ul>
                            <div class="price-actions">
                                <a href="./?mod=order&name=Trial%20768&plan=29&price=5" class="btn">点击订购</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="pricing-table most-popular">
                            <div class="pricing-head">
                                <h1> Trial 1024 </h1>
                            </div>
                            <div class="pricing-quote">
                                8<span class="note">元</span>
                                <p>一天<br/>Windows加收3元</p>
                            </div>
                            <ul class="list-unstyled">
                                <li>内存 1024 MB</li>
                                <li>CPU 1 核</li>
                                <li>带宽 100Mbps</li>
                                <li>硬盘 20 GB SSD</li>
                            </ul>
                            <div class="price-actions">
                                <a href="./?mod=order&name=Trial%201024&plan=93&price=8" class="btn">点击订购</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="pricing-table">
                            <div class="pricing-head">
                                <h1> 其他配置 </h1>
                            </div>
                            <div class="pricing-quote">
                                ??<span class="note">元</span>
                                <p>一天<br/>Windows加收3元</p>
                            </div>
                            <ul class="list-unstyled">
                                <li>内存 ?? MB</li>
                                <li>CPU ?? 核</li>
                                <li>带宽 ?? Mbps</li>
                                <li>硬盘 ?? GB SSD</li>
                            </ul>
                            <div class="price-actions">
                                <a href="https://shop199016211.taobao.com/" target="_blank" class="btn">联系客服</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row text-center" style="margin-top:20px;">
                        <div class="col-lg-12 col-sm-12"></div>
                    </div>
                    <!--price end-->
                    
                    <?php } else { if ($_GET['mod']=='order'){ ?>
                    
                    <!--preorder start-->
                    <div class="text-center price-head">
                        <h1 class="color-terques">您即将订购的试用主机为 <?php echo $_GET['name'] ;?> </h1>
                        <p><br/>请选择操作系统和机房</p>
                    </div>
                    <div class="col-lg-4 col-sm-4"></div>
                    <div class="col-lg-4 col-sm-4">
                    	<form action="./?action=order" method="post">
                    		<input type="hidden" name="planid" value=<?php echo $_GET['plan'] ;?> />
                    		<input type="hidden" name="action" value="order" />
                    		<input type="hidden" name="price" id="inputPrice" value=<?php echo $_GET['price'] ;?> />
                    		<input type="hidden" name="singleprice" value=<?php echo $_GET['price'] ;?> />
	                    	<div class="col-lg-12 col-sm-12" style="padding-left:20%;padding-right:20%;">
	                    		<select class="form-control m-bot15" id="selectOS" name="os" onchange="getOSDistribution()">
			                        <option value='linux' select>Linux</option>
			                       	<option value='windows'>Windows</option>
			                   	</select>
	                        </div>
	                        <div class="col-lg-12 col-sm-12" style="padding-left:20%;padding-right:20%;">
	                           	<select class="form-control m-bot15" id="selectDistribution" name="distribution" >
	                           		<option value=0 select>--</option>
			                    </select>
		                    </div>
		                    <div class="col-lg-12 col-sm-12" style="padding-left:20%;padding-right:20%;">
	                        	<select class="form-control m-bot15" name="dcid">
	                            		<option value=25 select>东京</option>
	                            		<option value=40>新加坡</option>
	                            		<option value=5>洛杉矶</option>
	                            		<option value=4>西雅图</option>
	                            		<option value=19>澳大利亚</option>
	                            </select>
	                        </div>
	                        <div class="col-lg-12 col-sm-12" style="padding-left:20%;padding-right:20%;">
	                        	<input type="number" name="number" class="spinner-input form-control" id="inputNumber"
	                        	value=1 maxlength="3" onchange="getOrderPrice()" >
	                        </div>
	                        <div class="col-lg-12 col-sm-12" style="padding-left:20%;padding-right:20%;">
	                        	价格：<span id="price" name="price">5</span> 元/天
	                        </div>
	                        <div class="col-lg-12 col-sm-12" style="padding-left:20%;padding-right:20%;">
	                        	<button class="btn btn-sm btn-primary" type="submit">点击付款</button>
	                        </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-sm-4"></div>
                    
                    <!--preorder end-->
                    
                    <?php } } ?>
                </div>
	</div>
</div>

<?php include '../template/common/footer.php' ; ?>

<script type="text/javascript">

function getOSDistribution(){
    var os = document.getElementById("selectOS").value;
    if (os == 'linux'){
        var html = "<option value=127 select>CentOS 6 x64</option>" ;
        var html = html + "<option value=167>CentOS 7 x64</option>" ;
        var html = html + "<option value=193>Debian 8 x64</option>" ;
        var html = html + "<option value=215>Ubuntu 16.04 x64</option>" ;
        $("#selectDistribution option").remove();
        $("#selectDistribution").append(html);

        //price
        var price = <?php if(isset($_GET['price'])) { echo $_GET['price'] ;} else{ echo 5 ;}?> ;
        var number = parseInt(document.getElementById("inputNumber").value);
        var price = price*number ;
        document.getElementById("price").innerHTML=price;
        document.getElementById("inputPrice").value=price;
    }
    else if (os == 'windows'){
        var html = "<option value=\"851572a0a81ef\" select>Windows XP i386</option>" ;
        var html = html + "<option value=\"4cf56d67644ed\">Windows 2003 x64</option>" ;
        var html = html + "<option value=\"cf57b994b45ee\">Windows 2008 x64</option>" ;
        $("#selectDistribution option").remove();
        $("#selectDistribution").append(html);

        //price
        var number = parseInt(document.getElementById("inputNumber").value);
        //var price = parseInt(document.getElementById("price").innerHTML);
        var price = <?php if(isset($_GET['price'])) { echo $_GET['price'] ;} else{ echo 5 ;}?> ;
        var price = (price + 3)*number ;
        document.getElementById("price").innerHTML=price;
        document.getElementById("inputPrice").value=price;
    }
    else{
		alert('System Error!') ;
    }
};

function getOrderPrice(){
    var os = document.getElementById("selectOS").value;
    if (os == 'linux'){
        //price
        var price = <?php if(isset($_GET['price'])) { echo $_GET['price'] ;} else{ echo 5 ;}?> ;
        var number = parseInt(document.getElementById("inputNumber").value);
        var price = price*number ;
        document.getElementById("price").innerHTML=price;
        document.getElementById("inputPrice").value=price;
    }
    else if (os == 'windows'){
        //price
        var number = parseInt(document.getElementById("inputNumber").value);
        var price = <?php if(isset($_GET['price'])) { echo $_GET['price'] ;} else{ echo 5 ;}?> ;
        var price = (price + 3)*number ;
        document.getElementById("price").innerHTML=price;
        document.getElementById("inputPrice").value=price;
    }
    else{
		alert('System Error!') ;
    }
}

getOSDistribution();
</script>

</body>
</html>