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
        include 'login.php' ;
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
	if ($_GET['mod']=='manage'){
        include 'manage.php' ;
    }
}

//action
if (isset($_POST['action'])) {
    if ($_POST['action']=='login'){
        $username=strip_tags($_POST['username']) ;
        $password=strip_tags($_POST['password']) ;
        $password=md5($password) ;
		if (array_key_exists($username,$admin) && $password == $admin[$username] ){
			$_SESSION['username']=$username ;
			$_SESSION['password']=$password ;
			$_SESSION['time']=time() ;
			header("Location: ./?mod=manage");
		}
		else{
			echo "<script>alert('Login username or password error,retry!');window.location.href='./?mod=login';</script>";
		}
    }
	if ($_POST['action']=='logout'){
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-store, must-revalidate");
        header("Pragma: no-cache");
        session_unset();
        session_destroy();
        $_SESSION = array();
        header("Location: ./");
	}
}

?>