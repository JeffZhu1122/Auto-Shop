<?php

/*
 * 源码来源：全名易支付
 * */

include '../ayangw/common.php';
@header('Content-Type: text/html; charset=UTF-8');
if($islogin==1){
?>
<!-- 
**********************************************
/*
 * 源码来源：全名易支付
 * */       ~~      
**********************************************
-->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>后台管理中心</title>
  <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://template.down.swap.wang/ui/angulr_2.0.1/html/css/app.css" type="text/css" />
  <link href="//lib.baomitu.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
  
  <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <script src="js/jquery.md5.js"></script>

  <script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
  <script src="//lib.baomitu.com/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="js/ayangw.js"></script>
  
</head>
<body>

  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./" style="color:#42a5f5;">后台管理中心</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right" >
          <li class="">
            <a href="./" style="color:#18a0a0;"><span class="glyphicon glyphicon-user"></span> 平台首页</a>
          </li>
		  <li class="">
            <a href="./list.php" style="color:#cd5c00;"><span class="glyphicon glyphicon-calendar"></span> 订单管理</a>
          </li>
          <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#f48224;"><span  class="glyphicon glyphicon-list-alt"></span> 卡密管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
             <li class="">
                 <a href="./kmlist.php" ><span class="glyphicon glyphicon-list"></span> 卡密列表</a>
             </li>
			  <li class="">
                 <a href="addkm.php"><span class="glyphicon glyphicon-plus-sign"></span> 添加卡密</a>
             </li>
            </ul>
          </li>
		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#f40086;"><span class="glyphicon glyphicon-list-alt"></span> 商品管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
            <li class="">
            <a href="./clist.php"><span class="glyphicon glyphicon-globe"></span> 商品列表</a>
            </li>
			  <li class="">
                 <a href="./clist.php?my=add"><span class="glyphicon glyphicon-plus-sign"></span> 添加商品</a>
             </li>
              </li>
			  <li class="">
                              <a href="./typelist.php"><span class="glyphicon glyphicon-plus-sign"></span> 商品分类管理</a>
             </li>
            </ul>
          </li>
		  
		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#0071ce;"><span class="glyphicon glyphicon-cog"></span> 系统设置<b class="caret"></b></a>
            <ul class="dropdown-menu">
              
               <li><a href="./set.php?mod=site">网站信息配置</a></li>
               <li><a href="./other-set.php?act=email">发件邮箱配置</a><li>
               <li><a href="./set.php?mod=admin">管理员账号配置</a><li>
               <li><a href="./set.php?mod=pay">支付接口配置</a><li>
               <li><a href="./set.php?mod=epay">提现配置</a><li>
			   <li><a href="./update.php">检测版本更新</a><li>
            </ul>
          </li>
      
          <li><a href="./login.php?act=out" style="color:#18ce6a;"><span class="glyphicon glyphicon-log-out"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
<?php 
}else{
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}  
?>