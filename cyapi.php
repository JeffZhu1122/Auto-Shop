<?php


header("Content-Type: text/html; charset=utf-8");
include 'ayangw/common.php';

if($conf['cyapi'] == 2){
    exit("<script language='javascript'>alert('该站点未开启畅言评论');window.location.href='./index.php';</script>");
}

?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>畅言一下- <?php echo $conf['title'];?></title>
  <meta name="keywords" content="<?php echo $conf['keywords'];?>">
  <meta name="description" content="<?php echo $conf['description'];?>">
  <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  
  <script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="layer/layer.js"></script>

  <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
  <script src="js/ayangw.js"></script>
<script>

</script>
<style>
.mytab{
	margin-top:20px;
	
	text-align: center;
}

img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
body{
	background-image: url("assets/imgs/bj3.jpg");
	background-size:100%;
}
</style>
</head>
<body>
<div style="height: 20px;">

</div>
<div class="container">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-9 center-block" style="float: none;">

    <div class="panel panel-default" style="border: 2px solid #63B8FF;">
        <div class="panel-body" style="text-align: center;" >
    <img alt="" height="82px" src="assets/imgs/logo.png">
    </div>
    </div>
    <div class="panel panel-primary">
<div class="panel-body" style="text-align: center;">
	<div class="list-group">
		<div class="list-group-item list-group-item-info">
			注意事项：<br>
			<br>
			<?php echo $conf['cygg']?><br>
		</div>
		<ul class="nav nav-tabs" style="margin-top: 20px;">
			<li class="active"><a href="#onlinebuy" data-toggle="tab">畅言评论/留言</a></li>
			<li><a href="index.php">在线购买</a></li>
		</ul>
		
		<hr/>
		
		<?php 
		if(empty($conf['cyid']) || $conf['cyid'] == "" || empty($conf['cykey']) || $conf['cykey'] == ""){
		    ?>
		    <div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">该站还未配置畅言API！</h3>
    </div>
    
</div>
		    <?php 
		}else{
		?>
		<!--PC和WAP自适应版-->
<div id="SOHUCS" ></div> 
<script type="text/javascript"> 
(function(){ 
var appid = '<?php echo $conf['cyid']?>'; 
var conf = '<?php echo $conf['cykey']?>'; 
var width = window.innerWidth || document.documentElement.clientWidth; 
if (width < 960) { 
window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); } else { var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("http://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); } })(); </script>
		<?php }?>
		
		
		<div class="container-fluid" style="margin-top: 30px;">
			
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-user"></span> 联系客服</a>
		</div>
		<br>
		<span>Copyright © 2018 <?php echo $conf['foot']?></span>
	
		
		</div></div>
</div>
</div></div>

</body>
</html>
