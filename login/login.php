<?php
session_start();
require_once ('connect.php');
$action = $_GET['action'];
if ($action == 'login') {  //登录
	$user = stripslashes(trim($_POST['user']));
	$pass = stripslashes(trim($_POST['pass']));
	if (empty ($user)) {
		echo '用户名不能为空';
		exit;
	}
	if (empty ($pass)) {
		echo '密码不能为空';
		exit;
	}
	$md5pass = md5($pass);
	$query = $pdo->query("SELECT * FROM user WHERE username='".$user."'");
	foreach ($query as $row) {
		$ps = $query ? $md5pass == md5($row['password']) : FALSE;
    }

	if ($ps) {
		$counts = $row['login_counts'] + 1;
		$_SESSION['user'] = $row['username'];
		$_SESSION['login_time'] = $row['login_time'];
		$_SESSION['login_counts'] = $counts;
		$ip = get_client_ip();
		$logintime = time();
		$rs = $pdo->exec("update user set login_time='$logintime',login_ip='$ip',login_counts='$counts'");
		if ($rs) {
			//echo '1';exit;
			$arr['success'] = 1;
			$arr['msg'] = '登录成功！';
			$arr['user'] = $_SESSION['user'];
			$arr['login_time'] = date('Y-m-d H:i:s',$_SESSION['login_time']);
			$arr['login_counts'] = $_SESSION['login_counts'];
		} else {
			$arr['success'] = 0;
			$arr['msg'] = '登录失败';
		}
	} else {
		$arr['success'] = 0;
	    $arr['msg'] = '用户名或密码错误！';
	}
	echo json_encode($arr);
}
elseif ($action == 'logout') {  //退出
	unset($_SESSION);
	session_destroy();
	echo '1';
}

//获取用户真实IP
function get_client_ip() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				$ip = getenv("REMOTE_ADDR");
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
					$ip = $_SERVER['REMOTE_ADDR'];
				else
					$ip = "unknown";
	return ($ip);
}
?>
