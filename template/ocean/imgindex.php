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

      <meta name="author" content="ayangw">
	  <!-- END META -->
       <meta name="keywords" content="<?php echo $conf['keywords'];?>">
  <meta name="description" content="<?php echo $conf['description'];?>">
      <!-- BEGIN SHORTCUT ICON -->
	  <link rel="shortcut icon" href="template/ocean/img/favicon.ico">
	  <!-- END SHORTCUT ICON -->
     <title>
       <?php echo $conf['title'];?>
     </title>
	  <!-- BEGIN STYLESHEET-->
		<link href="template/ocean/css/bootstrap.min.css" rel="stylesheet"><!-- BOOTSTRAP CSS -->
		<link href="template/ocean/css/bootstrap-reset.css" rel="stylesheet"><!-- BOOTSTRAP CSS -->
		<link href="template/ocean/assets/font-awesome/css/font-awesome.css" rel="stylesheet"><!-- FONT AWESOME ICON STYLESHEET -->
        <link href="template/ocean/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet"><!-- FANCYBOX CSS -->
		<link rel="stylesheet" type="text/css" href="template/ocean/css/gallery.css"><!-- GALLERY CSS -->
		<link href="template/ocean/css/style.css" rel="stylesheet"><!-- THEME BASIC CSS -->
		<link href="template/ocean/css/style-responsive.css" rel="stylesheet"><!-- THEME BASIC RESPONSIVE  CSS -->
  
      <!--[if lt IE 9]>
      <script src="template/ocean/js/html5shiv.js"></script>
      <script src="template/ocean/js/respond.min.js"></script>
      <![endif]-->
	  <!-- END STYLESHEET-->
   </head>
   <body>
     <!-- BEGIN SECTION -->
      <section id="container" class="">
	    
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
              <a href="index.php" class="">
                <i class="fa fa-home">
                </i>
                <span>
                  首页
                </span>
              </a>
            </li>
            
           <li >
              <a href="index.php?tp=ocean&action=imgindex" class="active">
                <i class="fa fa-photo">
                </i>
                <span>
                 图文浏览
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
      
         <section id="main-content" style="min-height: 600px;">
		    <!-- BEGIN WRAPPER  -->
            <section class="wrapper">
               <section class="panel">
                  <header class="panel-heading">
                     <i class="fa fa-hand-o-down"></i>
                    图片展示
                     <span class="tools pull-right">
                     <a href="javascript:;" class="fa fa-chevron-down"></a>
                     <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                  </header>
                  <div class="panel-body">
                     <ul class="grid cs-style-3">
                       
                        <?php 
                            $res = $DB->query("select * from ayangw_goods where state = 1 order by sotr desc");
                            while ($row = $DB->fetch($res)) {
                               ?>
                                <li>
                           <figure>
                              <img src="<?=$row['imgs']; ?>" style="height: 300px;" alt="<?=$row['gName']; ?>">
                              <figcaption style="min-height: 200px;">
                                 <h3><?=$row['gName']; ?></h3><br>
                                <button onclick="window.open('http://<?=$_SERVER['HTTP_HOST'] ?>/<?=$conf['view'] ?>_share-<?=$row['id'] ?>.html')" class="btn btn-success btn-xs">立即购买</button>
                                 <button onclick="window.open('http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['zzqq']?>&site=qq&menu=yes')" class="btn btn-info btn-xs">咨询客服</button>
                                <br>
                                 <span><?=$row['gInfo']; ?></span>
                                
                                 <a class="fancybox" data-fancybox-group="group" href="<?=$row['imgs']; ?>">查看大图</a>
                                 
                              </figcaption>
                           </figure>
                        </li>
                               <?php 
                            }
                        ?>
                     </ul>
                  </div>
               </section>
            </section>
			<!-- END WRAPPER  -->
         </section>
		 <!-- END MAIN CONTENT -->
         <!-- BEGIN FOOTER -->
		  <footer class="site-footer">
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
		<script src="template/ocean/js/jquery.js" ></script><!-- BASIC JS LIABRARY -->
		<script src="template/ocean/js/bootstrap.min.js" ></script><!-- BOOTSTRAP JS  -->
		<script src="template/ocean/js/jquery.dcjqaccordion.2.7.js"></script><!-- ACCORDING JS -->
		<script src="template/ocean/assets/fancybox/source/jquery.fancybox.js" ></script><!-- FANCYBOX JS -->
		<script src="template/ocean/js/jquery.scrollTo.min.js" ></script><!-- SCROLLTO JS -->
		<script src="template/ocean/js/jquery.nicescroll.js" ></script><!-- NICESCROLL JS -->
		<script src="template/ocean/js/respond.min.js" ></script><!-- RESPOND JS -->
		<script src="template/ocean/js/modernizr.custom.js" ></script><!-- MORDERNIZR JS -->
		<script src="template/ocean/js/toucheffects.js" ></script><!-- TOUCH EFFECTS JS -->
		<script src="template/ocean/js/common-scripts.js" ></script><!-- BASIC COMMON  JS -->
		<script >
         $(function() {
           //    fancybox
             jQuery(".fancybox").fancybox();
         });
         
      </script>
	  <!-- END JS -->
   </body>
</html>


