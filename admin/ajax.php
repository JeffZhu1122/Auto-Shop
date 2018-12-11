<?php
include '../ayangw/common.php';
@header('Content-Type: application/json; charset=UTF-8');
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

} else {
    exit( "页面非法请求！");
}
if(empty($_GET['act'])){
    exit("非法访问！");
}else{
    $act=$_GET['act'];
}

switch ($act){
    //验证登陆
    case 'checkLogin':
        $user = _ayangw($_POST['user']);
        $pass = daddslashes($_POST['pass']); 
        $pass = md5($pass.$password_hash);
        if($user == $conf['admin'] &&  $pass== $conf['pwd']){
            wsyslog("登陆后台成功!","登陆IP:".real_ip().",城市:".get_ip_city());
            $session=md5($user.$pass.$password_hash);
            $token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
            setcookie("admin_token", $token, time() + 604800);
            exit('{"code":1,"msg":"登陆成功"}');
        }else{
            wsyslog("登陆后台失败!","登陆IP:".real_ip().",城市:".get_ip_city()."　|　用户名:".$user.",密码:".$_POST['pass']);
            exit('{"code":0,"msg":"用户名或密码错误"}');
        }
        ;break;
        //删除订单
    case 'delOrd': 
        $id = _ayangw($_POST['id']);
        $sql = "delete from ayangw_order where id = ".$id;
        $b = $DB->query($sql);
        if($b > 0){
            exit('{"code":1,"msg":"删除成功"}');
        }else{
            exit('{"code":-1,"msg":"删除失败"}');
        }
        ;break;
       //删除卡密
    case 'delKm': 
            $id = _ayangw($_POST['id']);
            $sql = "delete from ayangw_km where id = ".$id;
            $b = $DB->query($sql);
            if($b > 0){
                exit('{"code":1,"msg":"删除成功"}');
            }else{
                exit('{"code":-1,"msg":"删除失败"}');
            }
            ;break;
            //删除商品
     case 'delSp':
                $id = _ayangw($_POST['id']);
                $sql = "delete from ayangw_goods where id = ".$id;
                $b = $DB->query($sql);
                if($b > 0){
                    $sql = "delete from ayangw_km where gid = ".$id;
                   $DB->query($sql);
                    exit('{"code":1,"msg":"删除成功"}');
                }else{
                    exit('{"code":-1,"msg":"删除失败"}');
                }
                ;break;
     case 'addSp':
                $tpId = _ayangw($_POST['tid']);
                $gName = daddslashes($_POST['gName']);
                $price = _ayangw($_POST['price']);
                $state = _ayangw($_POST['state']);
                $gInfo = daddslashes($_POST['gInfo']);
                $sql = "insert into ayangw_goods(gName,gInfo,tpId,price,state) values('{$gName}','$gInfo',{$tpId},{$price},{$state})";
                $b = $DB->query($sql);
               
                if($b > 0){
                    exit('{"code":1,"msg":"添加成功"}');
                }else{
                    exit('{"code":-1,"msg":"添加失败"}');
                }
               ;break;
   case 'delType':
       $id = _ayangw($_POST['tid']);
       $sql = "select * from ayangw_goods where tpid = ".$id;
       $res = $DB->query($sql);
       if($row = $DB->fetch($res)){
           exit('{"code":-1,"msg":"该分类下面还有商品！请先删除商品后再删除分类！"}');
       }
       $sql = "delete from ayangw_type where id =".$id;
       $b =  $DB->query($sql);
       if($b > 0){
           exit('{"code":1,"msg":"删除成功"}');
       }else{
           exit('{"code":-1,"msg":"删除失败"}');
       }
       ;break;    
   case 'AddType':
       $tName = daddslashes($_POST['tName']);
       $sql = "insert into ayangw_type(tName) values('".$tName."')";
       $b =  $DB->query($sql);
       if($b > 0){
           exit('{"code":1,"msg":"添加成功"}');
       }else{
           exit('{"code":-1,"msg":"添加失败"}');
       }
       ;break;
   case 'upWeb':
       $i = 0;
       foreach ($_POST as $k => $value) {
           $value=daddslashes($value);
           $DB->query("insert into ayangw_config set `ayangw_k`='{$k}',`ayangw_v`='{$value}' on duplicate key update `ayangw_v`='{$value}'");
       }
      
       if(1 > 0){
           wsyslog("修改网站信息成功!","IP:".real_ip().",城市:".get_ip_city());
           exit('{"code":1,"msg":"修改成功"}');
       }else{
           wsyslog("修改网站信息失败!","IP:".real_ip().",城市:".get_ip_city());
           exit('{"code":-1,"msg":"修改失败"}');
       }
       ;break;
       
   case 'upEpay':
        $i = 0;
       foreach ($_POST as $k => $value) {
           $i++;
           $value=daddslashes($value);
           $DB->query("insert into ayangw_config set `ayangw_k`='{$k}',`ayangw_v`='{$value}' on duplicate key update `ayangw_v`='{$value}'");
       }
       if($i > 0){
           wsyslog("修改商户信息成功!","IP:".real_ip().",城市:".get_ip_city());
           exit('{"code":1,"msg":"修改成功"}');
       }else{
           wsyslog("修改商户信息失败!","IP:".real_ip().",城市:".get_ip_city());
           exit('{"code":-1,"msg":"修改失败"}');
       }
       ;break;
   case 'upEmail':
     $i = 0;
       foreach ($_POST as $k => $value) {
           $i++;
           $value=daddslashes($value);
           $DB->query("insert into ayangw_config set `ayangw_k`='{$k}',`ayangw_v`='{$value}' on duplicate key update `ayangw_v`='{$value}'");
       }
       if($i > 0){
           exit('{"code":1,"msg":"修改成功"}');
       }else{
           exit('{"code":-1,"msg":"修改失败"}');
       }
       ;break;
  
   case 'upAdmin':
       $u= _ayangw($_POST['u']);//用户名
       $p = _ayangw($_POST['p']);//密码
       $b = $DB->query("update `ayangw_config` set `ayangw_v` ='{$p}' where `ayangw_k`='pwd'");
       if($b > 0){
           wsyslog("修改账号密码成功!","IP:".real_ip().",城市:".get_ip_city());
           exit('{"code":1,"msg":"修改成功"}');
       }else{
           wsyslog("修改账号密码失败!","IP:".real_ip().",城市:".get_ip_city());
           exit('{"code":-1,"msg":"修改失败"}');
       }
       ;break;
   case 'det_allkm':
       $sql = "delete from ayangw_km";
       $b =  $DB->query($sql);
       if($b > 0){
           exit('{"code":1,"msg":"删除成功"}');
       }else{
           exit('{"code":-1,"msg":"删除失败"}');
       }
       ;break;
   case 'det_ykm':
       $sql = "delete from ayangw_km where stat = 1";
       $b = $DB->query($sql);
       if($b > 0){
           exit('{"code":1,"msg":"删除成功"}');
       }else{
           exit('{"code":-1,"msg":"删除失败"}');
       }
       ;break;
   case 'det_allOder':
       $sql = "delete from ayangw_order";
       $b =  $DB->query($sql);
       if($b > 0){
           exit('{"code":1,"msg":"删除成功"}');
       }else{
           exit('{"code":-1,"msg":"删除失败"}');
       }
       ;break;
   case 'c':
           exit('{"code":1}');
           ;break;
   case 'det_wOder':
           $sql = "delete from ayangw_order where sta = 0";
           $b =  $DB->query($sql);
           if($b > 0){
               exit('{"code":1,"msg":"删除成功"}');
           }else{
               exit('{"code":-1,"msg":"删除失败"}');
           }
           ;break;
    case 'detlog':
               $sql = "delete from ayangw_syslog";
               $b =  $DB->query($sql);
               if($b > 0){
                   exit('{"code":1,"msg":"删除成功"}');
               }else{
                   exit('{"code":-1,"msg":"删除失败"}');
               }
               ;break;
    default:;break;
}


?>