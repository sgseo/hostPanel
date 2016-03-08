<?php
include '../config.php' ;

if (!isset($_GET['mod']) && !isset($_POST['action']) ) {
	include 'login.php' ;
}

//mod
if (isset($_GET['mod'])) {
    if ($_GET['mod']=='register'){
		echo "register is close!" ;
    }
    if ($_GET['mod']=='login'){
    	if (isset($_SESSION['ip'])){
    		header("Location: ./?mod=server");
    	}
    	else {
    		include 'login.php' ;
    	}
    }
    if ($_GET['mod']=='logout'){
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-store, must-revalidate");
        header("Pragma: no-cache");
        session_unset();
        session_destroy();
        $_SESSION = array();
        header("Location: ./");
    }
	if ($_GET['mod']=='server'){
        include 'server.php' ;
    }
}

//action
if (isset($_POST['action'])) {
	
	//login
    if ($_POST['action']=='login'){
        $post_wangwang=strip_tags($_POST['wangwang']) ;
        $post_email=strip_tags($_POST['email']) ;
        
        $conn=mysqli_connect($dbhost,$dbusername,$dbpassword) or die ("数据库连接错误！") ;
        mysqli_select_db($conn,$dbname) or die("无此数据库！");
        mysqli_query($conn,"set names utf8;");
        
        $sql="select id,ip,email,wangwang from host_order where wangwang='$post_wangwang' limit 1" ;
        $stmt=mysqli_prepare($conn,$sql) ;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id,$ip,$email,$wangwang);
        while (mysqli_stmt_fetch($stmt)) {
        	$db_wangwang = $wangwang ;
        	$db_email = $email ;
        }
        mysqli_stmt_close($stmt);
                
		if ($post_wangwang && $post_email && $post_wangwang == $db_wangwang && $post_email == $db_email ){
			$_SESSION['wangwang']=$db_wangwang ;
			$_SESSION['email']=$db_email ;
			$_SESSION['time']=time() ;
			header("Location: ./?mod=server");
		}
		else{
			echo "<script>alert('Login wangwang or email error,retry!');window.location.href='./?mod=login';</script>";
		}
    }
    
    
}

?>