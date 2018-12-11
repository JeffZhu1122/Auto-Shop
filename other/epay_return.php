<?php
/*
 * 源码来源：全名易支付
 * */

define('SYSTEM_ROOT_E', dirname(__FILE__).'/');
include '../ayangw/common.php';
require_once(SYSTEM_ROOT_E."epay/epay.config.php");
require_once(SYSTEM_ROOT_E."epay/epay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
empty($_COOKIE['auth'])?exit():null;
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
	//商户订单号	
	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号	
	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	$sql = "SELECT * FROM ayangw_order WHERE out_trade_no='{$out_trade_no}' limit 1";
    $res = $DB->query($sql);
    $srow = $DB->fetch($res);

    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		if($srow['sta']==0){
		    if(!srow || $srow['money'] != $_GET['money']){
		       showalert('验证失败！',4,'订单回调验证失败！');
		    }
		    $number = $srow['number'];
		   /*
		    $sql2 = "UPDATE ayangw_km set endTime = now(),out_trade_no = '{$out_trade_no}',trade_no='{$trade_no}',rel ='{$srow['rel']}',stat = 1
		    where gid = {$srow['gid']} and stat = 0
		    limit  $number";
		     if($DB->query($sql2) > 0){
		         $sql = "update ayangw_order set sta = 1, trade_no = '{$trade_no}' ,endTime = now() where out_trade_no = '{$out_trade_no}'";
		         	
		         $DB->query($sql);
		     }*/
			$ok = 0;
            for($i=1;$i<=$number;$i++){
                $sql2 = "UPDATE ayangw_km "
                        . "set endTime = now(),out_trade_no = '{$out_trade_no}',trade_no='{$trade_no}',rel ='{$srow['rel']}',stat = 1
                           where gid = {$srow['gid']} and stat = 0
                           limit  1";
                if($DB->query($sql2)){
                    $ok++; 
                }
            } 
		$sql = "update ayangw_order set sta = 1, trade_no = '{$trade_no}' ,endTime = now() where out_trade_no = '{$out_trade_no}'";
		         	
		         $DB->query($sql);
                          wsyslog("交易成功！[回调处理]","订单编号：".$out_trade_no.";数量：".$number.";成功提取数量：".$ok."");
			showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no);
		}else{
			showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no);
		}
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
}
else {
    //验证失败
	showalert('验证失败！',4,'订单回调验证失败！');
}
function showalert($msg,$status,$orderid=null){
    global $ereturn;
    echo '<meta charset="utf-8"/><script>window.location.href="'.$ereturn.$orderid.'";</script>';
}
?>