<?php

$yxts=ceil((time()-strtotime($conf['create']))/86400); //本站已运行多少天

$allOrder = $DB->count("SELECT  id  from ayangw_order order by id DESC limit 1");
//历史订单数
$nowOrder = $DB->count("SELECT COUNT(id)  from ayangw_order order by id DESC limit 1");
//当前订单数
$okOrder = $DB->count("SELECT COUNT(id)   from ayangw_order where sta = 1 order by id DESC limit 1");

$rs=$DB->query("select * from ayangw_type");
$select = "";
while ($row = $DB->fetch($rs)){
    $select.='<option value="'.$row['id'].'">'.$row['tName'].'</option>';
}


if(!empty($_GET['act']) && $_GET['act'] == "export"){
    $gs = $_POST['gs'];
    if($gs == "" ){
        $gs = 1;
    }
    $data = "";
    $tqm = _ayangw($_POST['tqm']);
    $sql = "select * from ayangw_km
    where out_trade_no ='{$tqm}' or trade_no = '{$tqm}'  or rel = '{$tqm}'
    ORDER BY endTime desc
    ";
    $res = $DB->query($sql);
    while($row = $DB->fetch($res)){
    $sql2 = "select * from ayangw_goods where id =".$row['gid'];
    $row2 =$DB->get_row($sql2);
  
   
        if($gs == 1){
            $data = $data. $row['km']."\r\n";
        }
        if($gs == 2){
            $data = $data. $row['trade_no']."----".$row['km']."\r\n";
        }
        if($gs == 3){
            $data = $data.$row2['gName']."----".$row['km']."\r\n";
        }
        if($gs == 4){
            $data = $data.$row2['gName']."----".$row['km']."----".$row2['price']."\r\n";
        }
        if($gs == 5){
            $data = $data.$row2['gName']."----".$row['km']."----".$row2['price']."----".$row['endTime']."\r\n";
        }
        
     }
     
     if($data == ""){
         @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('暂无卡密记录！');history.go(-1);</script>");
     }

  $file_name='卡密信息_'.time().'.txt';
  $file_size=strlen($data);
  header("Content-Description: File Transfer");
  header("Content-Type:application/force-download");
  header("Content-Length: {$file_size}");
  header("Content-Disposition:attachment; filename={$file_name}");
  echo $data;

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
       卡密导出 - <?php echo $conf['title'];?>
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
        <a href="#" class="logo">
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

      <section id="main-content" style="min-height: 600px;">
	  <!-- BEGIN WRAPPER  -->
        <section class="wrapper">
		  <!-- BEGIN ROW  -->
		 
		   <!-- END ROW  -->
         
                     <section class="panel">
                        <header class="panel-heading">
                           <span class="label label-primary">输入凭证</span>
                           <span class="tools pull-right">
                           <a href="javascript:;" class="fa fa-chevron-down"></a>
                           <a href="javascript:;" class="fa fa-times"></a>
                           </span>
                        </header>
                        <div class="panel-body">
                           <form action="index.php?tp=ocean&action=export&act=export" method="POST" class="form-inline" role="form">
                              <div class="form-group" >
                                 <label class="sr-only" for="exampleInputEmail2">输入查询订单的凭证</label>
                                 <input type="text" style="min-width: 250px;" name = "tqm" class="form-control " value="" required placeholder="输入查询订单的凭证 订单编号 ">
                              </div>
                              <br>
                            <div class="form-group" >
                                 <label class="sr-only" for="exampleInputEmail2">导出格式</label>
                                 <input type="radio"  name = "gs" class="form-control " value="1">纯卡密&nbsp;&nbsp;
                                <input type="radio"  name = "gs" class="form-control " value="2">订单编号----卡密&nbsp;&nbsp;
                                <input type="radio"  name = "gs" class="form-control " value="3">商品名称----卡密&nbsp;&nbsp;
                                <input type="radio"  name = "gs" class="form-control " value="4">商品名称----卡密----价格&nbsp;&nbsp;
                                <input type="radio"  name = "gs" class="form-control " value="5">商品名称----卡密----价格----交易时间&nbsp;&nbsp;
                              </div>
                              <br>
                              <button type="submit" class="btn btn-success">批量导出卡密</button>
                           </form>
                        </div>
                     </section>
                  
          
         
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
        </section>
		<!-- END WRAPPER  -->
      </section>
      <!-- END MAIN CONTENT -->
      <!-- BEGIN FOOTER -->
      <footer class="site-footer" >
        <div class="text-center">
          2017 &copy; <?php echo $_SERVER['HTTP_HOST']?>
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.template/ocean/js/1.5.2/underscore-min.js"></script><!-- UNDERSCORE JS -->
    <script src="template/ocean/assets/jquery-knob/template/ocean/js/jquery.knob.js" ></script><!-- JQUERY KNOB JS -->
    <script src="layer/layer.js"></script>
	<script src="js/ayangw.js"></script>
    <script >
      //knob
      $(".knob").knob();
    </script>
    
    <!-- END JS -->
  </body>
</html>
