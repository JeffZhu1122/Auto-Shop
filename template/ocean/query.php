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
?>
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
                           <form action="index.php?tp=ocean&action=query&act=select" method="POST" class="form-inline" role="form">
                              <div class="form-group" >
                                 <label class="sr-only" for="exampleInputEmail2">输入查询订单的凭证</label>
                                 <input type="text" style="min-width: 250px;" name = "tqm" required class="form-control " value="<?php echo  $_GET['out_trade_no']!=""?$_GET['out_trade_no']:"";?>" placeholder="输入查询订单的凭证 QQ/订单编号 都可以">
                              </div>
                            
                              
                              <button type="submit" class="btn btn-success">立即查询</button>
                           </form>
                        </div>
                     </section>
                  
          
			 <section class="panel">
                        <header class="panel-heading">
                           <span class="label label-primary">历史订单列表</span>
                           <span class="tools pull-right">
                           
                           </span>
                        </header>
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
                            if(!empty($_GET['act']) && $_GET['act'] == "select"){
                                
                                $tqm = _ayangw($_POST['tqm']);
                                    $sql = "select * from ayangw_km
                                    where out_trade_no ='{$tqm}' or trade_no = '{$tqm}' or rel = '{$tqm}'
                                    ORDER BY endTime desc
                                    ";
                                    $res = $DB->query($sql);
                                    while($row = $DB->fetch($res)){
                                        $sql2 = "select * from ayangw_goods where id =".$row['gid'];
                                        $res2 = $DB->query($sql2);
                                        $row2 =$DB->fetch($res2);
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
                                    while($row = $DB->fetch($res)){
                                        $sql2 = "select * from ayangw_goods where id =".$row['gid'];
                                        $res2 = $DB->query($sql2);
                                        $row2 =$DB->fetch($res2);
                                        echo "<tr>";
                                        echo "<td>{$row['trade_no']}</td><td>{$row2['gName']}</td>
                                        <td>{$row2['price']}</td><td>{$row['rel']}</td><td>{$row['endTime']}</td><td>{$row['km']}</td>";
                                        echo "</tr>";
                                    }
							}
                           ?>
                            
                             
                     
		   </tbody></table></div></section>
         
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



