<?php
$rs = $DB->query("select * from ayangw_type");
$select = "";
while ($row = $DB->fetch($rs)) {
    $select .= '<option value="' . $row['id'] . '">' . $row['tName'] . '</option>';
}
?>


<html>

<head>
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title><?php echo $conf['title'];?></title>
<meta name="keywords" content="<?php echo $conf['keywords'];?>">
<meta name="description" content="<?php echo $conf['description'];?>">
<link href="template/zongzi/mcss/font-awesome.min.css" rel="stylesheet"
	type="text/css">
<link href="template/zongzi/mcss/newmobile.css" rel="stylesheet"
	type="text/css">
<link href="template/zongzi/mcss/thickbox.css" rel="stylesheet"
	type="text/css">
<link rel="stylesheet" type="text/css"
	href="template/zongzi/mcss/style.css">

</head>

<body ms-controller="myController" class="ms-controller">
	<!-- top -->
	<div class="pay_top">
		<p>商户名称：<?php echo $conf['title'];?> <br>在线客服：<?php echo $conf['zzqq']?>	</p>
	</div>
	<!-- 查询 客服 -->
	<div class="top_btn">
		<a href="index.php?tp=zongzi&action=query" target="_blank"><i class="iconfont">&#xe645;</i>
			订单查询</a> <a
			href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes"><i
			class="iconfont">&#xe600;</i> 联系客服</a>
	</div>
	<div class="choose_goods">
		<span class="choose_title">1. 选择商品</span>
		<div class="s_box">
			<span>商品分类</span> <select name="tp_id" id="tp_tid" required
				onchange="getPoint(this);">
					<?php echo $select;?>	
					</select>
		</div>
		<div class="s_box">
			<span>商品名称</span> <select name="gid" id="gid"
				onchange="getPrice_zongzi(this)">

			</select>
		</div>
		<p class="pinfo2">
			<span class="s_left">商品单价</span> <span><span name="need" id="need"
				style="color: red;">￥0.00</span>元</span>
		</p>
		<p class="pinfo2" style="<?php if($conf['showKc'] == 2) echo "display:none;"?> ">
			<span class="s_left">商品库存</span> <span>剩余<span name="kc" id="kc"
				style="color: red;">0</span>个
			</span>
		</p>
		<p>
			<span class="s_left">购买数量</span><span class="s_right"> <font
				color="green" id="goodInvent" style="float: left"></font> <input
				type="number" onBlur="checknum_zongzi()" name="number" id="number"
				value="1" required="required" min="1" style="height: 40px;"> &nbsp;
			</span>
		</p>
		<p>
			<span class="s_left">联系 Q Q</span> <span class="s_right"> <input
				name="lx" id="lx" type="text" style="height: 40px"
				required="required" placeholder="必填，作为购买者凭证">
			</span>
		</p>


	</div>
	<!-- 应付总额 -->
	<div class="price" id="payinfo">
		应付总额 <span class="red tprice" id="allprice"></span> 元

	</div>
	<input type="hidden" name="pay_type" />
	<div id="buy_border">
		<div class="step">2. 选择支付方式</div>
		<div id="step_two">
			<div class="paylist">
				<label>
					<div class="box" title="alipay" data-code='alipay'>
						&nbsp;<img src="template/zongzi/mimages/alipay.png" width="238"
							height="60" style="vertical-align: middle"> <span
							id="alipay_span" class="pay_span" type="alipay"></span>
					</div>
				</label> <label>
					<div class="box" title="qqpay" data-code='qqpay'>
						&nbsp;<img src="template/zongzi/mimages/qqpay.png" width="238"
							height="60" style="vertical-align: middle"> <span id="qqpay_span"
							class="pay_span" type="qqpay"></span>
					</div>
				</label> <label>
					<div class="box" title="wxpay" data-code='wxpay'>
						&nbsp;<img src="template/zongzi/mimages/wxpay.png" width="238"
							height="60" style="vertical-align: middle"> <span id="wxpay_span"
							class="pay_span" type="wxpay"></span>
					</div>
				</label>
				<div style="clear: left;"></div>
			</div>
		</div>
	</div>
	<div onclick="zongzimsub()">
		<input type="submit" id="sub" value="确认提交，进行下一步" class="next_btn">
	</div>



	<script src="template/zongzi/mjs/jquery.min.js" type="text/javascript"
		charset="utf-8"></script>
	<script src="template/zongzi/mjs/mui.min.js" type="text/javascript"
		charset="utf-8"></script>
	<script src="template/zongzi/mjs/avalon.min.js" type="text/javascript"
		charset="utf-8"></script>
	<script src="layer/layer.js"></script>
	<script src="js/ayangw.js"></script>
	<script type="text/javascript">
window.onerror=function(){return true;}
jQuery(document).ready(function($){ 
    try{
            
    }catch(e){}
});
</script>
	<script>
		getPoint($("#tp_tid"));
			var vm = avalon.define({
				$id: "myController",
				goodslist: [],
				goodsinfo: [],
				goods_number: 1
			});
			$(function(){
				
			    $(".box").click(function(){
			    
			        var title = $(this).attr("title");
			        var span = $(".pay_span");
			        for(var i = 0; i<span.length;i++){
			            var span_id = $(span[i]).attr("id");
			            $("#"+span_id).attr("title","false");
			            $("#"+span_id).css({"background-image":"url(template/zongzi/mimages/wt6.png)","background-size":"100% 100%"});
				    }
			        $("#"+title+"_span").attr("title","true");
			        $("#"+title+"_span").attr("display","inline-block");
			       // $("#"+title+"_span").css({"background-color":"red"});
			        $("#"+title+"_span").css({"background-image":"url(template/zongzi/mimages/right.png)","background-size":"100% 100%"});
			       
				    })
				})
			function zongzimsub(){
            	//alert(1);
            	var a = $('#kc').attr("alt");
            	if(a <= 0){
            		alert('该商品库存不足，无法购买！');
            		return;
            	}
            	
            	var gName = $("#gid").val();//获取商品名称<展示>
            	var gId = $("#gid option:selected").attr("id");//获取商品ID * 
            	var price = $("#need").val();//获取商品价格<展示>
            	var money =$("#gid option:selected").attr("title");;//获取商品价格  * 
            	var num = $("#lx").val();//获取联系方式 *
            	var type = "";
            	var payfs = "";
            	var span = $(".pay_span");
		        for(var i = 0; i<span.length;i++){
		            var span_id = $(span[i]).attr("id");
		            var s = $("#"+span_id).attr("title");
			        if(s == "true"){
			        	type = $("#"+span_id).attr("type");
			        	break;
				    }
			    }
            	if(type == "alipay") payfs = "支付宝";
            	if(type == "qqpay") payfs = "QQ钱包";
            	if(type == "wxpay") payfs = "微信";
            	var out_trade_no = d();//订单编号 * 
            	var number = parseInt($("#number").val());//获取数量
            	var b = checkLx(num);//判断联系方式是否正确


            	if(a < number){
            		alert('选择数量大于库存数量！');
            		return;
            	}
            	if(number <= 0){
            		alert('选择数量请大于0件！');
            		return;
            	}
            	if(num.length < 5 || b == false || num == " "){
            		alert('请输入正确的联系方式');
            		return;
            	}
            	if(type == null || type =="" ){
            		alert('请选择您的付款方式');
            		return;
            	}
            	if(gId == "" || money == "" || gId == null || money == null){
            		alert('当前商品无法创建订单！');
            		return;
            	}
           	 $("#sub").val("请稍等，正在提交...");
            
            	//验证卡密信息
            	$.ajax({
            		type : "POST",
            		url : "ajax.php?act=selKm",
            		data : {"gid":gId},
            		dataType : 'json',
            		success : function(data) {
           			 $("#sub").val("确认提交，进行下一步");
            			if(data.code == -1){
            				alert('该商品卡密库存不足！无法购买！');
            				return;
            			}
            		},
            		error:function(data){
           			 $("#sub").val("确认提交，进行下一步");
            			alert('服务器错误');
            			return;
            			}
            	});
           	 $("#sub").attr("disabled","disabled");
            	money = money * number;
            	var u = "type="+type+"&name="+gName+"&money="+money+"&number="+number+"&out_trade_no="+out_trade_no+"&gid="+gId;
            	$.ajax({
    				type : "POST",
    				url : "ajax.php?act=create",
    				data : {"out_trade_no":out_trade_no,"gid":gId,"money":money,"rel":num,"type":type,"number":number},
    				dataType : 'json',
    				//timeout : 5000,
    				success : function(data) {	
   					 $("#sub").val("确认提交，进行下一步");
    					 if(data.code != 0){
    							alert('创建订单失败！'+data.msg);
    							return false;
    					 }
    					 window.location.href ="other/submit.php?"+u;
    					
    				},
    				error:function(data){
   					 $("#sub").val("确认提交，进行下一步");
    					alert('服务器错误');
    					return false;
    					}
    			})
            	
            }
		</script>
</body>

</html>