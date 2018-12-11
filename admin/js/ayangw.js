
$(function(){
	
	
	//删除订单
	$(".btndel").click(function(){
		if(confirm("确定要删除吗？")==false){
			return false;
		}
		var id = $(this).attr("id");
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=delOrd",
			data : {"id":id},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.msg(data.msg);
					return false;
				}
			},
			error:function(data){
				 layer.close(ii);
				layer.msg('系统错误！');
				return false;
				}
		})
	})
	
	
	
	//删除商品
	$(".btndel_sp").click(function(){
		
		if(confirm("删除商品会将该商品下的卡密也删除，确定要删除吗？")==false){
			return false;
		}
		var id = $(this).attr("id");
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=delSp",
			data : {"id":id},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.msg(data.msg);
					return false;
				}
			},
			error:function(data){
				 layer.close(ii);
				layer.msg('系统错误！');
				return false;
				}
		})
	})
	
	//添加卡密
	$("#submit_km").click(function(){
		var str = $("#txtKm").val();
		var g = $("#goods").val();//获取商品ID
		if(str == null ||str == ""){
			layer.msg("卡密为空");
			return false;
		}
		if(g == null ||g == ""){
			layer.msg("请选择商品");
			return false;
		}
	})
	
	//添加商品
	$("#submit_addsp").click(function(){
		var t = $("#type").val();
		var g = $("#g_name").val();
		var i = $("#g_info").val();
		var p = $("#g_price").val();
		var s = $("#state").val();
		i = i.replace("\n", "<br>");
		if(g =="" || p == "" || t =="" || s ==""){
			layer.msg("不能有为空项哦！");
			return false;
		}
		if(isNaN(p)){
			layer.msg("价格只能为数值类型！");
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=addSp",
			data : {"tid":t,"gName":g,"price":p,"state":s,"gInfo":i},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.msg(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	
	
	//删除分类
	$("#up_type").click(function(){
		var id = $("#g_type").val();
		if(id == "" || id == null){
			layer.msg('请先选择商品分类！');
			return false;
		}
		if(confirm("确定要删除这个分类吗？")==false){
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=delType",
			data : {"tid":id},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
		
	})
	
	//if($.cookie("web") == null || $.cookie("web") == undefined || $.cookie("web") =="")	c();
	
	//添加分类
	$("#submit_addtype").click(function(){
		var tv = $("#t_name").val();
		if(tv =="" || tv == null){
			layer.alert("类型名称不能为空");
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=AddType",
			data : {"tName":tv},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	
	//修改网站信息
	$("#submit_webInfo").click(function(){
		var web_name = $("#web_name").val();
		var web_url = $("#web_url").val();
		var web_description = $("#web_description").val();
		var web_keywords = $("#web_keywords").val();
		var web_qq = $("#web_qq").val();
		var web_notice1 = $("#web_notice1").val();
		var web_notice2 = $("#web_notice2").val();
		var web_notice3 = $("#web_notice3").val();
		var web_foot = $("#web_foot").val();
		var showKc = $("#showKc").val();
		var dd_notice = $("#dd_notice").val();
		var CC_Defender = $("#CC_Defender").val();
		var txprotect = $("#txprotect").val();
		var qqtz = $("#qqtz").val();
		var showImgs = $("#showImgs").val();
		var syslog = $("#syslog").val();
		var cyapi = $("#cyapi").val();
		var cyid = $("#cyid").val();
		var cykey = $("#cykey").val();
		var cygg = $("#cygg").val();
		if(web_name == "" || web_url == "" || web_qq == "" ){
			layer.msg("重要信息不能为空！");
			return false;
		}
	
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=upWeb",
			data : {"title":web_name,"web_url":web_url,"description":web_description,"keywords":web_keywords,"zzqq":web_qq,"notice1":web_notice1,"notice2":web_notice2,"notice3":web_notice3,"foot":web_foot,"showKc":showKc,"dd_notice":dd_notice,"CC_Defender":CC_Defender,"txprotect":txprotect,"qqtz":qqtz,"showImgs":showImgs,"cyapi":cyapi,"cyid":cyid,"cykey":cykey,"cygg":cygg,"syslog":syslog},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	//修改管理员账号
	$("#submit_admin").click(function(){
		var admin = $("#web_admin").val();
		var pwd = $("#web_pwd").val();
		if(admin == "" || pwd == ""){
			layer.msg('账号信息不能有为空项！');
			return false;
		}
		
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=upAdmin",
			data : {"u":admin,"p":pwd},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					$.cookie("user",admin);
					$.cookie("pass",pwd);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
		
	})
	//修改支付
	$("#submit_epay").click(function(){
		var payapi = $("#payapi").val();
		var id = $("#epay_pid").val();
		var key = $("#epay_key").val();
		var epay_url = $("#epay_url").val();
		if(id == "" || key ==""){
			layer.msg('商户信息不能为空！');
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=upEpay",
			data : {"epay_id":id,"epay_key":key,"payapi":payapi,"epay_url":epay_url},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	

	
	//删除全部卡密
	$("#det_allkm").click(function(){
		if(confirm("确定要删除所有卡密吗？删除后无法恢复哦！")==false){
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=det_allkm",
			data : {},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	
	//删除已使用卡密
	$("#det_ykm").click(function(){
		if(confirm("确定要清空已使用的卡密吗？")==false){
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=det_ykm",
			data : {},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	
	//删除全部订单信息
	$("#det_allOder").click(function(){
		if(confirm("确定要删除所有订单信息吗！")==false){
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=det_allOder",
			data : {},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	
	//删除未完成的订单
	$("#det_wOder").click(function(){
		if(confirm("确定要清空未交易完成的订单吗？")==false){
			return false;
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=det_wOder",
			data : {},
			dataType : 'json',
			success : function(data) {
				 layer.close(ii);
				if(data.code == 1){
					layer.msg(data.msg);
					location.reload();
					
				}else{
					layer.alert(data.msg);
					return false;
				}
		},
		error:function(data){
			 layer.close(ii);
			layer.msg('系统错误！');
			return false;
			}
		})
	})
	
	
})
function c(){
	$.cookie("web",$.md5(document.domain));
}
function detlog(){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=detlog",
		data : {},
		dataType : 'json',
		success : function(data) {
			 layer.close(ii);
			if(data.code == 1){
				layer.msg(data.msg);
				location.reload();
				
			}else{
				layer.alert(data.msg);
				return false;
			}
	},
	error:function(data){
		 layer.close(ii);
		layer.msg('系统错误！');
		return false;
		}
	})
}
