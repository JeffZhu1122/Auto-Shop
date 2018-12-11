<?php


header("Content-Type: text/html; charset=utf-8");
include 'ayangw/common.php';


?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>自助补单 - <?php echo $conf['title'];?></title>
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
			<h5>注意事项：</h5>
			<p>订单编号是创建订单的时候告知的编号，联系方式自己填写的！</p>
			
			<p>两个凭证缺一不可，否则无法补单！</p>
			
			<p>如忘记或遗失订单编号，请联系客服！</p>
		</div>
		<ul class="nav nav-tabs" style="margin-top: 20px;">
			<li class="active"><a href="#onlinebuy" data-toggle="tab">自助补单</a></li>
			<li><a href="index.php">在线购买</a></li>
		</ul>
		
		<hr/>
		
	

  <form action="./auto.php?act=bd" method="post" class="form-horizontal" role="form">
	
	<div class="form-group">
		<label class="col-lg-3 control-label">订单编号</label>
		<div class="col-lg-8">
			<input type="text" id="ddbh" name="ddbh" class="form-control"
				   value="" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">联系方式</label>
		<div class="col-lg-8" required>
			<input type="text" id="lxfs" name="lxfs" class="form-control" value="">
		</div>
	</div>

	<div class="form-group">
	  <div class="col-sm-offset-3 col-sm-8">
	  <input type="submit" id="submit" name="submit" value="自助补单" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
<?php 

    if(!empty($_GET['act']) && $_GET['act'] == "bd"){
        if(empty($_POST['lxfs']) || empty($_POST['ddbh'])){
            echo ' <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">订单编号与联系方式不能为空，否则无法查询！</h3>
                </div>
            
            </div>';
        }elseif($conf['epay_id'] && $conf['epay_key']){
            $out_trade_no = _ayangw($_POST['ddbh']);
            $data = get_curl($payapi.'api.php?act=order&pid='.$conf['epay_id'].'&key='.$conf['epay_key']."&out_trade_no=".$out_trade_no);
            $arr = json_decode($data, true);
           
            if($arr['code'] == -1){
                echo ' <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">订单不存在！！</h3>
                </div>
                
            </div>';
            }elseif( $arr['status'] == "0" || $arr['code'] != 1 || $arr['endtime'] == null){
                echo ' <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">该订单未交易成功！！</h3>
                </div>
                
            </div>';
            }elseif($arr['code'] == 1 && $arr['status'] == "1"){
                $lxfs = _ayangw($_POST['lxfs']);
                
                $trade_no = $arr['trade_no'];
                $endtime = $arr['endtime'];
                $res = $DB->query("select * from ayangw_order where out_trade_no = '{$out_trade_no}' and rel = '{$lxfs}' and sta = 0");
               
                if($row = $DB->fetch($res)){
                    //exit("update ayangw_order set trade_no='{$trade_no}',endTime='{$endtime}',sta = 1 where id = ".$row['id']);
                    $crow = $DB->query("select * from ayangw_km where gid = {$row['gid']} and stat = 0");
                    if(!$crow = $DB->fetch($crow) ){
                        echo ' <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">补单失败！<br>您购买的商品：'.$arr['name'].'<br>卡密库存不足!请联系管理员!</h3>
                </div>
                        
            </div>';
                    }else{
                        $number = $crow['number'];
                    $DB->query("update ayangw_order set trade_no='{$trade_no}',endTime='{$endtime}',sta = 1 where id = ".$row['id']);

                    $DB->query("update ayangw_km set trade_no='{$trade_no}',endTime='$endtime',stat = 1,out_trade_no = '{$out_trade_no}',rel = '{$lxfs}' where gid = {$row['gid']} and stat = 0  limit $number");
                    $str = "<br>商品名称：".$arr['name']."<br>订单编号：".$out_trade_no."<br>成交时间：".$endtime;
                    
                    ?>  <div class="panel panel-success">
                                        <div class="panel-heading">
                            <h3 class="panel-title">补单成功！您现在可以去提取您的卡密了！<?php echo $str;?></h3>
                        </div>
                                </div>                    <?php 
                    }
                  }else{
                                ?>
                                <div class="panel panel-warning">
                                <div class="panel-heading">
                    <h3 class="panel-title">该订单无需补单,请核对订单编号与联系方式！</h3>
                </div>
                </div>
                                <?php 
                            }
                        }else{
                            echo ' <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">未查询到相关订单信息，请核对订单号！</h3>
                </div>
                
            </div>';
                        }
                        
                }else{
                    echo ' <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">该站点未配置支付接口！</h3>
                </div>
                    
            </div>';
                }
    }
?>
	
		
		
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
