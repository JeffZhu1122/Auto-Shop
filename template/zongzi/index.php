<?php
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
<html>

	<head>
		<title><?php echo $conf['title'];?></title>
		<meta charset="UTF-8">
  <meta name="keywords" content="<?php echo $conf['keywords'];?>">
  <meta name="description" content="<?php echo $conf['description'];?>">
		<link rel="stylesheet" type="text/css" href="template/zongzi/css/nyroModal.css"/>
<link href="template/zongzi/css/style.css" rel="stylesheet" type="text/css" />
<link href="template/zongzi/css/index_1.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
		label.error{ padding-left: 0!important; color: #f00;}
		.nyroModalCont iframe {width: 300px; height: 400px;}
		#code table{ margin: auto;}
		</style>
	</head>

	<body ms-controller="myController" class="ms-controller">
		
		<div class="header">
	<div class="header_top">
		<div class="logo">
			<a href="/"><img src="assets/imgs/logo.png" /></a>
		</div>
		<div class="nav">
			<ul>
				<li class="active">
					<a href="index.php?tp=zongzi&action=query">订单查询</a>
				</li>
				<li >
					<a onclick="Addme()" style="cursor: pointer;">收藏本站</a>
				</li>
				<li >
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes">联系客服</a>
				</li>
			</ul>
		</div>
	</div>
</div>

		<div class="choose_goods">
			<div class="content">

				<div class="gonggao">
					<p style="font-size:16px;color:#FF3300;">商家公告： <?php echo $conf['notice1']?></p>
				    <p style="font-size:16px;color:#FF3300;">商家公告： <?php echo $conf['notice2']?></p>
				</div>

				
					<input type="hidden" name="goods_name" id="goods_name"  />
					<div class="info">
						<div class="buy_info" style="background-image: url('template/zongzi/images/12_buy_background_i_1.jpg');">
							<h1>商家信息</h1>
							<p>
								卖家Q Q：<?php echo $conf['zzqq']?>							<a target="blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&Site=&Menu=yes"><img border="0" src="template/zongzi/images/qqlt.jpg" alt="点击这里给我发消息" align="absmiddle"></a><br /> 商品类型：数字卡密
								<br /> 发货类型：自动发货 <br />
							</p>
						</div>
						<div class="buy_form">
							<div class="form_header">
								<h1>选择商品</h1>
							</div>
							<div class="form">
								<div class="input_group">
									<label for="feilei">商品分类</label>
									<span class="out_select">
										<span class="inner_select">
										<select  name="tp_id" id="tp_tid" required onchange="getPoint(this);">
											<?php echo $select;?>
											</select>	
										</span>
									</span>
								</div>
								<div class="input_group">
									<label for="name">商品名称</label>
									<span class="out_select">
										<span class="inner_select">
											<select  name="gid" id="gid" onchange="getPrice_zongzi(this)" required="required">
											
											</select>
										</span>
									</span>
								</div>
								
								<div class="input_group jiage">
									<label for="price">商品单价</label>
									<span><span  name="need" id="need" style="color:red;">￥0.00</span>元</span>
								
								</div>
								<div class="input_group jiage"  style="<?php if($conf['showKc'] == 2) echo "display:none;"?> ">
									<label for="price">商品库存</label>
									<span>剩余<span  name="kc" id="kc"  style="color:red;">0</span>个</span>
								
								</div>
								
								<div class="input_group">
									<label for="nums">购买数量</label>
									<input type="number" ms-attr="{'data-id':@goodsinfo.id,'max':@goodsinfo.max_buy}" class="input" onBlur="checknum_zongzi()"  name="number" id="number" min="1" value="1"/> <span class="green" id="goodInvent"></span> <span id="limit_quantity_tip" class="gray" style="display:none">()</span>

								</div>
								<div class="input_group">
									<label for="tel">联系 Q Q</label>
									<input type="number" class="input"  name="lx" id="lx"  required="required"  />
								</div>
								

								<div class="sum pinfo2">
									<p>您应付总额为<span class="price tprice" id="allprice"></span>元<span class="price bt">（人民币）</span></p>
								</div>
							</div>

							<div class="buy_code" style="display: ;">
								<dl>
									<dt id="qrcodeTable" style="padding-left:40px"></dt>
									<dd>可用手机扫描二维码购买</dd>
									<dd id="code"></dd>
								</dl>
							</div>
						</div>
					</div>

					<div class="charge_header">
						<h1>支付方式</h1>
					</div>
                   
					<div id="step_two" >
						<div class="paylist" >
							<ul >
							
								<li><label><input type="radio"  name="type" value="alipay" class="pay" id="alipay" value="alipay" title="支付宝"  /> <img src="template/zongzi/images/alipay.gif" alt="支付宝" align="absmiddle" /></label></li>
								
								<li><label><input  type="radio" name="type" value="wxpay" class="pay" id="wxpay" value="wxpay" title="微信"  /> <img src="template/zongzi/images/wxpay.gif" alt="微信" align="absmiddle" /></label></li>
								
								<li><label><input type="radio"  name="type" value="qqpay"  class="pay" id="qqpay" value="qqpay" title="QQ钱包"  /> <img src="template/zongzi/images/qqpay.gif" alt="QQ钱包" align="absmiddle" /></label></li>							
							
								</ul>
						</div>
					</div>
					
					<div id="submit" onclick="zongzisub()"><input type="image"  src="template/zongzi/images/an.jpg" /></div>
				
			</div>
		</div>

		<div id="footer"> 2018 &copy;  <?php echo $conf['title'];?></div>
		<script type="text/javascript" src="template/zongzi/js/jquery.min.js"></script>
<script src="template/zongzi/js/avalon.min.js" type="text/javascript" charset="utf-8"></script>
<script src="template/zongzi/js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
<script src="template/zongzi/js/messages_zh.js" type="text/javascript" charset="utf-8"></script>
<script src="template/zongzi/js/jquery.nyroModal.custom.js" type="text/javascript" charset="utf-8"></script>
<script src="template/zongzi/js/ismobile.js" type="text/javascript" charset="utf-8"></script>
<script src="layer/layer.js"></script>
<script src="js/ayangw.js"></script>
<script type="text/javascript">
window.onerror=function(){return true;}
jQuery(document).ready(function($){ 
    try{
            
    }catch(e){}
});
</script>
		<script src="template/zongzi/js/jquery.qrcode.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		var vm = avalon.define({
			$id: "myController",
			goodslist:[],
			goodsinfo:[],
			goods_number:1
		})
		jQuery(document).ready(function($){ 
			
			jQuery("#code").qrcode({ 
			    render: "table", //table方式 
			    width: 200, //宽度 
			    height:200, //高度 
			    text: location.href //任意内容 
			}); 
			
		    
		});
		getPoint($("#tp_tid"));
		</script>
	</body>

</html>