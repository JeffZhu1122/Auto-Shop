$(function(){
   $("#btn_exe").click(function(){
       var sindex = $("#select_exe option:selected").val();
       if(sindex == -1){
           alert("操作无效");
           return;
       }
     var str = "";
     $(".chkbox").each(function() {
        if(this.checked == true){
            if(str != ""){
                str = str+",";
            }
            var e = $(this).attr("ids");
            str += e;
        }
     });
    if(str == ""){
        alert("无选中数据！");
        return;
    }
           var ii = layer.load(2, {shade:[0.1,'#fff']});
           $.ajax({
                   type : "POST",
                   url : "action.php?act=sp_plexe",
                   data : {"str":str,"type":sindex},
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
   
   $("#cid").change(function(){
        var sindex = $("#cid option:selected").val();
        var ii = layer.load(2, {shade:[0.1,'#fff']});
           $.ajax({
                   type : "POST",
                   url : "action.php?act=getsp",
                   data : {"cid":sindex},
                   dataType : 'json',
                   success : function(data) {
                            layer.close(ii);
                           if(data.code == 1){
                                   $("#tid").html(data.data);
                                  // location.reload();

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
   $("#km_btn_exe").click(function(){
        var sindex = $("#km_select_exe option:selected").val();
       if(sindex == -1 || sindex == undefined){
           alert("操作无效");
           return;
       }
       var str = "";
        $(".chkbox").each(function() {
           if(this.checked == true){
               if(str != ""){
                   str = str+",";
               }
               var e = $(this).attr("ids");
               str += e;
           }
        });
       if(str == ""){
           alert("无选中数据！");
           return;
       }
       
       var ii = layer.load(2, {shade:[0.1,'#fff']});
           $.ajax({
                   type : "POST",
                   url : "action.php?act=exekm",
                   data : {"type":sindex,"str":str},
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
   $("#tid").change(function(){
       var sindex = $("#tid option:selected").val();
       if(sindex == -1){
             $("#allcount").text("0");
              $("#sycount").text("0");
           return;
       }
        var ii = layer.load(2, {shade:[0.1,'#fff']});
           $.ajax({
                   type : "POST",
                   url : "action.php?act=getkminfo",
                   data : {"tid":sindex},
                   dataType : 'json',
                   success : function(data) {
                            layer.close(ii);
                           if(data.code == 1){
                               $("#allcount").text(data.allcount);
                               $("#sycount").text(data.sycount);
                           
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
   
   $("#btn-det-ysykm").click(function(){
       if(confirm("确定要删除所有已使用卡密吗？") == false){
           return false;
       }
        var ii = layer.load(3, {shade:[0.1,'#fff']});
           $.ajax({
                   type : "POST",
                   url : "action.php?act=det-ysykm",
                   data : {},
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
    $("#btn-det-allkm").click(function(){
       if(confirm("确定要删除所有卡密吗？") == false){
           return false;
       }
        var ii = layer.load(3, {shade:[0.1,'#fff']});
           $.ajax({
                   type : "POST",
                   url : "action.php?act=det-allkm",
                   data : {},
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
   
   $("#email-send-test").click(function(){
            var ii = layer.load(3, {shade:[0.1,'#fff']});
           $.ajax({
                   type : "POST",
                   url : "action.php?act=e_send_t",
                   data : {},
                   dataType : 'json',
                   success : function(data) {
                            layer.close(ii);
                           if(data.code == 1){
                              //layer.msg(data.msg);
                              // location.reload();
                              $("#tis-div").show();
                              $("#tis-msg").html(data.msg);
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
})
function allcheck(e){
   if(e.checked){
        $(".chkbox").each(function() {
                this.checked = true;
            });
   }else{
       $(".chkbox").each(function() {
                this.checked = false;
            });
   }
  //  $(".chkbox").checked();
}
function gzt_sh(gid,zt){
    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
            type : "POST",
            url : "action.php?act=sp_qiehuan",
            data : {"gid":gid,"zt":zt},
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
}
function checkAdd(){
    var tid = $("#tid option:selected").val();
   if(tid == "" || tid == undefined || tid == "Undefined" || tid == -1){
       alert("商品无效！");
       return false;
   }
   if($("#kms").val() == ""){
       alert("卡密无效！");
       return false;
   }
    return true;
}

function detkm(id){
    //删除卡密
    if(confirm("确定要删除吗？")==false){
            return false;
    }


    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
            type : "POST",
            url : "ajax.php?act=delKm",
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
}

function kmxxi(id){
    var html ="";
     var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
            type : "POST",
            url : "action.php?act=getkmxxinfo",
            data : {"id":id},
            dataType : 'json',
            success : function(data) {
                     layer.close(ii);
                    if(data.code == 1){
                        var datamsg = data.data;
                             html = '<ul class="list-group">'+
                            '  <li class="list-group-item">商品名称：'+datamsg.gName+'</li>'+
                              '<li class="list-group-item">卡密信息：'+datamsg.km+'</li>'+
                            '  <li class="list-group-item">导入时间：'+datamsg.benTime+'</li>'+
                            '  <li class="list-group-item">使用时间：'+(datamsg.endTime==null?"无":datamsg.endTime)+'</li>'+
                            '  <li class="list-group-item">系统订单编号：'+(datamsg.out_trade_no==null?"无":datamsg.out_trade_no)+'</li>'+
                            '  <li class="list-group-item">商户订单编号：'+(datamsg.trade_no==null?"无":datamsg.trade_no)+'</li>'+
                            '  <li class="list-group-item">联系方式：'+(datamsg.rel==null?"无":datamsg.rel)+'</li>'+
                            '  <li class="list-group-item">卡密状态：'+(datamsg.stat==0?"<font color=green>未使用</font>":"<font color=red>已使用</font>")+'</li>'+
                          '</ul>';
                  layer.open({
        type: 1,
        title:'卡密详细信息',
        skin: 'layui-layer-rim', //加上边框
        area: ['420px', '450px'], //宽高
        content: html
    });

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
  
   
}