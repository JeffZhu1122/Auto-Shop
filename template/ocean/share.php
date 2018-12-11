<?php

$yxts=ceil((time()-strtotime($conf['create']))/86400); //本站已运行多少天

$allOrder = $DB->count("SELECT  id  from ayangw_order order by id DESC limit 1");
//历史订单数
$nowOrder = $DB->count("SELECT COUNT(id)  from ayangw_order order by id DESC limit 1");
//当前订单数
$okOrder = $DB->count("SELECT COUNT(id)   from ayangw_order where sta = 1 order by id DESC limit 1");

$gid = _ayangw($_GET['g']);

$rs=$DB->query("select * from ayangw_goods where id =".$gid);
if($row = $DB->fetch($rs)){

}else{
    exit("<script language='javascript'>window.location.href='./index.php';</script>");
}

$typers=$DB->query("select * from ayangw_type where id =".$row['tpId']);
$typerow = $DB->fetch($typers);

$c = $DB->count("SELECT COUNT(id) from ayangw_km  where stat = 0 and gid =".$row['id']);

/*
$rs=$DB->query("select * from ayangw_type");
$select = "";
while ($row = $DB->fetch($rs)){
    $select.='<option value="'.$row['id'].'">'.$row['tName'].'</option>';
}*/

?>
<!-- 
**********************************************
/*
 * 源码来源：全名易支付
 * */    
**********************************************
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="keywords" content="<?php echo $conf['keywords'];?>">
  <meta name="description" content="<?php echo $conf['description'];?>">
    <meta name="author" content="Olive Enterprise">
    <!-- END META -->
    
     <!-- BEGIN SHORTCUT ICON -->
     <link rel="shortcut icon" href="template/ocean/img/favicon.ico">
     <!-- END SHORTCUT ICON -->
     <title>
       <?php echo $conf['title'];?>
     </title>
     <!-- BEGIN STYLESHEET-->
		<link href="template/ocean/css/bootstrap.min.css" rel="stylesheet"><!-- BOOTSTRAP CSS -->
		<link href="template/ocean/css/bootstrap-reset.css" rel="stylesheet"><!-- BOOTSTRAP CSS -->
		<link href="template/ocean/assets/font-awesome/css/font-awesome.css" rel="stylesheet"><!-- FONT AWESOME ICON CSS -->
		<link href="template/ocean/css/style.css" rel="stylesheet"><!-- THEME BASIC CSS -->
		<link href="template/ocean/css/style-responsive.css" rel="stylesheet"><!-- THEME RESPONSIVE CSS -->
		<link href="template/ocean/assets/morris.js-0.4.3/morris.css" rel="stylesheet"><!-- MORRIS CHART CSS -->
     <!--dashboard calendar-->
     <link href="template/ocean/css/clndr.css" rel="stylesheet"><!-- CALENDER CSS -->  
     <!--[if lt IE 9]>
<script src="template/ocean/js/html5shiv.js">
</script>
<script src="template/ocean/js/respond.min.js">
</script>
<![endif]-->
     <!-- END STYLESHEET-->
  </head>
  <body>
    <!-- BEGIN SECTION -->
    <section id="container">
      <!-- BEGIN HEADER -->
      <header class="header white-bg">
        <!-- SIDEBAR TOGGLE BUTTON -->
			<div class="sidebar-toggle-box">
			  <div  data-placement="right" class="fa fa-bars tooltips">
			  </div>
			</div>
        <!-- SIDEBAR TOGGLE BUTTON  END-->
        <a href="index.php" class="logo">
          <?php echo $conf['title'];?>
          <span>
          </span>
        </a>
           <!-- START HEADER  NAV -->
        
        <nav class="nav notify-row" id="top_menu">
         
          
          
        </nav>
		<!-- END HEADER NAV -->
        
		 <!-- START USER LOGIN DROPDOWN  -->
		
        <div class="top-nav ">
          <ul class="nav pull-right top-menu">
            <li>
              <input type="text" class="form-control search" placeholder="Search">
            </li>
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" width="30" src="http://q1.qlogo.cn/g?b=qq&nk=<?php echo $conf['zzqq']?>&s=100&t=1449411350">
                <span class="username">
                  <?php echo  get_qqnick($conf['zzqq'])?>
                </span>
                <b class="caret">
                </b>
              </a>
              <ul class="dropdown-menu extended logout">
                <li class="log-arrow-up">
                </li>
                <li>
                  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes">
                    <i class=" fa fa-user">
                    </i>
                    联系客服
                  </a>
                </li>
                <li>
                  <a onclick="Addme()" style="cursor: pointer;">
                    <i class="fa fa-heart">
                    </i>
                   收藏本站
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-bell-o">
                    </i>
                  关于我们
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
		<!-- END USER LOGIN DROPDOWN  -->
      </header>
      <!-- END HEADER -->
      <!-- BEGIN SIDEBAR -->
      <aside>
        <div id="sidebar" class="nav-collapse">
          <ul class="sidebar-menu" id="nav-accordion">
            <li >
              <a href="index.php" class="active">
                <i class="fa fa-home">
                </i>
                <span>
                  首页
                </span>
              </a>
            </li>
            
           
           
            
            <li class="sub-menu">
              <a href="javascript:;">
                <i class=" fa  fa-search">
                </i>
                <span>
                 订单查询
                </span>
                <span class="label label-danger span-sidebar">
                  2
                </span>
              </a>
              <ul class="sub">
                <li>
                  <a href="index.php?tp=ocean&action=query">
                    订单查询
                  </a>
                </li>
              <li>
                  <a href="index.php?tp=ocean&action=export">
                    卡密批量导出
                  </a>
                </li>
              </ul>
            </li>
           
          
            <li>
              <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes">
                <i class="fa fa-user">
                </i>
                <span>
                  联系客服
                </span>
              </a>
            </li>
           
          </ul>
        </div>
      </aside>
      <!-- END SIDEBAR -->
      <!-- BEGIN MAIN CONTENT -->
      
      <input type="hidden" value = " <?php echo $yxts;?>" id="c1">
        <input type="hidden" value = " <?php echo $allOrder;?>" id="c2">
         <input type="hidden" value = " <?php echo $nowOrder;?>" id="c3">
          <input type="hidden" value = "  <?php echo $okOrder;?>" id="c4">

      <section id="main-content">
	  <!-- BEGIN WRAPPER  -->
        <section class="wrapper">
		  <!-- BEGIN ROW  -->
		  <?php if($conf['syslog'] == 1){ ?>
          <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa fa-clock-o blue">
                  </i>
                </div>
                <div class="value">
                  <h1 class="count">
                  0
                  </h1>
                  <p>
                   运行天数
                  </p>
                </div>
              </section>
            </div>
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa  fa-flag-o red">
                  </i>
                </div>
                <div class="value">
                  <h1 class=" count2">
                    0
                  </h1>
                  <p>
                历史总订单
                  </p>
                </div>
              </section>
            </div>
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa fa-yen yellow">
                  </i>
                </div>
                <div class="value">
                  <h1 class=" count3">
                    0
                  </h1>
                  <p>
                    当前订单
                  </p>
                </div>
              </section>
            </div>
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa fa-shopping-cart purple">
                  </i>
                </div>
                <div class="value">
                  <h1 class=" count4">
                   0
                  </h1>
                  <p>
                交易成功
                  </p>
                </div>
              </section>
            </div>
          </div>
          <?php }?>
		   <!-- END ROW  -->
          <div id="morris">
          <div class="row">
           <div class="col-lg-6">
                     <section class="panel">
                        <header class="panel-heading">
                           <span class="label label-primary">在线下单</span>
                           <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                           </span>
                        </header>
                        <div class="panel-body">
                           <form class="form-horizontal" role="form">
                              
                              <div class="form-group">
                                    <label class="col-lg-3 col-sm-3 control-label">选择分类</label>
                                 <div class="col-lg-9">
                                    <select class="form-control m-bot15" style="color:black;"   name="tp_id" id="tp_tid" >
                                      <option selected><?php echo $typerow['tName'];?></option>
                                    </select>
                                 
                                 </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-lg-3 col-sm-3 control-label">选择商品</label>
                                 <div class="col-lg-9">
                                    <select class="form-control m-bot15" name="gid" id="gid"  style="color:black;" >
                                     <option selected id="<?php echo $row['id'];?>" title ="<?php echo $row['price'];?>"><?php echo  $row['gName']?></option>
                                    </select>
                                 
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-lg-3 col-sm-3 control-label">  </label>
                                 <div class="col-lg-9">
                                    <div class="panel panel-info">
                        <div class="panel-heading">商品介绍</div>
                        <div class="panel-body">
                        <?php if(empty($row['gInfo']) || $row['gInfo'] == "" ){
                                echo "当前商品无介绍";
                            }else{
                                echo $row['gInfo'];
                            }?>
                              </div>
                              </div>
                              </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-lg-3 col-sm-3 control-label">商品价格</label>
                                 <div class="col-lg-9">
                                    <div class="iconic-input right">
                                       <i class="fa fa-book"></i>
                                       <input type="text" class="form-control"  name="need" id="need" value="<?php echo $row['price'];?>" disabled>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group" style="<?php if($conf['showKc'] == 2) echo "display:none;"?> ">
                                 <label class="col-lg-3 col-sm-3 control-label">商品库存</label>
                                 <div class="col-lg-9">
                                    <div class="iconic-input right">
                                       <input type="text"  name="kc" value="<?php echo $c;?>" id="kc" class="form-control " disabled>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-lg-3 col-sm-3 control-label">联系QQ</label>
                                 <div class="col-lg-9">
                                    <div class="iconic-input right">
                                       <i class="fa fa-book"></i>
                                       <input type="number"  name="lx" id="lx" class="form-control" placeholder="输入您的QQ,您的QQ号码也可以作为您的提取密码" required>
                                    </div>
                                 </div>
                              </div>
                               <div class="form-group spinner">
                                 <label class="col-lg-3 col-sm-3 control-label">选择数量</label>
                                 <div class="col-lg-9 ">
                                    <div class="input-group">
                                 
                                       <div class="input-group-addon btn btn-primary" id="jia" onclick='numstepUp()'>+</div>
                                       <input type="number" onBlur="checknum()"  name="number" id="number" class="form-control " placeholder="" min="1" step="1" value="1" required>
                                      <div class="input-group-addon btn btn-primary" id="jian"  onclick='numstepDown()'>-</div>
                                      
                                    </div>
                                 </div>
                              </div>
                        
                              
                               <div class="form-group">
                                <center>
                                 <span class="btn btn-default btnSpan" title="alipay"><input type="radio" name="type" value="alipay" class="pay" id="alipay" value="alipay" title="支付宝" ><img alt="" src="assets/alipay.ico" width="20" class="logo"> 支付宝</span>
                              <span class="btn btn-default btnSpan" title="qqpay"><input type="radio" name="type" value="qqpay"  class="pay" id="qqpay" value="qqpay" title="QQ钱包" ><img alt="" src="assets/qqpay.ico" class="logo"> QQ</span>
			     <span class="btn btn-default btnSpan" title="tenpay" style="display: none"><input type="radio" name="type" value="tenpay" class="pay" id="tenpay" value="tenpay" title="财付通" ><img alt="" src="assets/tenpay.ico" class="logo"> 财付通</span>
			     <span class="btn btn-default btnSpan"  title="wxpay"><input type="radio" name="type" value="wxpay" class="pay" id="wxpay" value="wxpay" title="微信" ><img alt="" src="assets/wechat.ico" class="logo"> 微信</span>
                             </center>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label col-lg-3"></label>
                                 <div class="col-lg-9">
                                    <div class="input-group m-bot15">
                                 <button type="button" id="submit_buy"  style="min-width: 250px;" class="btn btn-primary btn-block">
                                                   立即购买
                                                  </button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </section>
                  </div>
                <div class="col-lg-6">
                     <section class="panel">
                        <header class="panel-heading">
                            <span class="label label-primary">购买须知</span>
                           <span class="tools pull-right">
                           <a class="fa fa-chevron-down" href="javascript:;"></a>
                           <a class="fa fa-times" href="javascript:;"></a>
                           </span>
                        </header>
                        <div class="panel-body">
                           <div class="alert alert-success fade in">
                              <button data-dismiss="alert" class="close close-sm" type="button">
                              <i class="fa fa-times"></i>
                              </button>
                              <strong> <?php echo $conf['notice1']?></strong>
                           </div>
                           <div class="alert alert-info fade in">
                              <button data-dismiss="alert" class="close close-sm" type="button">
                              <i class="fa fa-times"></i>
                              </button>
                              <strong><?php echo $conf['notice2']?></strong> 
                           </div>
                           <div class="alert alert-warning fade in">
                              <button data-dismiss="alert" class="close close-sm" type="button">
                              <i class="fa fa-times"></i>
                              </button>
                              <strong> <?php echo $conf['notice3']?></strong>
                           </div>
                           <div class="alert alert-block alert-danger fade in">
                              <button data-dismiss="alert" class="close close-sm" type="button">
                              <i class="fa fa-times"></i>
                              </button>
                              <strong>本站域名：<?php echo $_SERVER['HTTP_HOST']?> | 客服QQ:<?php echo $conf['zzqq']?></strong> 
                           </div>
                        </div>
                     </section>
                  </div>
          

                         </div>
            </div>
			 <!-- END ROW  -->
         
		   <!-- BEGIN ROW  -->
         
        
        </section>
		<!-- END WRAPPER  -->
      </section>
      <!-- END MAIN CONTENT -->
      <!-- BEGIN FOOTER -->
      <footer class="site-footer">
        <div class="text-center">
          2018 &copy; <?php echo $_SERVER['HTTP_HOST']?>
         | <a href="" target="_blank">
            <?php echo $conf['title'];?>
          </a>
          <a href="#" class="go-top">
            <i class="fa fa-angle-up">
            </i>
          </a>
        </div>
      </footer>
      <!-- END  FOOTER -->
    </section>
    <!-- END SECTION -->
    <!-- BEGIN JS -->
    <script src="template/ocean/js/jquery-1.8.3.min.js" ></script><!-- BASIC JQUERY 1.8.3 LIB. JS -->
    <script src="template/ocean/js/bootstrap.min.js" ></script><!-- BOOTSTRAP JS -->
    <script src="template/ocean/js/jquery.dcjqaccordion.2.7.js"></script><!-- ACCORDIN JS -->
    <script src="template/ocean/js/jquery.scrollTo.min.js" ></script><!-- SCROLLTO JS -->
    <script src="template/ocean/js/jquery.nicescroll.js" ></script><!-- NICESCROLL JS -->
    <script src="template/ocean/js/respond.min.js" ></script><!-- RESPOND JS -->
    <script src="template/ocean/js/jquery.sparkline.js"></script><!-- SPARKLINE JS -->
    <script src="template/ocean/js/sparkline-chart.js"></script><!-- SPARKLINE CHART JS -->
    <script src="template/ocean/js/common-scripts.js"></script><!-- BASIC COMMON JS -->
    <script src="template/ocean/js/count.js"></script><!-- COUNT JS -->
    <!--Morris-->
    <script src="template/ocean/assets/morris.js-0.4.3/morris.min.js" ></script><!-- MORRIS JS -->
    <script src="template/ocean/assets/morris.js-0.4.3/raphael-min.js" ></script><!-- MORRIS  JS -->
    <script src="template/ocean/js/chart.js" ></script><!-- CHART JS -->
    <!--Calendar-->
    <script src="template/ocean/js/calendar/clndr.js"></script><!-- CALENDER JS -->
    <script src="template/ocean/js/calendar/evnt.calendar.init.js"></script><!-- CALENDER EVENT JS -->
    <script src="template/ocean/js/calendar/moment-2.2.1.js"></script><!-- CALENDER MOMENT JS -->
   
    <script src="template/ocean/assets/jquery-knob/template/ocean/js/jquery.knob.js" ></script><!-- JQUERY KNOB JS -->
    <script src="layer/layer.js"></script>
	<script src="js/ayangw.js"></script>
    <script >
      //knob
      $(".knob").knob();
    </script>
    <script>
	 
    </script>
    <!-- END JS -->
  </body>
</html>

