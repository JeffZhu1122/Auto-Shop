<?php
?>
<!-- 
**********************************************
/*
 * 源码来源：全名易支付
 * */    
**********************************************
-->
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>订单查询</title>
<link rel="stylesheet" type="text/css"
	href="template/zongzi/css/nyroModal.css" />
<link href="template/zongzi/css/style.css" rel="stylesheet"
	type="text/css" />
<link href="template/zongzi/css/index_1.css" rel="stylesheet"
	type="text/css" />
	  <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<style type="text/css">
#row1 {
	border: 1px solid #ccc;
	clear: both;
	float: none;
	width: 900px;
	margin: 20px auto;
}

#row1 dt {
	margin: 30px;
	text-align: center;
	color: #1185e8;
	font-size: 24px;
	margin-bottom: 30px;
}

#row1 .r1 {
	padding: 0 0 20px 0;
}

#row1 .r1 ul {
	margin: auto;
	text-align: center;
}

#row1 .r1 li {
	display: inline;
	float: none;
}

#row1 .r1 .card_pwd {
	width: 150px;
}

#row1 .r1 .notice {
	width: 90%;
	margin: 20px auto 0;
}

#row1 .r1 .notice strong {
	color: #fc8827;
	font-weight: 700;
}

#row1 .r1 .notice li {
	display: block;
	text-align: left;
}

#row1 .keywords {
	width: 300px;
	margin-right: 10px;
	height: 28px;
	border: 1px solid #ccc;
	padding-left: 5px;
}

#row1 .r2 {
	border-top: 1px solid #ccc;
	padding: 20px;
}

#row1 .r2 .title {
	color: #1185e8;
	font-size: 18px;
}

#row1 .r2 ul {
	margin: 10px 0 0 0;
}

#row1 .r2 li {
	float: none;
}

#row1 .r2 li ul {
	margin: -22px 0 0 44px
}

#footer {
	position: fixed;
	bottom: 0;
}
</style>
</head>

<body>
	<div class="header">
		<div class="header_top">
			<div class="logo">
				<a href="/"><img src="assets/imgs/logo.png" /></a>
			</div>
			<div class="nav">
				<ul>
					<li class="active"><a href="index.php">首页</a></li>
					<li><a onclick="Addme()" style="cursor: pointer;">收藏本站</a></li>
					<li><a
						href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes">联系客服</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<dl id="row1">
		<dt>订单查询</dt>
		<dd class="r1">
			<form action="index.php?tp=zongzi&action=query&act=select"
				method="POST">
				<ul>
					<li><input type="text" name="tqm" class="keywords"
						required="required" value="" placeholder="输入订单号或联系QQ" /></li>
					<li><input type="image"
						src="template/zongzi/images/search_button.png" value="" /></li>
				</ul>
			</form>
			<ul class="notice">
				<li><strong>订单号查询：</strong>订单号是您在提交支付的时候，系统自动分配的一个交易凭证，输入对应的订单号即可查询该订单的详情。</li>
				<li><strong>联系方式查询：</strong>订单提交时您所预留的联系方式（QQ号码、手机号码、E-mail）订单查询凭证信息。</li>
			</ul>
		</dd>
		<dd class="r2">
			<h2 class="title">查询结果</h2>
			<div class="table-responsive">
                        <table class="table table-striped table-advance table-hover">
                           <thead>
                              <tr>
                                 <th><i class="fa  fa-align-center"></i> 订单编号</th>
                                 <th class="hidden-phone"><i class="fa fa-chain-broken"></i> 商品名称</th>
                                 <th><i class="fa fa-cny"></i> 价格</th>
                                  <th><i class="fa fa-linux"></i> QQ</th>
                                 <th><i class="fa fa-clock-o"></i> 交易时间</th>
                                 <th><i class=" fa fa-edit"></i> 卡密信息</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
			<?php
            if (! empty($_GET['act']) && $_GET['act'] == "select") {
                
                $tqm = _ayangw($_POST['tqm']);
                $sql = "select * from ayangw_km
                                                where out_trade_no ='{$tqm}' or trade_no = '{$tqm}' or rel = '{$tqm}'
                                                ORDER BY endTime desc
                                                ";
                $res = $DB->query($sql);
                while ($row = $DB->fetch($res)) {
                    $sql2 = "select * from ayangw_goods where id =" . $row['gid'];
                    $res2 = $DB->query($sql2);
                    $row2 = $DB->fetch($res2);
                    echo "<tr>";
                    echo "<td>{$row['trade_no']}</td><td>{$row2['gName']}</td>
                                                    <td>{$row2['price']}</td><td>{$row['rel']}</td><td>{$row['endTime']}</td><td>{$row['km']}</td>";
                    echo "</tr>";
                }
            }elseif(!empty($_GET['out_trade_no'])){
				$tqm = _ayangw($_GET['out_trade_no']);
                $sql = "select * from ayangw_km
                                                where out_trade_no ='{$tqm}'
                                                limit 1
                                                ";
                $res = $DB->query($sql);
                while ($row = $DB->fetch($res)) {
                    $sql2 = "select * from ayangw_goods where id =" . $row['gid'];
                    $res2 = $DB->query($sql2);
                    $row2 = $DB->fetch($res2);
                    echo "<tr>";
                    echo "<td>{$row['trade_no']}</td><td>{$row2['gName']}</td>
                                                    <td>{$row2['price']}</td><td>{$row['rel']}</td><td>{$row['endTime']}</td><td>{$row['km']}</td>";
                    echo "</tr>";
                }
			}
            ?>   </tbody></table></div>
			<ul>
				<li>没有更多相关结果，请确认查询信息</li>
			</ul>
		</dd>

	</dl>

	<div style="min-height: 50px;text-align: center; background-color: black;color:white;line-height: 50px;"> 2018 &copy;  <?php echo $conf['title'];?></div>
	
	<script type="text/javascript">
window.onerror=function(){return true;}
jQuery(document).ready(function($){ 
    try{
            
    }catch(e){}
});
</script>
	<script type="text/javascript">
			window.onerror = function() {
				return true;
			}
			jQuery(document).ready(function($) {
				try {} catch(e) {}
			});
		</script>
</body>

</html>