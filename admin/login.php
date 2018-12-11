<?php
/**
 * 登录
**/
$verifycode = 0;//验证码开关

if(!function_exists("imagecreate") || !file_exists('code.php'))$verifycode=0;
include("../ayangw/common.php");
if(isset($_POST['user']) && isset($_POST['pass'])){
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$code=daddslashes($_POST['code']);
        $pass = md5($pass.$password_hash);
	if ($verifycode==1 && (!$code || strtolower($code) != $_SESSION['vc_code'])) {
		unset($_SESSION['vc_code']);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('验证码错误！');history.go(-1);</script>");
	}elseif($user == $conf['admin'] &&  $pass== $conf['pwd']) {
		unset($_SESSION['vc_code']);
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 604800);
	        wsyslog("登陆后台成功!","登陆IP:".real_ip().",城市:".get_ip_city(real_ip()));
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登陆管理中心成功！');window.location.href='./';</script>");
	}else {
		unset($_SESSION['vc_code']);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("admin_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin==5){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
$title='用户登录';

?>
<?php
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $title ?></title>
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.ayangw.com/nifty/nifty.min.css" rel="stylesheet">
  <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>


  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">管理员登陆</h3></div>
        <div class="panel-body">
          <form action="./login.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="user" value="<?php echo @$_POST['user'];?>" class="form-control" placeholder="用户名" required="required"/>
            </div><br/>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="pass" class="form-control" placeholder="密码" required="required"/>
            </div><br/>
 <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="submit" value="登陆" class="btn btn-info form-control" "  />
            </div><br/>
            
          </form>
        </div>
      </div>
    </div>
  </div>