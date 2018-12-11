<?php
/*
 * 源码来源：全名易支付
 * */

header("Content-Type: text/html; charset=utf-8");

if(!empty($_GET['out_trade_no'])){
    $t = _ayangw($_GET['out_trade_no']);
	$sql = "select * from ayangw_km
    where out_trade_no ='{$t}'
    limit 1";
    
    $res = $DB->query($sql);
    if($row = $DB->fetch($res)){
        $sql2 = "select * from ayangw_goods where id =".$row['gid'];
        $res2 = $DB->query($sql2);
        $row2 =$DB->fetch($res2);
    }else{
        exit("<script>alert('无此条记录！');window.location.href='getkm.php'</script>");
    }
}else{
    $t = "";
}
$km ="";

if(!empty($_POST['tqm'])){
    $tqm = _ayangw($_POST['tqm']);
    $sql = "select * from ayangw_km
    where out_trade_no ='{$tqm}' or trade_no = '{$tqm}' or rel = '{$tqm}'
    ORDER BY endTime desc
    limit 1";
    
    $res = $DB->query($sql);
    if($row = $DB->fetch($res)){
        $sql2 = "select * from ayangw_goods where id =".$row['gid'];
        $res2 = $DB->query($sql2);
        $row2 =$DB->fetch($res2);
    }else{
        exit("<script>alert('无此条记录！');window.location.href='getkm.php'</script>");
        
    }
}

$mod=isset($_GET['act'])?$_GET['act']:null;
if($mod == "email"){
   
}

function isEmail($email){
    $mode = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
    if(preg_match($mode,$email)){
        return true;
    }
    else{
        return false;
    }
}


?>
<!-- 
**********************************************
/*
 * 源码来源：全名易支付
 * */  
**********************************************
-->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>卡密提取 - <?php echo $conf['title'];?></title>
  <meta name="keywords" content="<?php echo $conf['keywords'];?>">
  <meta name="description" content="<?php echo $conf['description'];?>">
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
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
		<div class="list-group-item list-group-item-success">
			注意事项：<br>
			<br>
			<?php echo $conf['dd_notice']?><br>
		</div>
		<ul class="nav nav-tabs" style="margin-top: 20px;">
			<li class="active"><a href="#onlinebuy" data-toggle="tab">订单查询提卡</a></li>
			<li><a href="index.php?tp=default&action=getallkm">查询历史订单</a></li>
			<li><a href="index.php?tp=default&action=index">在线购买下单</a></li>
		</ul>
		<?php if(empty($_GET['act']) && empty($_GET['out_trade_no'])) {?>
		<div class="list-group-item">
			<div id="myTabContent" class="tab-content">
			<form action="index.php?tp=default&action=getkm&act=query" method="POST">
			<div class="form-group">
					
					<input type="text" name="tqm" id="tqm" value="<?php if($t != ""){ echo $t;}?>" class="form-control text-center" placeholder="输入联系方式/订单编号/商户单号/都可以提取到您的卡密" required/>
				</div>
			
				<input type="submit" id="sub_query" class="btn btn-primary btn-block" value="提取卡密">
			     
			</div>
			</form>
	</div>
	<?php }elseif ($_GET['act'] == "query" || !empty($_GET['out_trade_no'])) { 
	    ?>
	<div class="list-group-item">
			<div id="myTabContent" class="tab-content">
			<form action="index.php?tp=default&action=getkm&act=email&a=<?php echo $row['out_trade_no'];?>&b=<?php echo $row2['gName'];?>&c=<?php echo $row['km'];?>&sj=<?php echo $row['endTime']?>" method="POST">
			<div class="form-group">
					<div class="input-group"><div class="input-group-addon">订单遍号</div>
					<input type="text" name="bh"  value="<?php echo $row['out_trade_no'];?>" class="form-control" placeholder="" disabled/>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">商品名称</div>
					<input type="text" name="mc" value="<?php echo $row2['gName'];?>" class="form-control" placeholder="" disabled/>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">成交时间</div>
					<input type="text" name="sj" value="<?php echo $row['endTime']?>" class="form-control" placeholder="" disabled/>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">您的卡密</div>
					<input type="text" name="km" id="km"  value="<?php echo $row['km'];?>" class="form-control" placeholder="" disabled/>
					<div class="input-group-addon btn btn-primary" id="copykm">点击复制</div>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">发送到邮箱</div>
					<input type="text" name="yx"  value="" class="form-control" placeholder="请填写您的邮箱地址 比如：888888@qq.com" required/>
				</div></div>
			<div class="form-group">
				<input type="submit" id="sub_email" class="btn btn-primary btn-block" value="发送到邮箱">
			   </div>
			    
			</div>
			</form>
	</div>
	
	
	
	<?php }else if($_GET['act'] == "email"){
	    header("Content-Type: text/html; charset=utf-8");
	    if(isset($_SERVER['HTTP_REFERER'])){
	        if(strpos($_SERVER['HTTP_REFERER'], "http://".$_SERVER['HTTP_HOST']."/")==0){
	        }else{
	            exit();
	        }
	    }else{
	        exit();
	    }
	   $bh = _ayangw($_GET['a']);//订单编号
	    $mc = daddslashes($_GET['b']);//名称
	    $km = daddslashes($_GET['c']);//卡密
	     $goal = daddslashes($_POST['yx']);//目标邮箱
	    $time = daddslashes($_GET['sj']);//时间
	    if($goal == null || $goal == ""){
	        exit("<script>alert('收件邮箱不能为空！');window.history.go(-1);</script>");
	    }
	    if(isEmail($goal)==false){
	        exit("<script>alert('邮箱格式错误！');window.history.go(-1);</script>");
	    }
	    $content = "<br>　　您购买的商品：".$mc."<br>　　订单编号：".$bh."<br>　　购买时间为：".$time."<br>　　您的卡密为：".$km;  
	    $flag =  sendemail($goal, $content);
	 
	    if( $flag ){
	        exit("<script>alert('发送成功！');window.location.href='index.php?tp=default&action=getkm';</script>");
	    }else{
	        exit("<script>alert('发送失败！');window.location.href='index.php?tp=default&action=getkm';</script>");
	    }
	    
	} ?>
		<hr/>
		<div class="container-fluid">
			
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-user"></span> 联系客服</a>
		</div>
		<br>
		<span>Copyright © 2018 <?php echo $conf['foot']?></span>
	
		
		</div></div>
</div>
</div></div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="js/ayangw.js"></script>
</body>
</html>