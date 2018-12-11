<?php
/*
 * 源码来源：全名易支付
 * */

header("Content-Type: text/html; charset=utf-8");

$mod=isset($_GET['act'])?$_GET['act']:null;
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
		<div class="list-group-item list-group-item-warning">
			注意事项：<br>
			<br>
			<?php echo $conf['dd_notice']?><br>
		</div>
		<ul class="nav nav-tabs" style="margin-top: 20px;">
			<li class="active"><a href="#onlinebuy" data-toggle="tab">查询历史订单</a></li>
			<li><a href="index.php?tp=default&action=getkm">查询单个订单</a></li>
			<li><a href="index.php?tp=default&action=index">在线购买下单</a></li>
		</ul>

		<div class="list-group-item" >
			<div id="myTabContent" class="tab-content">
			<form action="index.php?tp=default&action=getallkm&act=query" method="POST">
			<div class="form-group">
					
					<input type="text" name="tqm" id="tqm" value="" class="form-control text-center" placeholder="输入联系方式/订单编号/商户单号/都可以提取到您的卡密" required/>
				</div>
			
				<input type="submit" id="sub_query" class="btn btn-primary btn-block" value="提取卡密">
			     
			</div>
			</form>
	</div>
	<?php if ($_GET['act'] == "query") { 
	if(isset($_SERVER['HTTP_REFERER'])){
    if(strpos($_SERVER['HTTP_REFERER'], "http://".$_SERVER['HTTP_HOST']."/")==0){
            }else{
                exit();
            }
        }else{
            exit();
        }
        
        $tqm = _ayangw($_POST['tqm']);
        $sql = "select * from ayangw_km
        where out_trade_no ='{$tqm}' or trade_no = '{$tqm}' or rel = '{$tqm}'
        ORDER BY endTime desc
        ";
        ?>
        <div class="table-responsive">
			<table class="table  table-hover text-center mytab" width="100%";style="text-align: center; ">
			 <tr>
			    <td>订单编号</td><td>商品名称</td><td>价格</td><td>联系方式</td><td>交易时间</td><td>卡密</td>
			 </tr>
        <?php
        $res = $DB->query($sql);
        while($row = $DB->fetch($res)){
            $sql2 = "select * from ayangw_goods where id =".$row['gid'];
            $res2 = $DB->query($sql2);
            $row2 =$DB->fetch($res2);
            echo "<tr>";
            echo "<td>{$row['trade_no']}</td><td>{$row2['gName']}</td>
            <td>{$row2['price']}</td><td>{$row['rel']}</td><td>{$row['endTime']}</td><td>{$row['km']}</td>";
            echo "</tr>";
        }
	    ?>
	</table>
	</div>
	
	
	
	
	<?php } ?>
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


