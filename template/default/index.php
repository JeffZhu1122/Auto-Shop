<?php
/*
 * 源码来源：全名易支付
 * */

if(empty($conf['create'])){
    $DB->query("insert into ayangw_config values('create',now())");
}
$yxts=ceil((time()-strtotime($conf['create']))/86400); //本站已运行多少天

$allOrder = $DB->count("SELECT  id  from ayangw_order order by id DESC limit 1");
//历史订单数
$nowOrder = $DB->count("SELECT COUNT(id)  from ayangw_order order by id DESC limit 1");
//当前订单数
$okOrder = $DB->count("SELECT COUNT(id)   from ayangw_order where sta = 1 order by id DESC limit 1");
//完成订单数



$rs=$DB->query("select * from ayangw_type");
$select = "";
while ($row = $DB->fetch($rs)){
    $select.='<option value="'.$row['id'].'">'.$row['tName'].'</option>';
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
  <title><?php echo $conf['title'];?></title>
  <meta name="keywords" content="<?php echo $conf['keywords'];?>">
  <meta name="description" content="<?php echo $conf['description'];?>">
  <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/4.png" media="screen" />
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
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
<div class="container" >
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-9 center-block" style="float: none;">
<div class="panel panel-default" style="border: 2px solid #63B8FF;">
    <div class="panel-body" style="text-align: center;" >
<img alt="" height="82px" src="assets/imgs/logo.png">

</div>
</div>

<div class="panel panel-primary">
<div class="panel-body" style="text-align: center;">
<div class="panel panel-info">
						<div class="list-group-item reed" style="background: #66bdff;">
							<h3 class="panel-title">
								<font color="#fff"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;<b>购买须知<用户必看></b></font>
							</h3>
						</div>
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td align="center"><font color="#808080">本站域名：<?php echo $_SERVER['HTTP_HOST']?></font></td>
									<td align="center"><font color="#808080">客服QQ:<?php echo $conf['zzqq']?></font></td>
								</tr>
								
							</tbody>
						</table>
						<div class="list-group-item reed">
							
							<font style="color:#009ACD;font-weight: bold;"><?php echo $conf['notice1']?></font>
						</div>
						<div class="list-group-item reed">
							<font style="color:#556B2F;font-weight: bold;"><?php echo $conf['notice2']?></font>
						</div>
						<div class="list-group-item reed">
							<font style="color:#008B00;font-weight: bold;"><?php echo $conf['notice3']?></font>
						</div>
						

		</div>
	<div class="list-group">
			
		<ul class="nav nav-tabs">
			<li class="active"><a href="#onlinebuy" data-toggle="tab">在线购买下单</a></li>
			<li><a href="index.php?tp=default&action=getkm" >订单查询提卡</a></li>
			<li><a href="index.php?tp=default&action=getallkm" >查询历史订单</a></li>
		</ul>
		<div class="list-group-item">
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="onlinebuy">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">商品分类</div>
					<select name="tp_id" id="tp_tid" class="form-control" onchange="getPoint(this);"><?php echo $select?></select>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">选择商品</div>
					<select name="gid" id="gid" class="form-control" onchange="getPrice(this)">
					
					</select>
				</div></div>
				<?php if($conf['showImgs'] == 1){?>
				<div class="form-group">
					
					<img id="goodimgs" src="./assets/goodsimg/df.jpg"  class="img-responsive img-rounded img-thumbnail" style="max-height: 200px;">
				   
				</div>
				<?php }?>
				<div class="form-group">
					<div class="panel panel-default">
                    <div class="panel-body" id="ginfo">
                    </div>
                   
                </div>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">商品价格</div>
					<input type="text" name="need" id="need" class="form-control" disabled/>
				</div></div>
				
				<div class="form-group" style="<?php if($conf['showKc'] == 2) echo "display:none;"?> ">
					<div class="input-group"><div class="input-group-addon">商品库存</div>
					<input type="text" name="kc" id="kc" class="form-control" disabled/>
				</div></div>
			
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">联系方式</div>
					<input type="text" name="lx" id="lx" value="" class="form-control" placeholder="输入您的QQ,您的QQ号码也可以作为您的提取密码" required/>
				</div></div>
				
				
				
				<div class="input-group">
                        <div class="input-group"><div class="input-group-addon">选择数量</div>
					<div class="input-group-addon btn btn-primary" id="jia" onclick='numstepUp()'>+</div>
                       <input type="number" onBlur="checknum()"  name="number" id="number" class="form-control " placeholder="" min="1" step="1" value="1" required>
                      <div class="input-group-addon btn btn-primary" id="jian"  onclick='numstepDown()'>-</div>
                      
				</div><br>
                       
                </div>
				<div class="form-group">
			     <span class="btn btn-default btnSpan" title="alipay"><input type="radio" name="type" value="alipay" class="pay" id="alipay" value="alipay" title="支付宝" ><img alt="" src="assets/alipay.ico" class="logo">支付宝</span>
			     <?php 
			         if($conf['paiapi'] != 5){
			     ?>
			     <span class="btn btn-default btnSpan" title="qqpay"><input type="radio" name="type" value="qqpay"  class="pay" id="qqpay" value="qqpay" title="QQ钱包" ><img alt="" src="assets/qqpay.ico" class="logo">QQ</span>
			     <span class="btn btn-default btnSpan" title="tenpay" style="display: none"><input type="radio" name="type" value="tenpay" class="pay" id="tenpay" value="tenpay" title="财付通" ><img alt="" src="assets/tenpay.ico" class="logo">财付通</span>
			     <span class="btn btn-default btnSpan"  title="wxpay"><input type="radio" name="type" value="wxpay" class="pay" id="wxpay" value="wxpay" title="微信" ><img alt="" src="assets/wechat.ico" class="logo">微信</span>
			     <?php }?>
			    </div>
			
				</div>
				<input type="submit" id="submit_buy" class="btn btn-primary btn-block" value="立即购买">
			</div>
			
			
			
		</div>
		<div class="panel panel-info">
		<div class="list-group-item reed" style="background:#3B3B3B;">
							<h3 class="panel-title">
								<font color="#fff"><i class="fa fa-podcast"></i>&nbsp;&nbsp;<b>本站更多功能</b></font>
							</h3>
						</div>
		<div class="list-group-item reed">
			<font style="color:#008B00;font-weight: bold;">
			<a href="./auto.php"><span class="btn btn-danger btn-xs"><b>自助补单</b></span></a>&nbsp;|&nbsp;
			<a href="./cyapi.php"><span class="btn btn-success btn-xs"><b>评论/留言/建议</b></span></a>&nbsp;|&nbsp;
			<a href="index.php?tp=default&action=getallkm"><span class="btn btn-info btn-xs"><b>查询历史订单信息</b></span></a>
			</font>
		</div>
		</div>
<?php if($conf['syslog'] == 1){ ?>
<div class="panel panel-info">
<div class="list-group-item reed" style="background:#64b2ca;"><h3 class="panel-title"><font color="#fff"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;<b>运行日志</b></font></h3></div>
<table class="table table-bordered">
<tbody>
<tr>
	<td align="center"><font color="#808080"><b>平台已经运营</b><br><i class="fa fa-ravelry fa-2x"></i><br><?php echo $yxts;?>天</font></td>
	<td align="center"><font color="#808080"><b>平台订单总数</b><br><span class="fa fa-free-code-camp fa-2x"></span><br><?php echo $nowOrder;?>条</font></td>
</tr>
<tr height=50>
         <td align="center"><font color="#808080"><b>成功交易订单</b><br><i class="fa  fa-handshake-o fa-2x"></i><br><?php echo $okOrder;?>条</font></td>
	<td align="center"><font color="#808080">
	<b>历史总订单</b><br>
	<i class="fa fa-telegram fa-2x"></i>
	<br>
	<span id="counter"><?php $allOrder==null? $ar = 0:$ar = $allOrder; echo $ar;?></span>条</font></td>
<tbody>
</table>
</div>
<?php }?>
		
		<hr/>
		<div class="container-fluid">
			
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-user"></span> 联系客服</a>
		</div>
		<br>
		<span>Copyright © 2018 <?php echo $conf['foot']?></span>
		
		
		
		</div>
	</div>
</div>
</div>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="js/ayangw.js"></script>
<script type="text/javascript">
$(function(){
	//获取商品
	getPoint($("#tp_tid"));
})
</script>
</body>
</html>